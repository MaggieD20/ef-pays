(function () {
    console.log("rest API")
    // URL de l'API REST de WordPress


    let boutons_pays = document.querySelectorAll(".bouton__pays");

    let pays = "France";
    let url = `https://gftnth00.mywhc.ca/tim37/wp-json/wp/v2/posts?search=${pays}`;
    restApiPays(url);
    for (const elm of boutons_pays) {

        elm.addEventListener("mousedown", function (e) {
            let paysActif = e.target.innerHTML;
            url = `https://gftnth00.mywhc.ca/tim37/wp-json/wp/v2/posts?search=${paysActif}`;

            restApiPays(url);
        });
    }



    function restApiPays(url) {
        // Effectuer la requête HTTP en utilisant fetch()
        fetch(url)
            .then(function (response) {
                // Vérifier si la réponse est OK (statut HTTP 200)
                if (!response.ok) {
                    throw new Error(
                        "La requête a échoué avec le statut " + response.status
                    );
                }

                // Analyser la réponse JSON
                return response.json();
                console.log(response.json());
            })
            .then(function (data) {
                // La variable "data" contient la réponse JSON
                console.log(data);
                let restapi = document.querySelector(".contenu__restapi");
                restapi.innerHTML = "";
                // Maintenant, vous pouvez traiter les données comme vous le souhaitez
                // Par exemple, extraire les titres des articles comme dans l'exemple précédent
                data.forEach(function (article) {
                    let titre = article.title.rendered;
                    if (article.meta && article.meta.ville_avoisinante) {

                    }
                    let contenu = article.content.rendered;
                    contenu = contenu.substr(0, 100) + "...";
                    let lien = article.link;
                    // transformer le coontenue en tableau et faire un split
                    console.log(titre);
                    let carte = document.createElement("div");
                    carte.classList.add("restpays__carte");

                    carte.innerHTML =
                        `<a href="${lien}"><h2>${titre}</h2></a>
                        <div class = "info_pays"><p>${contenu}</p>
                        </div>
        `;
                    restapi.appendChild(carte);
                });
            })
            .catch(function (error) {
                // Gérer les erreurs
                console.error("Erreur lors de la récupération des données :", error);
            });
    }
})();
