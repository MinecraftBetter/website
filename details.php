<?php
/**********************
 * Made by Evan Galli *
 **********************/

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
include '.secret.php';

use JustBetter\Utils\Invite;
use JustBetter\Utils\LDAP;

function getUserInfo($uid, $token)
{
    $ldap = new LDAP($token);
    $userinfo = $ldap->getUserInfo($uid);
    if ($userinfo) $userinfo["invitationCode"] = Invite::getCode($userinfo["id"], $userinfo["uuid"]);
    return $userinfo;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Content-type: application/json");
    if (!isset($_POST["username"], $_POST["old_password"], $_POST["new_password"])) {
        echo json_encode("Missing fields");
        http_response_code(400);
        exit();
    }
    $token = null;
    try {
        $token = LDAP::getToken($_POST["username"], $_POST["old_password"]);
    } catch (\Exception $_) {
    }
    if (!$token) {
        echo json_encode("Wrong password");
        http_response_code(400);
        exit();
    }
    $ldap = new LDAP($token);
    $errors = $ldap->changePassword($_POST["username"], $_POST["new_password"]);
    if ($errors) {
        echo json_encode($errors);
        http_response_code(500);
        exit();
    }
    echo json_encode("Changed successfully");
    exit();
}

$userinfo = isset($_COOKIE["user_id"]) && isset($_COOKIE["token"]) ? getUserInfo($_COOKIE["user_id"], $_COOKIE["token"]) : null;
?>

<!DOCTYPE html>
<html lang="en">
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
</head>

