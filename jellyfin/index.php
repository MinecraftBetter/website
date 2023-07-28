<?php
/**********************
 * Made by Evan Galli *
 **********************/

$jellyfin_url = "https://jellyfin.justbetter.fr/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png"/>
    <link rel="icon" type="image/png" href="img/favicon.png"/>

    <title>Jellyfin Better</title>
    <link rel="canonical" href="https://justbetter.fr/jellyfin"/>
    <meta name="description" content="Jellyfin Better: Jellyfin but... better ¯\_(ツ)_/¯">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/assets/css/fontawesome.min.css" rel="stylesheet"/>
    <link href="/assets/css/twemoji-amazing.css" rel="stylesheet"/>
    <link href="/assets/css/landing.css" rel="stylesheet"/>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/js.cookie.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/landing.js"></script>
</head>

<body>
<div class="mx-auto">
    <header class="masthead mb-auto scrolled" style="color: var(--white)">
        <div class="inner">
            <a href="/"><img class="masthead-brand" src="img/banner.png" style="height: 4.5em;" alt="Banner" /></a>
            <nav class="p-3 nav nav-masthead justify-content-center">
                <a class="nav-link active" href="/"><i class="fas fa-home" aria-hidden="true"></i> <span id="txt-home">Home</a>
                <a class="nav-link" href="https://status.justbetter.fr/"><i class="fas fa-server" aria-hidden="true"></i> <span id="txt-status">Status</span></a>
                <a class="nav-link" href="https://discord.gg/7g7AURRjmX"><i class="fab fa-discord" aria-hidden="true"></i> <span id="txt-discord">Discord</span></a>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="language" data-toggle="dropdown"><i class="fas fa-language" aria-hidden="true"></i></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:changeLanguage('english')"><i class="twa twa-flag-united-kingdom" aria-hidden="true"></i>English</a>
                        <a class="dropdown-item" href="javascript:changeLanguage('french')"><i class="twa twa-flag-france" aria-hidden="true"></i>Français</a>
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
                    $files = glob('img/home/background/*.{jpg,png,gif}', GLOB_BRACE);
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
				<iframe src="img/animated-logo.html" class="presentation-icon" id="logo-frame" height="250" title="Logo"></iframe>
				
                <h1 id="txt-title">Jellyfin Better</h1>
                <p class="lead" id="txt-subtitle">Jellyfin but... better ¯\_(ツ)_/¯</p>
                <p class="lead" id="buttons" style="flex-wrap: wrap;">
                    <a href="https://request.justbetter.fr/" class="btn btn-lg btn-darkblue">
                        <i class="fas fa-bullhorn" aria-hidden="true"></i><span id="txt-jellyseerr">Requests / Issues</span>
                    </a>
                </p>
            </div>
        </div>
    </main>
</div>
</body>
</html>
