for (let site of document.getElementsByClassName("site")) site.addEventListener("click", changeSite);

function changeSite(){
    let button = this;
    let siteList = document.getElementById("introduction");
    let wasSmall = siteList.classList.contains("small");
    if (!wasSmall) siteList.classList.add("small");

    for (let s of document.getElementsByClassName("site")) {
        if (s === button) button.classList.add("clicked");
        else s.classList.remove("clicked");
    }

    setTimeout(function () {
        let detailPanelList = document.getElementById("details");
        detailPanelList.classList.remove("d-none");
        detailPanelList.classList.add("d-flex");

        for (let article of document.getElementsByClassName("site-details")) {
            if (article.id === button.dataset.article) article.classList.remove("hidden");
            else article.classList.add("hidden");
        }
    }, wasSmall ? 0 : 1000);
}
