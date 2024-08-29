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
    <link rel="icon" type="image/png" href="/assets/img/logos/gameyfin.png"/>

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
            grid-template-columns: repeat(auto-fit, 225px);
            grid-auto-rows: 300px;
            justify-content: center;
            grid-gap: 18.75px;
        }

        .game {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .game img {
            height: 100%;
            max-width: 100%;
            min-width: 0;
            min-height: 0;
        }

        #game-info .modal-content {
            background-size: cover;
            background-position: center;
        }

        #game-info .modal-content > div {
            backdrop-filter: blur(5px) grayscale(0.2) brightness(0.5);
            -webkit-backdrop-filter: blur(5px) grayscale(0.2) brightness(0.5);
            background-color: rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="d-flex details">
<div class="mx-auto">
    <header class="masthead mb-auto" style="color: var(--white); grid-template: 3rem/200px 1fr;">
        <div class="inner">
            <a href="/"><img class="masthead-brand" src="/assets/img/banners/gameyfin.png" alt="GameVault"/></a>
        </div>
        <div class="d-flex justify-content-end align-items-center">
            <select id="sort_by" class="custom-select mr-3" style="max-width: 10rem;">
                <option value="title:ASC">Titre ↑</option>
                <option value="title:DESC">Titre ↓</option>
                <option value="created_at:ASC">Date d'ajout ↑</option>
                <option value="created_at:DESC">Date d'ajout ↓</option>
                <option value="release_date:ASC">Date de sortie ↑</option>
                <option value="release_date:DESC">Date de sortie ↓</option>
            </select>
            <input id="search" class="form-control" style="max-width: 15em;" type="search" placeholder="Search" aria-label="Search">
        </div>
    </header>

    <main role="main" style="padding-top: 4rem;">
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
            <div class="modal-header">
                <div style="height: 15em;" class="mr-4">
                    <img id="game-cover" class="h-100" alt="cover"/>
                </div>
                <div class="flex-grow-1 d-flex flex-column">
                    <h5 class="modal-title" id="game-title">Game title</h5>
                    <small><i class="fas fa-calendar-plus" aria-hidden="true"></i><span id="game-added"></span></small>
                    <small><i class="fas fa-calendar" aria-hidden="true"></i><span id="game-release"></span></small>
                    <small><i class="fas fa-code-branch" aria-hidden="true"></i><span id="game-version"></span></small>
                    <small><i class="fas fa-globe" aria-hidden="true"></i><a id="game-website">Website</a></small>
                    <small><i class="fas fa-comments" aria-hidden="true"></i><span id="game-metacritic"></span></small>
                    <small><i class="fas fa-paper-plane" aria-hidden="true"></i><span id="game-publishers"></span></small>
                    <small><i class="fas fa-code" aria-hidden="true"></i><span id="game-developers"></span></small>
                    <small><i class="fas fa-store-alt" aria-hidden="true"></i><span id="game-stores"></span></small>
                    <small><i class="fas fa-tags" aria-hidden="true"></i><span id="game-tags"></span></small>
                    <small><i class="fas fa-swatchbook" aria-hidden="true"></i><span id="game-genres"></span></small>
                </div>
            </div>
            <div class="modal-body">
                <p id="game-desc"></p>
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
    let totalPages = 1;

    window.onscroll = function () {
        const scrollHeight = document.body.scrollHeight;
        const totalHeight = window.scrollY + window.innerHeight;
        if (totalHeight >= scrollHeight) {
            console.log("At the bottom, loading more content");
            getGames(query["page"] + 1);
        }
    }

    const sortField = document.getElementById("sort_by");
    const searchField = document.getElementById("search");
    sortField.onchange = searchField.onchange = function () {
        while (gameList.lastElementChild) gameList.removeChild(gameList.lastElementChild);
        getGames();
    };

    async function getGames(page) {
        if (!page) page = 1;
        if (page > totalPages) return;
        query["page"] = page;
        query["limit"] = 50;
        query["sortBy"] = sortField.value;
        query["search"] = searchField.value;

        const response = await (await fetch(getUrl("/games?" + new URLSearchParams(query).toString()))).json();
        const games = response.data;
        totalPages = response.meta.totalPages;
        if (totalPages < 1) totalPages = 1;

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
        modalNode.querySelector("#game-release").innerText = new Date(openedGame.release_date).toDateString();
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
        modalNode.querySelector("#game-cover").src = getUrl("/images/" + openedGame.box_image.id);
        modalNode.querySelector(".modal-content").style.backgroundImage = "url(" + getUrl("/images/" + openedGame.background_image.id) + ")";
    }

    getGames();
</script>
</body>
</html>



