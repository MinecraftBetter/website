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

    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
<div class="mx-auto">
    <header class="masthead mb-auto scrolled p-4" style="color: var(--white)">
        <div class="inner">
            <a href="/"><img class="masthead-brand" src="/assets/img/banner.png" style="height: 3.5rem;" alt="Just Better"/></a>
        </div>
    </header>

    <main role="main">
        <div class="d-flex flex-column w-100 introduction">
            <!--<div class="carousel slide carousel-fade fullscreen-image" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $files = glob('assets/img/home/background/*.{jpg,png,gif}', GLOB_BRACE);
                    $class = "active";
                    foreach ($files as $file) { ?>
                        <div class="carousel-item <?= $class ?>">
                            <div style="background-image: url('<?= $file ?>')" class="img"></div>
                        </div>
                        <?php $class = "";
                    } ?>
                </div>
            </div>-->
            <div class="text-center d-flex sites mw-100 justify-content-center">
                <a href="https://jellyfinbetter.fr" class="site">
                    <img src="/assets/img/logos/jellyfinbetter.png" href="#" class="presentation-icon" alt="Jellyfin Better logo" />
                    <h2>Jellyfin Better</h2>
                </a>
                <?php
                /*
                <a href="https://jellybook.jellyfinbetter.fr" class="site">
                    <img src="/assets/img/logos/jellybook.png" href="#" class="presentation-icon" alt="Jellybook logo" />
                    <h2>Jellybook</h2>
                </a>
                <a href="https://jellysong.jellyfinbetter.fr" class="site">
                    <img src="/assets/img/logos/jellysong.png" href="#" class="presentation-icon" alt="jellysong logo" />
                    <h2>Jellysong</h2>
                </a>
                 */
                ?>
                <a href="https://place.minecraftbetter.com" class="site">
                    <img src="/assets/img/logos/betterplace.png" href="#" class="presentation-icon" alt="Better Place logo" />
                    <h2>Better Place</h2>
                </a>
                <a href="https://minecraftbetter.com" class="site">
                    <img src="/assets/img/logos/minecraftbetter.png" href="#" class="presentation-icon" alt="Minecraft Better logo" />
                    <h2>Minecraft Better</h2>
                </a>
                <a href="https://gameyfin.jellyfinbetter.fr" class="site">
                    <img src="/assets/img/logos/gameyfin.png" href="#" class="presentation-icon" alt="Gameyfin logo" />
                    <h2>Gameyfin</h2>
                </a>
            </div>
        </div>
    </main>

    <footer class="mt-auto text-center">
        <div class="inner">
            <p><span id="txt-credit">This website was made with ❤ by</span> <a href="https://github.com/06Games" style="font-weight: 600;">Evan Galli</a></p>
            <p><span id="txt-credit-server">This server is generously hosted by</span> <a href="https://github.com/Tiagoez" style="font-weight: 600;">Tiago Procopio</a></p>
        </div>
    </footer>
</div>
</body>
</html>
