<?php

declare(strict_types=1);

namespace JustBetter\Utils;

use Softonic\GraphQL\Client;
use Softonic\GraphQL\ClientBuilder;

class LDAP
{
    private string $token;
    public readonly Client $client;

    public function __construct($token)
    {
        $this->token = $token;
        $this->client = ClientBuilder::build(LLDAP_ENDPOINT . 'api/graphql', ['headers' => ['Authorization' => "Bearer $this->token"]]);
    }

    public static function getToken($username, $password): string
    {
        $httpClient = new \GuzzleHttp\Client();
        $response = $httpClient->request('POST', LLDAP_ENDPOINT . 'auth/simple/login', [
            'json' => [
                'username' => $username,
                'password' => $password
            ]
        ]);
        return json_decode($response->getBody()->getContents())->token;
    }

    public function changePassword($id, $newPassword)
    {
        $output = null;
        $retval = null;
        exec('lldap_set_password -b ' . escapeshellarg(LLDAP_ENDPOINT) . ' --token=' . escapeshellarg($this->token) . ' -u ' . escapeshellarg($id) . ' -p ' . escapeshellarg($newPassword), $output, $retval);

        return $retval === 0 ? null : (empty($output) ? ["Invalid password"] : $output);
    }

    public function getUserInfo($username)
    {
        $query = <<<'QUERY'
query($username: String!){
  user(userId: $username){
    id, 
    uuid,
    email,
    displayName,
    creationDate,
    attributes {name, value}
  }
}
QUERY;

        $variables = ['username' => $username];
        try {
            return $this->client->query($query, $variables)->getData()["user"];
        } catch (\Exception) {
            return null;
        }
    }

    public function changeAvatar(mixed $username, ?string $avatar)
    {
        $mutation = <<<'MUTATION'
mutation($id: String!, $avatar: String) {
  updateUser(user: { id: $id, avatar: $avatar }) {
    ok
  }
}
MUTATION;

        $variables = ['id' => $username, 'avatar' => $avatar];
        $response = $this->client->query($mutation, $variables);

        try {
            if ($response->hasErrors()) return $response->getErrors();
            if (!$response->getData()['updateUser']['ok']) return ['Error changing avatar'];
            return null;
        } catch (\Exception $e) {
            return [$e->getMessage()];
        }
    }
}