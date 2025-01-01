<?php

declare(strict_types=1);
namespace JustBetter;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JustBetter\Utils\LDAP;

require __DIR__ . '/vendor/autoload.php';

include '.secret.php';

$errors = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ldap = null;
    try {
        $ldap = new LDAP(LDAP::getToken($_POST["username"], "CHANGE_ME"));
    } catch (\Exception) {
        $errors = ["Wrong username or already migrated"];
    }

    if ($ldap) {
        $httpClient = new Client();
        $response = null;
        try {
            $response = $httpClient->request('POST', "https://jellyfin.justbetter.fr/Users/AuthenticateByName", [
                'body' => json_encode([
                    'Username' => $_POST["username"],
                    'Pw' => $_POST["old_password"]
                ]),
                'headers' => [
                    "Authorization" => "MediaBrowser Client=\"Migration\", Device=\"JustBetter\", Version=\"1.0\", DeviceId=\"" . random_int(0, 9999) . "\"",
                    "Content-Type" => "application/json"
                ]
            ]);
        } catch (GuzzleException $e) {
            $errors = ["Erreur de communication avec Jellyfin (" . $e->getResponse()->getStatusCode() . ")"];
            $body = $e->getResponse()->getBody()->getContents();
            if ($body) $errors["body"] = $body;
        }

        if ($response) {
            if ($response->getStatusCode() !== 200) $errors = ["Jellyfin authentication failed"];
            else if ($_POST["password"] !== $_POST["passwordConfirmation"]) $errors = ['Passwords do not match'];
            else {
                try {
                    $avatar = isset($_FILES['avatar']) && file_exists($_FILES['avatar']['tmp_name']) && is_uploaded_file($_FILES['avatar']['tmp_name'])
                        ? base64_encode(file_get_contents($_FILES['avatar']['tmp_name'])) : null;
                    $errors = $ldap->changeAvatar($_POST["username"], $avatar);
                } catch (\Exception $e) {
                    $errors = ["Erreur lors de la sauvegarde de l'avatar", $e->getMessage()];
                }

                if (!$errors) $ldap->changePassword($_POST["username"], $_POST["password"]);
            }
        }
    }
    if (!$errors) {
        header('Location: /');
        http_response_code(303);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"/>
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>

    <title>Just Better</title>
    <link rel="canonical" href="https://justbetter.fr"/>
    <meta name="description" content="Everything is just better when it's on Just Better™">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/fontawesome.min.css" rel="stylesheet"/>
    <link href="assets/css/main.css" rel="stylesheet"/>


    <style>
        body {
            --primary: #2b2b2b;
            --secondary: #424348;
        }

        @media screen and (min-height: 45em) and (min-width: 1200px) {
            .center-me {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }
    </style>
</head>
<body class="details">
<div class="mx-auto">
    <header class="masthead mb-auto" style="color: var(--white);">
        <div class="inner">
            <img class="masthead-brand" src="/assets/img/banner.png" alt="Just Better"/>
        </div>
    </header>

    <main role="main" style="padding-top: 4rem;">
        <div class="d-flex flex-column align-items-center mt-4" id="details" style="gap: 2em;">
            <div class="site-details center-me">
                <h2>Migration vers un compte global Just Better</h2>
                <p>Merci de remplir tous les champs</p>

                <form class="mt-4" method="post" enctype="multipart/form-data">
                    <?php if ($errors) { ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                            <?= json_encode($errors) ?>
                        </div>
                    <?php } ?>

                    <div class="mb-3 row">
                        <label for="username" class="col-sm-3 col-form-label">Nom d'utilisateur Jellyfin</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="old_password" class="col-sm-3 col-form-label">Mot de passe Jellyfin</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="old_password" name="old_password">
                            <small>Si vous n'en avez pas (honte à vous), laissez vide</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-3 col-form-label">Nouveau mot de passe</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" required minlength="8">
                            <small>Nous ne pouvons migrer automatiquement votre mot de passe en raison de la manière dont ils sont stockés.<br/>
                                Vous pouvez réutiliser l'ancien, ou en changer. Dans tous les cas, il vous est requis d'en fournir un de 8 caractères minimum.</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="passwordConfirmation" class="col-sm-3 col-form-label">Confirmation du mot de passe</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" required/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                        <div class="col-sm-9">
                            <!-- <div class="custom-file">
                                 <input class="custom-file-input" type="file" id="avatar" name="avatar" accept="image/jpeg"/>
                                 <div class="custom-file-label">Désolé de faire les difficiles, mais on n'aime que les JPG pour le moment</div>
                             </div>-->
                            <input class="form-control" type="file" id="avatar" name="avatar" accept="image/jpeg" required/>
                            <small>On n'accepte pour le moment que les JPG "léger"</small>
                        </div>
                    </div>


                    <div role="alert" class="alert alert-danger">
                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                        Une fois la migration effectuée, merci de contacter sur Discord un administrateur pour qu'il puisse faire les changements nécessaires
                        à ce que ce nouveau compte soit utilisé en lieu et place de l'ancien.
                    </div>

                    <button type="submit" class="btn btn-info">Migrer le compte</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>