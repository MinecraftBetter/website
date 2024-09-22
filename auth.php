<?php

declare(strict_types=1);
namespace JustBetter;

use JustBetter\Utils\LDAP;

require __DIR__ . '/vendor/autoload.php';

include '.secret.php';

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $uid = $_POST["user_id"] ?? null;
        $password = $_POST["password"] ?? null;
        $token = $uid && $password ? LDAP::getToken($uid, $password) : null;
        if ($uid && $token) {
            setcookie("user_id", $uid);
            setcookie("token", $token);
            header('Location: /details');
            exit(303);
        }
    } catch (\Exception) {
        $error = "Identifiants invalides";
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

        @media screen and (min-height: 32.5em) and (min-width: 300px) {
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
            <div class="site-details center-me" style="max-width: 500px;">
                <h2>Connexion à Just Better</h2>

                <form class="mt-4" method="post" enctype="multipart/form-data">
                    <?php if ($error) { ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                            <?= $error ?>
                        </div>
                    <?php } ?>

                    <div class="mb-3">
                        <label for="username" class="col-form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" name="user_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="col-form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required minlength="8">
                    </div>

                    <button type="submit" class="btn btn-info mt-4 w-100">Connexion</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>