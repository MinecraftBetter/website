<?php http_response_code(403); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jellyfin Better</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .jumbotron { margin-top: 50px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
					<small>Erreur 403</small>
               <h1>Nous avons detecté un navigateur 😑</h1>
               <p>Comme spécifié dans la description du service (que vous avez bien entendu lu, n'est-ce pas), les navigateurs ne sont pas autorisés sur ce service pour des raisons d'utilisation des ressources serveur.</p>
					<p>Merci de télécharger un client Jellyfin, une liste non-exaustive vous est proposée <a href="https://justbetter.fr/details#jellyfinbetter">ici</a></p>
					<p>Si vous pensez que ce message est une erreur, merci de contacter <b><em>evang_</em></b> sur Discord</p>
            </div>
        </div>
		  <script>
				window.onload = () => {
					let searchParams = new URLSearchParams(window.location.search);
                    if(searchParams.has("bypass")){
                        document.cookie = "bypass=" + searchParams.get("bypass") + ";domain=.justbetter.fr;path=/;secure=true;sameSite=none";
                        window.location =searchParams.get("url");
                        return;
                    }

					let url = new URL(window.location);
					url.searchParams.set("bypass", "true");
					colorTrace("If you know what you're doing you can bypass this check", "lightblue", 20);
					colorTrace(url.href, "lightblue", 15);
					colorTrace("Please note that it will only bypass for this specific request and that the plateform still won't be usable.", "red", 15);
				};
				function colorTrace(msg, color, size) {
					console.log("%c" + msg, "color:" + color + ";font-weight:bold;font-size:" + size + "pt");
				}
		  </script>
    </body>
</html>
