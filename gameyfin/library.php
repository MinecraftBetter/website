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
            background-image: linear-gradient(to right top, #83511c, #84511e, #845120, #855222, #855224, #865327, #875529, #88562c, #8a5830, #8c5a34, #8e5c38, #905e3c);
        }

        #game-preview {
            display: flex;
            gap: 5px;
            overflow-y: hidden;
            overflow-x: visible;
        }

        #game-preview > * {
            height: 15em;
        }

        .alert:has(#game-notes:empty) {
            display: none;
        }
    </style>
</head>

<body class="d-flex details">
<div class="mx-auto">
    <header class="masthead mb-auto" style="color: var(--white); grid-template: 3rem / auto 1fr; gap: 1rem;">
        <div class="inner">
            <a href="/">
                <img class="masthead-brand d-none d-md-inline-block" src="/assets/img/banners/gameyfin.png" alt="GameVault"/>
                <img class="masthead-brand d-inline-block d-md-none" src="/assets/img/logos/gameyfin.png" alt="GameVault"/>
            </a>
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
         style="margin: 1.5em;width: calc(100% - 3em);height: calc(100% - 3em);max-width: unset;min-width: unset;max-height: unset;min-height: unset;">
        <div class="modal-content w-100 h-100" style="overflow-y: auto">
            <div class="modal-header align-items-center flex-column flex-md-row">
                <div style="height: 15em;" class="mr-md-4">
                    <img id="game-cover" class="h-100" src="" alt="cover" style="border-radius: .75em;"/>
                </div>
                <div class="flex-grow-1 d-flex flex-column text-center text-md-left">
                    <h5 class="modal-title">
                        <strong id="game-title" style="font-size: 2.25rem;"></strong>
                        <small id="game-filename" class="d-none d-md-inline" style="color: lightgray;"></small>
                    </h5>
                    <small class="d-none d-md-inline"><i class="fas fa-calendar-plus" aria-hidden="true" title="Game added at"></i><span
                                id="game-added"></span></small>
                    <small class="d-none d-md-inline"><i class="fas fa-calendar" aria-hidden="true" title="Game released at"></i><span
                                id="game-release"></span></small>
                    <small><i class="fas fa-code-branch" aria-hidden="true" title="Game version"></i><span id="game-version"></span></small>
                    <small class="d-none d-md-inline"><i class="fas fa-globe" aria-hidden="true"></i><a id="game-website">Website</a></small>
                    <small class="d-none d-md-inline"><i class="fas fa-comments" aria-hidden="true" title="Game reviews"></i><span
                                id="game-metacritic"></span></small>
                    <small class="d-none d-md-inline"><i class="fas fa-paper-plane" aria-hidden="true" title="Game publishers"></i><span
                                id="game-publishers"></span></small>
                    <small class="d-none d-md-inline"><i class="fas fa-code" aria-hidden="true" title="Game developers"></i><span id="game-developers"></span></small>
                    <small class="d-none d-md-inline"><i class="fas fa-tags" aria-hidden="true" title="Game tags"></i><span id="game-tags"></span></small>
                    <small class="d-none d-md-inline"><i class="fas fa-swatchbook" aria-hidden="true" title="Game genres"></i><span id="game-genres"></span></small>
                </div>
            </div>
            <div class="modal-body" style="overflow: unset;">
                <div class="alert alert-dark" role="alert">
                    <p class="mb-2"><strong><i class="fas fa-info-circle" aria-hidden="true"></i> Notes</strong></p>
                    <span id="game-notes"></span>
                </div>
                <div id="game-preview" class="mb-3">
                </div>
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
    sortField.onchange = searchField.oninput = function () {
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

            item.querySelector(".game-title").innerHTML = (game.metadata ? game.metadata.title : game.title) + (game.version ? "<br/><small style=\"color: #aaa;\"><em>" + game.version + "</em></small>" : "");
            item.querySelector(".game-cover").src = game.metadata ? getUrl("/media/" + game.metadata.cover.id) : "";
        }
    }

    async function openGameInfo(game) {
        openedGame = await (await fetch(getUrl("/games/" + game.id))).json();
        $(modalNode).modal('show');

        modalNode.querySelector("#game-title").innerText = game.metadata.title;
        modalNode.querySelector("#game-filename").innerText = game.title.toLowerCase() !== game.metadata.title.toLowerCase() ? game.title : "";
        modalNode.querySelector("#game-added").innerText = openedGame.created_at ? new Date(openedGame.created_at).toDateString() : "Unknown";
        modalNode.querySelector("#game-release").innerText = openedGame.release_date ? new Date(openedGame.release_date).toDateString() : "Unknown";
        modalNode.querySelector("#game-version").innerText = openedGame.version ?? "Unknown";
        modalNode.querySelector("#game-website").href = openedGame.metadata?.url_websites?.[0] ?? "#";
        modalNode.querySelector("#game-metacritic").innerText = openedGame.metadata?.rating ? (openedGame.metadata.rating.toFixed(0) + " %") : "Unknown";
        modalNode.querySelector("#game-publishers").innerText = openedGame.metadata?.publishers.map(p => p.name).join(", ");
        modalNode.querySelector("#game-developers").innerText = openedGame.metadata?.developers.map(p => p.name).join(", ");
        modalNode.querySelector("#game-tags").innerText = openedGame.metadata?.tags.map(p => p.name).join(", ");
        modalNode.querySelector("#game-genres").innerText = openedGame.metadata?.genres.map(p => p.name).join(", ");
        modalNode.querySelector("#game-desc").innerHTML = markdownConverter.makeHtml(openedGame.metadata?.description);
        modalNode.querySelector("#game-notes").innerHTML = markdownConverter.makeHtml(openedGame.metadata?.notes);
        modalNode.querySelector("#game-size").innerText = (openedGame.size / 1000000000).toFixed(2) + " Go";
        modalNode.querySelector("#game-cover").src = openedGame.metadata ? getUrl("/media/" + openedGame.metadata.cover.id) : "";

        let carousel = modalNode.querySelector("#game-preview");
        carousel.innerHTML = "";
        for (let screenshot of openedGame.metadata.url_screenshots) {
            let img = document.createElement("img");
            img.src = screenshot;
            carousel.appendChild(img);
        }
        for (let trailer of openedGame.metadata.url_trailers) {
            let video = document.createElement("iframe");
            video.src = trailer.replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/");
            video.setAttribute("frameborder", "0");
            video.setAttribute("allow", "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share");
            video.setAttribute("allowfullscreen", "true");
            carousel.appendChild(video);
        }
    }

    getGames();
</script>
</body>
</html>



