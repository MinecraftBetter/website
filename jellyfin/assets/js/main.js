$(document).ready(function () {
  navmenuColor();
  localize();
});

$(function () {
  $(document).scroll(navmenuColor);
});

function navmenuColor() {
  var $nav = $("header");
  if ($("content").length) $nav.toggleClass("scrolled", $(document).scrollTop() > $("content").offset().top - $nav.height() - 30);
  else $nav.removeClass("scrolled");
}

function localize() {
  $.ajax("languages/" + (Cookies.get("language") ?? "french") + ".json", { dataType: "json" }).done(function (data) {
    $("[id*=txt-]").each(function () {
      $(this).html(data[$(this).attr("id")]);
    });
    $("[id*=beer-]").each(function () {
      $(this).attr("data-beer-label", data[$(this).attr("id")]);
    });
    $("body").trigger("localized");
  });
}
function changeLanguage(lang) {
  Cookies.set("language", lang, { sameSite: 'Lax', expires: 365 });
  localize();
}