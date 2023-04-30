let selectedSite = location.hash.slice(1);
for (let site of document.getElementsByClassName("site")) {
    changeColor(document.getElementById(site.dataset.article), site);
    site.addEventListener("click", function() { changeSite(this); });
    if(site.dataset.article === selectedSite) changeSite(site);
}

function changeColor(elem, btn){
    elem.style.setProperty('--primary', btn.dataset.maincolor);
    elem.style.setProperty('--secondary', btn.dataset.secondarycolor);
}

function changeSite(btn) {
    changeColor(document.querySelector("header.masthead"), btn);

    for (let s of document.getElementsByClassName("site")) {
        if (s === this) btn.classList.add("clicked");
        else s.classList.remove("clicked");
    }

    location.hash = "#" + btn.dataset.article;
    window.scrollTo({
        top: document.getElementById(btn.dataset.article).offsetTop - 5.5 * parseFloat(getComputedStyle(document.documentElement).fontSize),
        behavior: 'smooth'
    });
}
