<?php
/**********************
 * Made by Evan Galli *
 **********************/
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
            <button class="btn text-white site" id="btn-betterplace" data-article="betterplace" data-maincolor="#47cc5d" data-secondarycolor="#359945">
                <img src="/assets/img/logos/betterplace.png" class="presentation-icon" alt="Better Place logo"/>
                <span>Better Place</span>
            </button>
        </div>
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
                <div role="alert" class="alert alert-dark">
                    <i class="fas fa-info-circle" aria-hidden="true"></i> Il est nécessaire de disposer d'un compte pour pouvoir utiliser ce service, pour en créer un, utilisez <a href="https://jfago.justbetter.fr/invite/tM7jmbFsFGL2tLuYdRFyTT">l'assistant</a>.</div>
                <p>
                    Toute personne créant un compte est tenue de rejoindre <a href="https://discord.gg/7g7AURRjmX">notre Discord</a> et d'y rester sous peine d'un
                    bannissement.<br/>
                    <small>(merci de contacter <strong><em>tiagolmon</em></strong> pour toute contestation)</small><br/>
                    Cette mesure nous permet de pouvoir communiquer avec vous si des changements importants ont lieu.
                </p>
                <p>
                    Toute personne étrangère à l'équipe d'administration peut faire l'objet d'un bannissement temporaire, le temps d'établir un contact avec elle afin de savoir qui
                    l'a invitée sur le service.<br/>
                    Pour simplifier la procédure et éviter tout désagrément, vous pouvez simplement envoyer un message dans le salon <code>Général</code> du serveur Discord en
                    mentionnant qui vous a communiqué le lien du serveur.
                </p>
                <p>
                    Pour utiliser ce service, nous vous demandons d'utiliser un client Jellyfin, cela permet de grandement réduire la charge du serveur et ainsi pouvoir accueillir plus de monde.<br/>
                    Voici une liste non exhaustive des clients disponibles:
                    <ul>
                        <li><strong>Windows:</strong> <a href="https://github.com/jellyfin/jellyfin-media-player/releases/download/v1.9.1/JellyfinMediaPlayer-1.9.1-windows-x64.exe">Jellyfin Media Player</a></li>
                        <li><strong>MacOS:</strong> <a href="https://github.com/jellyfin/jellyfin-media-player/releases/download/v1.9.1/JellyfinMediaPlayer-1.9.1-macos-notarized.dmg">Jellyfin Media Player</a></li>
                        <li><strong>Linux:</strong> <a href="https://github.com/jellyfin/jellyfin-media-player/releases/">Jellyfin Media Player</a></li>
                        <li><strong>Android:</strong> <a href="https://play.google.com/store/apps/details?id=dev.jdtech.jellyfin">Findroid</a></li>
                        <li><strong>iOS:</strong> <a href="https://apps.apple.com/ca/app/swiftfin/id1604098728">Swiftfin</a></li>
                    </ul>
                    Sur le client, veuillez entrer <code>https://jellyfin.justbetter.fr/</code> en tant qu'adresse du serveur.
                </p>
                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="/jellyfin" class="btn btn-lg">
                        <i class="fas fa-photo-video" aria-hidden="true"></i>Jellyfin
                    </a>
                    <a href="https://request.justbetter.fr/" class="btn btn-lg">
                        <i class="fas fa-bullhorn" aria-hidden="true"></i>Requêtes / Problèmes
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
                <p><strong>Minecraft Better</strong> est un serveur évènementiel proposant survie et mini-jeux.</p>
                <p class="mt-3 mb-3 text-warning">Le serveur est actuellement fermé</p>

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://minecraft.justbetter.fr/" class="btn btn-lg">
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
                <p><strong>Gameyfin</strong> est une plateforme ne contenant que des jeux <strong>sans DRM</strong> obtenus de manière <strong>légale</strong>.</p>
                <p>Si vous souhaitez participer à l'étoffement du catalogue, merci de contacter <strong><em>mikaleplubo</em></strong>.</p>
                <p>Dû à la quantité de jeux mis à votre disposition, tous n'ont pu être testé, si un jeu ne se lance pas, merci de nous en informer.</p>

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://gameyfin.justbetter.fr/" class="btn btn-lg">
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
                <p>Sur <strong>Better Place</strong>, vous pourrez dessiner sur une grande toile collaborative à la manière de <a href="https://www.reddit.com/r/place">r/place</a>.</p>
                <p>Seul ou à plusieurs, contribuez à remplir la toile avec de nombreux dessins.</p>
                <p class="mt-3 text-warning">Toute tentative de vandalisme est strictement interdite et conduira inéluctablement au bannissement du mis en cause.</p>

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://place.justbetter.fr/" class="btn btn-lg">
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
            <p>Merci à <a href="https://github.com/Mikaleplubo" style="font-weight: 600;">Mika </a> <small style="font-size: 7px;">(le 🐐)</small> pour son investissement quotidien dans le serveur</p>
        </div>
    </footer>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