<body class="details">
<div class="mx-auto">
    <header class="masthead mb-auto" style="color: var(--white);">
        <div class="inner">
            <a href="/"><img class="masthead-brand" src="/assets/img/logos/justbetter.png" alt="Just Better"/></a>
        </div>
        <div class="text-center sites" id="introduction">
            <button class="btn text-white site" id="btn-jellyfinbetter" data-article="jellyfinbetter" data-maincolor="#868DDC" data-secondarycolor="#666ca9">
                <img src="/assets/img/logos/jellyfinbetter.png" class="presentation-icon" alt="Jellyfin Better logo"/>
                <span>Jellyfin Better</span>
            </button>
            <button class="btn text-white site" id="btn-minecraftbetter" data-article="minecraftbetter" data-maincolor="#ff5050" data-secondarycolor="#cc4040">
                <img src="/assets/img/logos/minecraftbetter.png" class="presentation-icon" alt="Minecraft Better logo"/>
                <span>Minecraft Better</span>
            </button>
            <button class="btn text-white site" id="btn-gameyfin" data-article="gameyfin" data-maincolor="#ff9932" data-secondarycolor="#e3702d">
                <img src="/assets/img/logos/gameyfin.png" class="presentation-icon" alt="Gameyfin logo"/>
                <span>Gameyfin</span>
            </button>
            <button class="btn text-white site" id="btn-retrofin" data-article="retrofin" data-maincolor="#a7c637" data-secondarycolor="#91ac33">
                <img src="/assets/img/logos/retrofin.png" class="presentation-icon" alt="Retrofin logo"/>
                <span>Retrofin</span>
            </button>
            <button class="btn text-white site" id="btn-betterplace" data-article="betterplace" data-maincolor="#47cc5d" data-secondarycolor="#359945">
                <img src="/assets/img/logos/betterplace.png" class="presentation-icon" alt="Better Place logo"/>
                <span>Better Place</span>
            </button>
        </div>

        <?php if ($userinfo) { ?>
            <button type="button" data-toggle="modal" data-target="#account" class="btn" style="font-size: 2.5em;padding: 0;">
                <i class="fas fa-user-circle" style="vertical-align: text-top;margin: 0;"></i>
            </button>
        <?php } ?>
    </header>

    <main role="main" style="min-height: calc(100vh - 7rem); padding-top: 4rem;">
        <div class="d-flex flex-column align-items-center mt-4" id="details" style="gap: 2em;">
            <article class="site-details" id="jellyfinbetter">
                <div class="head d-flex mb-4">
                    <img src="/assets/img/logos/jellyfinbetter.png" alt="Jellyfin Better logo" style="height:75px;"/>
                    <div class="ml-3 d-flex flex-column justify-content-center">
                        <h2 class="mb-0">Jellyfin Better</h2>
                        <p class="mb-0">Films, séries & animés</p>
                    </div>
                </div>
                <p>Sur <strong>Jellyfin Better</strong>, vous trouverez films, séries et animés.</p>
                <p>
                    Le catalogue est constamment enrichi grâce à vos requêtes faites sur <a href="https://request.justbetter.fr">la plateforme dédiée</a>.<br/>
                    S'il a un problème avec un des films/séries/animés, merci de le signaler sur cette <a href="https://request.justbetter.fr">même plateforme</a>.
                </p>

                <?php if (!$userinfo) {  //TODO : To remove completely when we're ready ?>
                    <div role="alert" class="alert alert-dark">
                        <i class="fas fa-info-circle" aria-hidden="true"></i> Il est nécessaire de disposer d'un compte pour pouvoir utiliser ce service, pour en créer
                        un,
                        utilisez <a href="https://jfago.justbetter.fr/invite/tM7jmbFsFGL2tLuYdRFyTT">l'assistant</a>.
                    </div>
                    <p>
                        Toute personne créant un compte est tenue de rejoindre <a href="https://discord.gg/DdXbeGzQSb">notre Discord</a> et <strong>d'y rester</strong>
                        sous
                        peine d'un bannissement.<br/>
                        <small>(merci de contacter <strong><em>tiagolmon</em></strong> pour toute contestation)</small><br/>
                        Cette mesure nous permet de pouvoir communiquer avec vous si des changements importants ont lieu.
                    </p>
                    <div role="alert" class="alert alert-danger">
                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                        Il vous est demandé d'<strong>envoyer un message</strong> dans le salon <code>#général</code> du serveur Discord en mentionnant qui vous a
                        communiqué
                        le lien du serveur.
                        À défaut de l'avoir fait, vous pourriez faire l'objet d'un bannissement temporaire.
                    </div>
                <?php } ?>

                <hr/>

                <p>
                    Pour utiliser ce service, il vous est <strong>requis d'installer un client Jellyfin</strong>, cela permet de grandement réduire la charge du serveur
                    et ainsi pouvoir accueillir plus de monde.<br/>
                    Voici une liste non exhaustive des clients disponibles :
                </p>
                <ul>
                    <li><strong>Windows:</strong>
                        <a href="https://github.com/jellyfin/jellyfin-media-player/releases/download/v1.9.1/JellyfinMediaPlayer-1.9.1-windows-x64.exe">
                            Jellyfin Media Player</a></li>
                    <li><strong>MacOS:</strong>
                        <a href="https://github.com/jellyfin/jellyfin-media-player/releases/download/v1.9.1/JellyfinMediaPlayer-1.9.1-macos-notarized.dmg">
                            Jellyfin Media Player</a></li>
                    <li><strong>Linux:</strong> <a href="https://github.com/jellyfin/jellyfin-media-player/releases/">Jellyfin Media Player</a></li>
                    <li><strong>Android:</strong> <a href="https://play.google.com/store/apps/details?id=dev.jdtech.jellyfin">Findroid</a> <small class="text-danger">(Ne
                            pas utiliser l'application Jellyfin !)</small></li>
                    <li><strong>iOS:</strong> <a href="https://apps.apple.com/ca/app/swiftfin/id1604098728">Swiftfin</a> <small class="text-danger">(Ne pas utiliser
                            l'application Jellyfin Mobile !)</small></li>
                    <li><strong>Android TV:</strong> <a href="https://play.google.com/store/apps/details?id=org.jellyfin.androidtv">Jellyfin for Android TV</a></li>
                    <li><strong>Tizen (Samsung):</strong> <a href="https://github.com/jeppevinkel/jellyfin-tizen-builds">Jellyfin for Tizen</a>
                        <small class="text-warning">
                            (Programme en alpha à installer manuellement, s'adresser à <strong><em>evang_</em></strong> pour toute demande d'aide)</small></li>
                    <li><strong>WebOS (LG):</strong> <a href="https://us.lgappstv.com/main/tvapp/detail?appId=1030579">Jellyfin for WebOS</a> <small class="text-danger">
                            (Non fonctionnel sur le serveur ! Si vous souhaitez nous aider à régler ce problème, merci de contacter
                            <strong><em>evang_</em></strong>)</small>
                    </li>
                </ul>
                <p>Sur le client, veuillez entrer <code>https://jellyfin.justbetter.fr</code> en tant qu'adresse du serveur.</p>
                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://jellyfin.justbetter.fr/" class="btn btn-custom-primary btn-lg">
                        <i class="fas fa-mouse-pointer" aria-hidden="true"></i>Accéder au service
                    </a>
                </p>
            </article>
            <article class="site-details" id="minecraftbetter">
                <div class="head d-flex mb-4">
                    <img src="/assets/img/logos/minecraftbetter.png" alt="Minecraft Better logo" style="height:75px;"/>
                    <div class="ml-3 d-flex flex-column justify-content-center">
                        <h2 class="mb-0">Minecraft Better</h2>
                        <p class="mb-0">Un serveur Minecraft ¯\_(ツ)_/¯</p>
                    </div>
                </div>

                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i> Le serveur est actuellement fermé
                </div>

                <p><strong>Minecraft Better</strong> est un serveur évènementiel proposant survie et mini-jeux.</p>

                <div class="mb-5 text-center" style="margin: 0 auto; max-width: 600px; max-height: 300px;">
                    <div class="embed-responsive embed-responsive-16by9">
                        <div class="embed-responsive-item text-center text-light d-flex" style="margin: 0 auto; background: #2f2f2f">
                            <iframe width="1280" height="720" src="https://www.youtube.com/embed/EHF_U2uEKCo" title="MinecraftBetter Trailer"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://minecraft.justbetter.fr/" class="btn btn-custom-primary btn-lg">
                        <i class="fas fa-mouse-pointer" aria-hidden="true"></i>Accéder au service
                    </a>
                </p>
            </article>
            <article class="site-details" id="gameyfin">
                <div class="head d-flex mb-4">
                    <img src="/assets/img/logos/gameyfin.png" alt="Gameyfin logo" style="height:75px;"/>
                    <div class="ml-3 d-flex flex-column justify-content-center">
                        <h2 class="mb-0">Gameyfin</h2>
                        <p class="mb-0">Des jeux en toute légalité et sans DRM</p>
                    </div>
                </div>
                <p><strong>Gameyfin</strong> est une plateforme ne contenant que des jeux PC <strong>sans DRM</strong> obtenus de manière <strong>légale</strong>.</p>
                <p>Si vous souhaitez participer à l'étoffement du catalogue, merci de contacter <strong><em>mikaleplubo</em></strong>.</p>
                <p>Dû à la quantité de jeux mis à votre disposition, tous n'ont pu être testé, si un jeu ne se lance pas, merci de nous en informer.</p>
                <p>Sur Windows, le client <a href="https://gamevau.lt/">GameVault</a> est supporté par notre plateforme,
                    connectez-vous au serveur avec l'URL <code>https://clientgameyfin.justbetter.fr/</code></p>

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://gameyfin.justbetter.fr/" class="btn btn-custom-primary btn-lg">
                        <i class="fas fa-mouse-pointer" aria-hidden="true"></i>Accéder au service
                    </a>
                </p>
            </article>
            <article class="site-details" id="retrofin">
                <div class="head d-flex mb-4">
                    <img src="/assets/img/logos/retrofin.png" alt="Retrofin logo" style="height:75px;"/>
                    <div class="ml-3 d-flex flex-column justify-content-center">
                        <h2 class="mb-0">Retrofin</h2>
                        <p class="mb-0">Du rétro, à gogo</p>
                    </div>
                </div>
                <p>Sur <strong>Retrofin</strong>, vous pourrez trouver les ROMs d'un grand nombre de jeux rétro (ou console de manière plus générale).</p>
                <p>Vous trouverez aussi pour certains jeux, des packs HD permettant de jouer à vos jeux favoris tout en profitant d'une qualité améliorée</p>
                <p>Vous pouvez télécharger les ROMs et Pack HD pour y jouer localement ou jouer directement dans votre navigateur si la console est supportée</p>
                <div role="alert" class="alert alert-dark">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                    Pour vous connecter à la plateforme, utilisez<br/>Identifiant : <code>guest</code><br/>Mot de passe : <code>guest</code>
                </div>

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://retrofin.justbetter.fr/" class="btn btn-custom-primary btn-lg">
                        <i class="fas fa-mouse-pointer" aria-hidden="true"></i>Accéder au service
                    </a>
                </p>
            </article>
            <article class="site-details" id="betterplace">
                <div class="head d-flex mb-4">
                    <img src="/assets/img/logos/betterplace.png" alt="Better Place logo" style="height:75px;"/>
                    <div class="ml-3 d-flex flex-column justify-content-center">
                        <h2 class="mb-0">Better Place</h2>
                        <p class="mb-0">Toile de dessin collaborative</p>
                    </div>
                </div>

                <p>Sur <strong>Better Place</strong>, vous pourrez dessiner sur une grande toile collaborative à la manière de <a href="https://www.reddit.com/r/place">r/place</a>.
                </p>
                <p>Seul ou à plusieurs, contribuez à remplir la toile avec de nombreux dessins.</p>
                <p class="mt-3 text-warning">Toute tentative de vandalisme est strictement interdite et conduira inéluctablement au bannissement du mis en cause.</p>

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://place.justbetter.fr/" class="btn btn-custom-primary btn-lg">
                        <i class="fas fa-mouse-pointer" aria-hidden="true"></i>Accéder au service
                    </a>
                </p>
            </article>
        </div>
    </main>

    <footer class="mt-auto text-center">
        <div class="inner">
            <p>Ce site a été codé avec ❤ par <a href="https://github.com/06Games" style="font-weight: 600;">Evan Galli</a></p>
            <p>Ce serveur est généreusement hébergé par <a href="https://github.com/Tiagoez" style="font-weight: 600;">Tiago Procopio</a></p>
            <p>Le design a été imaginé par <a href="https://github.com/MazeWave" style="font-weight: 600;">Louis Dalmasso</a></p>
            <p>Merci à <a href="https://github.com/Mikaleplubo" style="font-weight: 600;">Mika</a> <small style="font-size: 7px;">(le 🐐)</small> pour son investissement
                quotidien dans le serveur</p>
        </div>
    </footer>
    <div class="modal fade" id="account" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div>
                        <div class="row mx-0">
                            <div id="avatar">
                                <div class="text-center d-table w-100 h-100">
                                    <p class="d-table-cell align-middle font-weight-bold">Changer</p>
                                </div>
                            </div>
                            <div class="ml-3" style="align-self: center;">
                                <p class="m-0" id="displayName"></p>
                                <small><em id="username"></em></small>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small><i class="fas fa-clock" title="Date de création du compte"></i> <span id="creationDate"></span></small><br/>
                            <small><i class="fas fa-envelope" title="Adresse email"></i> <span id="email"></span></small>
                        </div>
                    </div>

                    <hr/>

                    <div class="mb-3">
                        <label for="invite_code" class="col-form-label">Lien d'invitation</label>
                        <input type="text" readonly class="form-control" id="invite_code" onclick="this.select()"/>
                    </div>

                    <hr/>

                    <div>
                        <details id="change-password-details">
                            <summary class="font-weight-bold mb-3">Changer le mot de passe</summary>
                            <form id="change-password">
                                <label for="old_password" class="col-form-label">Mot de passe actuel</label>
                                <input type="password" class="form-control" id="old_password" required/>
                                <label for="new_password" class="col-form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control" id="new_password" minlength="8" required/>
                                <label for="new_conf_password" class="col-form-label">Confirmation du mot de passe</label>
                                <input type="password" class="form-control" id="new_conf_password" minlength="8" required/>
                                <button class="btn btn-dark mt-3 w-100" type="submit">Sauvegarder</button>
                            </form>
                        </details>
                    </div>

                    <script>
                        let user = <?= json_encode($userinfo) ?>;
                        let avatar = user.attributes.find(attr => attr.name === "avatar")?.value;
                        document.getElementById("avatar").style.backgroundImage = avatar ? "url(data:image/jpg;base64," + avatar + ")" : null;
                        document.getElementById("avatar").onclick = _ => changeAvatar();
                        document.getElementById("displayName").innerText = user.displayName;
                        document.getElementById("username").innerText = user.id;
                        document.getElementById("creationDate").innerText = new Date(user["creationDate"]).toLocaleString();
                        document.getElementById("email").innerText = user.email;
                        document.getElementById("invite_code").value = "https://justbetter.fr/invite?code=" + user["invitationCode"];
                        let old_pass = document.getElementById("old_password");
                        let new_pass = document.getElementById("new_password");
                        let conf_pass = document.getElementById("new_conf_password");
                        old_pass.value = new_pass.value = conf_pass.value = null;
                        old_pass.oninput = new_pass.oninput = conf_pass.oninput = () => checkPasswordInputs();
                        document.getElementById("change-password").onsubmit = ev => {
                            ev.preventDefault();
                            changePassword();
                        }

                        function changeAvatar() {
                            let input = document.createElement('input');
                            input.type = 'file';
                            input.accept = "image/jpeg";
                            input.onchange = e => {
                                let file = e.target.files[0];
                                const reader = new FileReader();
                                reader.readAsDataURL(file);
                                reader.onload = () => {
                                    let encoded = reader.result.toString().replace(/^data:(.*,)?/, '');
                                    if ((encoded.length % 4) > 0) {
                                        encoded += '='.repeat(4 - (encoded.length % 4));
                                    }

                                    graphQL("mutation ($id: String!, $avatar: String) { updateUser(user: {id: $id, avatar: $avatar}) { ok } }", {
                                        "id": user.id,
                                        "avatar": encoded
                                    }).then(res => {
                                        if (res.data.updateUser.ok) document.getElementById("avatar").style.backgroundImage = "url(data:image/jpg;base64," + encoded + ")";
                                        else alert("An error has occurred while changing the avatar !");
                                    });
                                };
                            }
                            input.click();
                        }

                        function checkPasswordInputs() {
                            if (!old_pass.value)
                                old_pass.setCustomValidity("Field must be entered");
                            else old_pass.setCustomValidity("");

                            if (!new_pass.value)
                                new_pass.setCustomValidity("Field must be entered");
                            else if (new_pass.value.length < 8)
                                new_pass.setCustomValidity("Password must be 8 characters long");
                            else new_pass.setCustomValidity("");

                            if (conf_pass.value !== new_pass.value)
                                conf_pass.setCustomValidity("Passwords don't match");
                            else conf_pass.setCustomValidity("");
                        }

                        function changePassword() {
                            let formData = new FormData();
                            formData.append("username", user.id);
                            formData.append("old_password", old_pass.value);
                            formData.append("new_password", new_pass.value);
                            fetch("https://justbetter.fr/details", {
                                method: "POST",
                                body: formData
                            }).then(res => {
                                if (res.ok) {
                                    document.getElementById("change-password-details").open = false;
                                    old_pass.value = new_pass.value = conf_pass.value = null;
                                }
                                else {
                                    res.json().then(body => alert("An error has occurred while changing the password : " + body));
                                }
                            });
                        }

                        async function graphQL(query, variables) {
                            let req = await fetch("https://lldap.justbetter.fr/api/graphql", {
                                method: "post",
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                    'Authorization': 'Bearer <?= $_COOKIE["token"] ?>'
                                },
                                body: JSON.stringify({
                                    "operationName": null,
                                    "variables": variables,
                                    "query": query
                                })
                            });
                            return await req.json();
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/main.js"></script>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
