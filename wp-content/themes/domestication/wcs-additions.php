<?php
/**
 * Ce fichier permet d'appliquer des changements sur le thème sur :
 * - les liens vers les images utilisateurs (url des images restituées telles quel au moment du chargement
 * des images sur le site, ce qui pose problème lors du changement d'url dans les settings)
 * - on ajoute des filtres sur le traitement dès l'initialisation du thème, car
 * cela permet d'appliquer ce changement partout où ce problème de chemin apparait.
 *
 * Pour ajouter un chemin vers une image utilisatrice, il suffit simplement de dupliquer les lignes de "image_names"
 * en remplacement la clef par le nom de l'option correspondante (ex : slider_image_1).
 *
 * A l'initalisation du thème, la fonction de traitement de l'url est ajoutée en tant que filtre sur le theme.
 * Du coup, à chaque fois que la fonction "get_theme_mod" ou "get_theme_mods" est appelée dans le thème
 * sur ces noms en particulier, le traitement est appliqué.
 *
 * Ainsi, dans le cas du slider de ce thème, non seulement le lien est rectifié sur le site,
 * mais aussi dans la partie "Apparance > personnalisation" (sinon l'image n'apparaissait pas)
 *
 */

$wcs_theme_images_subdir = "/images/";

$wcs_theme_image_names = array(
	"slider_image_1",
	"slider_image_2",
	"slider_image_3",
	"slider_image_4",
	"slider_image_5"
	);


//------------------------------------------------------------------------------
// Fonction replate image uri
//
// Remplace les chemins enregistrés dans le theme (wp_options de la base de données)
// par les bons chemins.
//------------------------------------------------------------------------------
if ( ! function_exists( 'wcs_get_correct_image_uri' ) ) :
    function wcs_get_correct_image_uri($uri)
    {
        if (!empty($uri)) {
            global $wcs_theme_images_subdir;

            $fname           = basename($uri);

            // si l'image est dans le répertoire d'upload
            // on renvoit la bonne url
            $upload_dirs    = wp_upload_dir();
            if (is_file( $upload_dirs['path']. '/'. $fname ) ) {
                $uri = $upload_dirs['url']. '/'.$fname;
            }

            // si l'image est dans le répertoire du template
            // on renvoit la bonne url
            else if (is_file( get_template_directory(). $wcs_theme_images_subdir . $fname )) {
                $uri = get_template_directory_uri(). $wcs_theme_images_subdir . $fname;
            }
        }
        return $uri;
    }
	
endif;


//------------------------------------------------------------------------------
// Ajoute la fonction de traitement de l'url 
// aux filtres du thème (appelé automatiquement par get_theme_mod)
//
// cet ajout est effectué au moment de l'initialisation du thème
//------------------------------------------------------------------------------
add_action("init", function() {
	global $wcs_theme_image_names;

	foreach ($wcs_theme_image_names as $image_name) {
		add_filter("theme_mod_$image_name", "wcs_get_correct_image_uri", 20);
	}
});


function wcs_custom_scripts() {
    wp_register_script( 'wcs_test_script', get_template_directory_uri( '/js/wcs_test.js') );
}
add_action( 'wp_enqueue_scripts', 'wcs_custom_scripts' );
