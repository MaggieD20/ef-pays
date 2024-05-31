<?php

/**
 * Package Pays
 * Version 1.0.0
 */
/*
Plugin name: Pays
Plugin uri: https://github.com/MaggieD20/ef-pays
Version: 1.0.0
Description: Affiche les destinations dépendemment du pays
*/
$pays = [];
function pays_enqueue()
{
    // filemtime // retourne en milliseconde le temps de la dernière modification
    // plugin_dir_path // retourne le chemin du répertoire du plugin
    // __FILE__ // le fichier en train de s'exécuter
    // wp_enqueue_style() // Intègre le link:css dans la page
    // wp_enqueue_script() // intègre le script dans la page
    // wp_enqueue_scripts // le hook

    $version_css = filemtime(plugin_dir_path(__FILE__) . "style.css");
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/voyage.js");
    wp_enqueue_style(
        'em_plugin_voyage_css',
        plugin_dir_url(__FILE__) . "style.css",
        array(),
        $version_css
    );

    wp_enqueue_script(
        'em_plugin_voyage_js',
        plugin_dir_url(__FILE__) . "js/voyage.js",
        array(),
        $version_js,
        true
    );
}
add_action('pays_scripts', 'pays_enqueue');
/* Création de la liste des destinations en HTML */
function creation_destinations()
{
    $contenu = '';
    // get_cat_id(string) int
    $pays = ["France", "États-Unis", "Canada", "Argentine", "Chili", "Belgique", "Maroc", "Mexique", "Japon", "Italie", "Islande", "Chine", "Grèce", "Suisse"];

    for ($i = 0; $i < count($pays) - 1; $i++) {
        $nom = $pays[$i];
        print($nom);
        $contenu .= '<button class= "bouton__categorie">' . $nom . '</button>';
    }
    $contenu .= '<div class="contenu__restapi"></div>';
    return $contenu;
}

add_shortcode('pays', 'creation_destinations');

// foreach ($pays as $un_pays) {
//     $nom = $un_pays->name;
//     $id_categorie = $un_pays->term_id;
//     $contenu .= '<button class="bouton_pays" id="cat_'
//         . $id_categorie .
//         '">'
//         . $nom_categorie .
//         '</button>';
// }
