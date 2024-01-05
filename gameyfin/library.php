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

    <style>
        body {
            --primary: #ff9932;
            --secondary: #e3702d;
        }

        main {
            width: 1200px;
            max-width: 100vw;
        }

        #game-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, 200px);
            grid-auto-rows: 250px;
            justify-content: center;
            grid-gap: 10px;
        }

        .game {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .game img {
            height: 100%;
            max-width: 100%;
        }
    </style>
</head>

<body class="d-flex">
<div class="mx-auto">
    <main role="main">
        <div id="game-list" class="my-4">
            <template id="game-item">
                <button class="game btn btn-lg btn-dark">
                    <img class="game-cover" alt="cover" src="">
                    <span class="game-title"></span>
                </button>
            </template>
        </div>
    </main>
</div>

<div class="modal fade" id="game-info" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <h5 class="modal-title" id="game-title">Game title</h5>
                <small><i class="fas fa-calendar-plus" aria-hidden="true"></i><span id="game-added"></span></small>
                <small><i class="fas fa-code-branch" aria-hidden="true"></i><span id="game-version"></span></small>
                <small><i class="fas fa-globe" aria-hidden="true"></i><a id="game-website">Website</a></small>
                <small><i class="fas fa-comments" aria-hidden="true"></i><span id="game-metacritic"></span></small>
                <small><i class="fas fa-paper-plane" aria-hidden="true"></i><span id="game-publishers"></span></small>
                <small><i class="fas fa-code" aria-hidden="true"></i><span id="game-developers"></span></small>
                <small><i class="fas fa-store-alt" aria-hidden="true"></i><span id="game-stores"></span></small>
                <small><i class="fas fa-tags" aria-hidden="true"></i><span id="game-tags"></span></small>
                <small><i class="fas fa-swatchbook" aria-hidden="true"></i><span id="game-genres"></span></small>
            </div>
            <div class="modal-body">
                <p id="game-desc"></p>
                <p class="text-center"><img id="game-screenshot" class="mw-100" style="max-height: 300px;" alt="background" src=""/></p>
                <div class="progress" style="display: none;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-custom-primary" id="downloadBtn">Download (<span id="game-size"></span>)</button>
            </div>
        </div>
    </div>
</div>


<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/showdown.min.js"></script>
<script>
    const backend = "https://clientgameyfin.justbetter.fr/api";
    const markdownConverter = new showdown.Converter();

    function getUrl(endpoint) {
        return backend + endpoint;
    }

    let openedGame;
    const modalNode = document.getElementById('game-info');
    document.getElementById("downloadBtn").onclick = () => window.open(getUrl("/games/" + openedGame.id + "/download"), "_blank");

    const gameList = document.getElementById("game-list");
    const itemTemplate = document.getElementById("game-item");
    let query = {};

    window.onscroll = function () {
        const scrollHeight = document.body.scrollHeight;
        const totalHeight = window.scrollY + window.innerHeight;
        if (totalHeight >= scrollHeight) {
            console.log("At the bottom, loading more content");
            getGames(query["page"] + 1);
        }
    }

    async function getGames(page = 1) {
        if (page) query["page"] = page;

        const response = await fetch(getUrl("/games?" + new URLSearchParams(query).toString()));
        const games = (await response.json()).data;

        for (const game of games) {
            const item = document.importNode(itemTemplate.content, true).firstElementChild;
            gameList.appendChild(item);
            item.onclick = () => openGameInfo(game);

            item.querySelector(".game-title").innerHTML = game.rawg_title + (game.title !== game.rawg_title ? '<br/><small style="font-size:.5em;">[' + game.title + "]</small>" : "");
            item.querySelector(".game-cover").src = getUrl("/images/" + game.box_image.id);
        }
    }

    async function openGameInfo(game) {
        openedGame = await (await fetch(getUrl("/games/" + game.id))).json();
        $(modalNode).modal('show');

        modalNode.querySelector("#game-title").innerHTML = game.rawg_title + (game.title !== game.rawg_title ? " <small>[" + game.title + "]</small>" : "");
        modalNode.querySelector("#game-added").innerText = new Date(openedGame.created_at).toDateString();
        modalNode.querySelector("#game-version").innerText = openedGame.version ?? "Unknown";
        modalNode.querySelector("#game-website").href = openedGame.website_url ?? "#";
        modalNode.querySelector("#game-metacritic").innerText = openedGame.metacritic_rating ? (openedGame.metacritic_rating + " / 100") : "Unknown";
        modalNode.querySelector("#game-publishers").innerText = openedGame.publishers.map(p => p.name).join(", ");
        modalNode.querySelector("#game-developers").innerText = openedGame.developers.map(p => p.name).join(", ");
        modalNode.querySelector("#game-stores").innerText = openedGame.stores.map(p => p.name).join(", ");
        modalNode.querySelector("#game-tags").innerText = openedGame.tags.map(p => p.name).join(", ");
        modalNode.querySelector("#game-genres").innerText = openedGame.genres.map(p => p.name).join(", ");
        modalNode.querySelector("#game-desc").innerHTML = markdownConverter.makeHtml(openedGame.description);
        modalNode.querySelector("#game-size").innerText = (openedGame.size / 1000000000).toFixed(2) + " Go";
        modalNode.querySelector("#game-screenshot").src = getUrl("/images/" + openedGame.background_image.id);
    }

    getGames();
</script>
</body>
</html>



