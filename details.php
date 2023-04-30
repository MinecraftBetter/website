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
    <link href="assets/css/main.css" rel="stylesheet"/>
</head>

<body class="details">
<div class="mx-auto">
    <header class="masthead mb-auto" style="color: var(--white);">
        <div class="inner">
            <a href="/"><img class="masthead-brand" src="/assets/img/logos/justbetter.png" alt="Just Better"/></a>
        </div>
        <div class="text-center sites" id="introduction">
            <button class="btn text-white site" data-article="jellyfinbetter" data-maincolor="#868DDC" data-secondarycolor="#666ca9">
                <img src="/assets/img/logos/jellyfinbetter.png" class="presentation-icon" alt="Jellyfin Better logo"/>
                <span>Jellyfin Better</span>
            </button>
            <button class="btn text-white site" data-article="betterplace" data-maincolor="#47cc5d" data-secondarycolor="#359945">
                <img src="/assets/img/logos/betterplace.png" class="presentation-icon" alt="Better Place logo"/>
                <span>Better Place</span>
            </button>
            <button class="btn text-white site" data-article="minecraftbetter" data-maincolor="#ff5050" data-secondarycolor="#cc4040">
                <img src="/assets/img/logos/minecraftbetter.png" class="presentation-icon" alt="Minecraft Better logo"/>
                <span>Minecraft Better</span>
            </button>
            <button class="btn text-white site" data-article="gameyfin" data-maincolor="#ff9932" data-secondarycolor="#e3702d">
                <img src="/assets/img/logos/gameyfin.png" class="presentation-icon" alt="Gameyfin logo"/>
                <span>Gameyfin</span>
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
                    Le catalogue est constamment enrichi grâce à vos requêtes faites sur <a href="https://request.jellyfinbetter.fr">la plateforme dédiée</a>.<br/>
                    S'il a un problème avec un des films/séries/animés, merci de le signaler sur cette <a href="https://request.jellyfinbetter.fr">même plateforme</a>.
                </p>
                <p>
                    Il est nécessaire de disposer d'un compte pour pouvoir utiliser ce service, pour en créer un, utilisez <a href="https://jfago.jellyfinbetter.fr/invite/tM7jmbFsFGL2tLuYdRFyTT">l'assistant</a>.<br/>
                    Toute personne créant un compte est tenue de rejoindre <a href="https://discord.gg/7g7AURRjmX">notre Discord</a> et d'y rester sous peine d'un
                    bannissement.<br/>
                    <small>(merci de contacter <strong><em>Tiago#9070</em></strong> pour toute contestation)</small><br/>
                    Cette mesure nous permet de pouvoir communiquer avec vous si des changements importants ont lieu.
                </p>
                <p>
                    Toute personne étrangère à l'équipe d'administration peut faire l'objet d'un bannissement temporaire, le temps d'établir contact avec elle afin de savoir qui
                    l'as invitée sur le service.<br/>
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
                    Sur le client, veuillez entrer <code>https://jellyfin.jellyfinbetter.fr/</code> en tant qu'adresse du serveur.
                </p>
                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://jellyfin.jellyfinbetter.fr/" class="btn btn-lg">
                        <i class="fas fa-photo-video"></i>Jellyfin
                    </a>
                    <a href="https://request.jellyfinbetter.fr/" class="btn btn-lg">
                        <i class="fas fa-bullhorn"></i>Requêtes / Problèmes
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

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://place.justbetter.fr/" class="btn btn-lg">
                        <i class="fas fa-photo-video"></i>Accéder au service
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
                <p></p>

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://minecraft.justbetter.fr/" class="btn btn-lg">
                        <i class="fas fa-photo-video"></i>Accéder au service
                    </a>
                </p>
            </article>
            <article class="site-details" id="gameyfin">
                <div class="head d-flex mb-4">
                    <img src="/assets/img/logos/gameyfin.png" alt="Gameyfin logo" style="height:75px;"/>
                    <div class="ml-3 d-flex flex-column justify-content-center">
                        <h2 class="mb-0">Gameyfin</h2>
                        <p class="mb-0"></p>
                    </div>
                </div>
                <p></p>

                <p class="lead" id="buttons" style="flex-wrap: wrap; text-align: center;">
                    <a href="https://gameyfin.jellyfinbetter.fr/" class="btn btn-lg">
                        <i class="fas fa-photo-video"></i>Accéder au service
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
        </div>
    </footer>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
