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
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png"/>
    <link rel="icon" type="image/png" href="/assets/img/favicon.png"/>

    <title>Just Better - Gameyfin</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/assets/css/fontawesome.min.css" rel="stylesheet"/>
    <link href="/assets/css/main.css" rel="stylesheet"/>
</head>

<body class="d-flex align-items-center">
<div class="mx-auto">
    <main role="main">
        <div class="d-flex flex-column w-100 introduction overflow-hidden" style="min-height: unset;">
            <div class="text-center" style="position: relative;">
                <img src="/assets/img/logos/gameyfin.png" href="#" alt="Gameyfin logo" class="presentation-icon"/>
                <h1 style="margin-bottom: 2.5rem;">Gameyfin</h1>
                <p class="lead">La plateforme à laquelle vous accédez ne contient que des jeux <strong>sans DRM</strong> obtenus de manière <strong>légale</strong>.</p>
                <p class="lead">Si vous souhaitez participer à l'étoffement du catalogue, merci de contacter <strong><em>mikaleplubo</em></strong>.</p>
                <p class="lead">Dû à la quantité de jeux mis à votre disposition, tous n'ont pu être testé,<br/>si un jeu ne se lance pas, merci de nous en informer.</p>
                <p class="lead" id="buttons" style="flex-wrap: wrap; margin-top: 2.5rem; justify-content: center;">
                    <a href="#" data-link="library" class="btn btn-lg btn-dark" style="max-width: 500px;" id="goToService">Accéder au catalogue</a>
                </p>
            </div>
        </div>
    </main>
</div>
<script>
    const attempts = Math.max(Math.ceil(Math.random() * 25), 3);
    const msg = ["Nope", "Try again", "Not this time", "Maybe now ?", "I'm sure it will work", "F**k", "Thanks Tiago for this", "Will it end some day ?", "I totally hate this", "Because Tiago LOVES clicks", "This is NOT FUNNY !!!", "(╯°□°）╯︵ ┻━┻"];
    const aTag = document.getElementById("goToService");
    let attempt = 0;

    console.log("Clicks needed: " + attempts);
    aTag.addEventListener("click", (e) => {
        if (attempt >= attempts) {
            aTag.href = aTag.dataset.link;
            return;
        }
        e.preventDefault();
        attempt++;
        aTag.innerText = msg[Math.floor(Math.random() * msg.length)];
        aTag.style.position = "absolute";
        aTag.style.top = (80 * Math.random()) + "%";
        aTag.style.left = (80 * Math.random()) + "%";
        console.log(attempt + " / " + attempts);
    });
</script>
</body>
</html>
