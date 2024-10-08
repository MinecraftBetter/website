<?php

declare(strict_types=1);

namespace JustBetter\Utils;

use Softonic\GraphQL\Response;

class Invite
{
    private LDAP $ldap;
    private string $inviterId;
    private string $inviterUuid;

    public function __construct($code, $token)
    {
        list($this->inviterId, $this->inviterUuid) = Invite::parseCode($code);
        $this->ldap = new LDAP($token);
    }

    public static function getCode($id, $uuid): string
    {
        return $id . "/" . substr(hash('sha256', $uuid), 0, 8);
    }

    public static function parseCode($code): array
    {
        return array_pad(explode("/", $code), 2, null);
    }

    public function getInviter(): Response
    {
        $query = <<<'QUERY'
query($idInviter: String!){
  user(userId: $idInviter){
    id,
    uuid,
    displayName
  }
}
QUERY;

        $variables = ['idInviter' => $this->inviterId];
        return $this->ldap->client->query($query, $variables);
    }

    public function checkInvite($user): bool
    {
        $hashedUuid = substr(hash('sha256', $user['uuid']), 0, 8);
        return $user['id'] === $this->inviterId && $hashedUuid === $this->inviterUuid;
    }

    public function createAccount($data): ?array
    {
        if ($data["password"] !== $data["passwordConfirmation"]) return ['Passwords do not match'];

        $mutation = <<<'MUTATION'
mutation ($id: String!, $email: String, $displayName: String, $avatar: String, $attributes: [AttributeValueInput!]){
  createUser(
    user: {
      id: $id
      email: $email
      displayName: $displayName
      avatar: $avatar
      attributes: $attributes
    }
  ) {
    id
  }
}
MUTATION;

        $avatar = isset($_FILES['avatar']) && file_exists($_FILES['avatar']['tmp_name']) && is_uploaded_file($_FILES['avatar']['tmp_name'])
            ? base64_encode(file_get_contents($_FILES['avatar']['tmp_name'])) : null;

        $variables = [
            'id' => $data['username'],
            'email' => $data['email'],
            'displayName' => $data['username'],
            'avatar' => $avatar,
            'attributes' => [
                ['name' => 'discord', 'value' => $data['discord']],
                ['name' => 'invited_by', 'value' => $this->inviterId]
            ]
        ];
        $response = $this->ldap->client->query($mutation, $variables);

        if ($response->hasErrors()) return $response->getErrors();
        $id = $response->getData()['createUser']['id'];

        $mutation = <<<'MUTATION'
mutation ($id: String!){
  addUserToGroup(userId: $id, groupId: 4){
      ok
  }
}
MUTATION;
        $variables = ['id' => $id];
        $response = $this->ldap->client->query($mutation, $variables);

        if ($response->hasErrors()) return $this->removeAccount($id, $response->getErrors());
        if (!$response->getData()['addUserToGroup']['ok']) return $this->removeAccount($id, ['Error adding to group']);

        $result = $this->ldap->changePassword($id, $data['password']);
        return $result ? $this->removeAccount($id, $result) : null;
    }

    private function removeAccount($id, $error): ?array
    {
        $mutation = <<<'MUTATION'
mutation ($id: String!){
  deleteUser(userId: $id){
      ok
  }
}
MUTATION;
        $variables = ['id' => $id];
        $response = $this->ldap->client->query($mutation, $variables);

        if ($response->hasErrors()) return [$response->getErrors(), $error];
        if (!$response->getData()['deleteUser']['ok']) return [['Error recovering from error'], $error];
        return $error;
    }
}
