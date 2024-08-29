<?php

declare(strict_types=1);
namespace JustBetter;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use JustBetter\Utils\Invite;

require __DIR__ . '/vendor/autoload.php';

$ldap = new Invite($_GET["code"]);
$request = $ldap->getInviter();
$invitedBy = $request->hasErrors() ? null : $request->getData()["user"];
$isCodeValid = $invitedBy && $ldap->checkInvite($invitedBy);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $ldap->createAccount($_POST);
    if (!$errors) {
        header('Location: /');
        exit(303);
    } else echo "<p>".json_encode($errors) ."</p>";
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

        a {
            --primary: #8999f0;
            --secondary: #707dcd;
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
                <?php if (!$isCodeValid) { ?>
                    <h2 class="text-danger">Le code d'invitation est invalide (ou manquant)</h2>
                <?php } else { ?>

                    <h2>Vous avez été invité par <strong><em><?= $invitedBy["displayName"] ?></em></strong> à rejoindre Just Better</h2>
                    <p>Vous pouvez dès à présent créer votre compte en remplissant les champs suivants</p>

                    <form class="mt-4" method="post" enctype="multipart/form-data">
                        <div class="mb-3 row">
                            <label for="username" class="col-sm-3 col-form-label">Nom d'utilisateur</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Faut bien avoir un surnom... C'est quoi le votre ?"
                                       required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">E-Mail</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Promis on envoie rien (ou presque)" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-3 col-form-label">Mot de passe</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password" required minlength="8"
                                       placeholder="La sécurité, c'est important ! (le mot de passe qui a fuité 10x fera très bien l'affaire, personne ne vérifiera)">
                                <small><em>Minimum 8 caractères</em></small>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="passwordConfirmation" class="col-sm-3 col-form-label">Confirmation du mot de passe</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation"
                                       placeholder="On n'est jamais trop prudent, les fautes de frappes, ça arrive à tout le monde" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="discord" class="col-sm-3 col-form-label">Nom d'utilisateur Discord</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="discord" name="discord" placeholder="Pas de triche, on vérifiera !" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="avatar" class="col-sm-3 col-form-label">Avatar (optionnel)</label>
                            <div class="col-sm-9">
                                <!-- <div class="custom-file">
                                     <input class="custom-file-input" type="file" id="avatar" name="avatar" accept="image/jpeg"/>
                                     <div class="custom-file-label">Désolé de faire les difficiles, mais on n'aime que les JPG pour le moment</div>
                                 </div>-->
                                <input class="form-control" type="file" id="avatar" name="avatar" accept="image/jpeg"/>
                                <small><em>Désolé de faire les difficiles, mais on n'aime que les JPG pour le moment</em></small>
                            </div>
                        </div>

                        <p class="mt-5">
                            En créant un compte Just Better, vous acceptez de rejoindre notre <a href="https://discord.gg/Dce4dewQ7D">serveur Discord</a>
                            et <strong>d'y rester</strong> sous peine d'un bannissement.<br/>
                            Cette mesure nous permet de pouvoir communiquer avec vous si des changements importants ont lieu.
                        </p>

                        <button type="submit" class="btn btn-info">Créer le compte</button>
                    </form>

                <?php } ?>
            </div>
        </div>
    </main>
</div>
</body>
</html>