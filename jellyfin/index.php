<?php
/**********************
 * Made by Evan Galli *
 **********************/

$jellyfin_url = "https://jellyfin.jellyfinbetter.fr/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"/>
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>

    <title>Jellyfin Better</title>
    <link rel="canonical" href="https://jellyfinbetter.fr"/>
    <meta name="description" content="Jellyfin Better: Jellyfin but... better ¯\_(ツ)_/¯">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/assets/css/fontawesome.min.css" rel="stylesheet"/>

    <link href="assets/css/main.css" rel="stylesheet"/>
    <link href="assets/css/twemoji-amazing.css" rel="stylesheet"/>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/js.cookie.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</head>

<body>
<div class="mx-auto">
    <header class="masthead mb-auto scrolled" style="color: var(--white)">
        <div class="inner">
            <a href="/"><img class="masthead-brand" src="assets/img/banner.png" style="height: 4.5em;"/></a>
            <nav class="p-3 nav nav-masthead justify-content-center">
                <a class="nav-link active" href="/"><i class="fas fa-home"></i> <span id="txt-home">Home</a>
                <a class="nav-link" href="http://status.jellyfinbetter.fr/"><i class="fas fa-server"></i> <span id="txt-status">Status</span></a>
                <a class="nav-link" href="https://discord.gg/7g7AURRjmX"><i class="fab fa-discord"></i> <span id="txt-discord">Discord</span></a>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="language" data-toggle="dropdown"><i class="fas fa-language"></i></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:changeLanguage('english')"><i class="twa twa-flag-united-kingdom"></i>English</a>
                        <a class="dropdown-item" href="javascript:changeLanguage('french')"><i class="twa twa-flag-france"></i>Français</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main role="main">
        <div class="d-flex flex-column w-100 introduction">
            <div class="carousel slide carousel-fade fullscreen-image" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $files = glob('assets/img/home/background/*.{jpg,png,gif}', GLOB_BRACE);
                    $class = "active";
                    foreach ($files as $file) { ?>
                        <div class="carousel-item <?= $class ?>">
                            <div style="background-image: url('<?= $file ?>');" class="img"></div>
                        </div>
                        <?php $class = "";
                    } ?>
                </div>
            </div>
            <div class="text-center">
                <!--<img src="assets/img/home/icon.png" href="#" class="presentation-icon"/>-->
				<iframe src="assets/img/animated-logo.html" class="presentation-icon" id="logo-frame" height="250" frameborder="0"></iframe>
				
                <h1 id="txt-title">Jellyfin Better</h1>
                <p class="lead" id="txt-subtitle">Jellyfin but... better ¯\_(ツ)_/¯</p>
                <p class="lead" id="buttons" style="flex-wrap: wrap;">
                    <a href="<?= $jellyfin_url ?>" class="btn btn-lg btn-primary">
                        <i class="fas fa-photo-video"></i><span id="txt-jellyfin">Jellyfin</span>
                    </a>
                    <span style="width: 100vw;"></span>
                    <a href="https://request.justbetter.fr/" class="btn btn-lg btn-darkblue">
                        <i class="fas fa-bullhorn"></i><span id="txt-jellyseerr">Requests / Issues</span>
                    </a>
                </p>
            </div>
        </div>


        <content class="panel d-block mb-5">
            <div class="alert alert-warning d-flex align-items-center mb-5" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <div id="txt-use-clients">
                    Please use clients and not the browser to stream from Jellyfin, this increases our hosting capacity considerably
                </div>
            </div>

            <section id="installation">
                <h3 id="txt-install">Installation</h3>
                <article>
                    <ol>
                        <li class="mt-2 mb-2">
                            <span id="txt-client-desktop">Install one of theses clients</span>
                            <a href="https://github.com/jellyfin/jellyfin-media-player/releases/download/v1.9.1/JellyfinMediaPlayer-1.9.1-windows-x64.exe" class="btn btn-sm btn-success">
                                <i class="fab fa-windows"></i> <span id="windows">Windows</span>
                            </a>
                            <a href="https://github.com/jellyfin/jellyfin-media-player/releases/download/v1.9.1/JellyfinMediaPlayer-1.9.1-macos-notarized.dmg" class="btn btn-sm btn-success">
                                <i class="fab fa-apple"></i> <span id="macos">MacOS</span>
                            </a>
                            <a href="https://github.com/jellyfin/jellyfin-media-player/releases/" class="btn btn-sm btn-success">
                                <i class="fab fa-linux"></i> <span id="linux">Linux</span>
                            </a>
                            <span id="txt-client-mobile">or if you are on mobile</span>
                            <a href="https://apps.apple.com/ca/app/swiftfin/id1604098728" class="btn btn-sm btn-success">
                                <i class="fab fa-app-store-ios"></i> <span id="ios">iOS</span>
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=dev.jdtech.jellyfin" class="btn btn-sm btn-success">
                                <i class="fab fa-android"></i> <span id="android">Android</span>
                            </a>
                        </li>
                        <li class="mb-2"><span id="txt-address-1">Then in the client, enter</span> <code><?= $jellyfin_url ?></code> <span id="txt-address-2">as the server address</span></li>
                        <li class="mb-2">
                            <span id="txt-login">Login with your credentials</span>
                            <br/>
                            <small>
                                <i>
                                    <span id="txt-no-account">if you don't have an account, you can create one using</span>
                                    <a href="https://jfago.justbetter.fr/invite/tM7jmbFsFGL2tLuYdRFyTT" class="btn btn-sm btn-info">
                                        <i class="fas fa-user"></i><span id="txt-jfago">Create account</span>
                                    </a>
                                </i>
                            </small>
                        </li>
                        <li class="mb-2" id="txt-enjoy">Enjoy !</li>
                    </ol>
                </article>
            </section>
        </content>
    </main>

    <footer class="mt-auto text-center">
        <div class="inner">
            <p><span id="txt-credit-website">This website was made with ❤ by</span> <a href="https://github.com/06Games" style="font-weight: 600;">Evan Galli</a></p>
            <p><span id="txt-credit-server">This server is generously hosted by</span> <a href="https://github.com/Tiagoez" style="font-weight: 600;">Tiago Procopio</a></p>
        </div>
    </footer>
</div>
</body>
</html>
