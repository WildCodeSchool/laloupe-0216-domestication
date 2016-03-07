<?php  
/* 
Template Name: Cr3ativ-Conference

Page retravaillée pour WCS.

*/  


//========================================================== 
// Ajoute un script en pied de page
//========================================================== 
add_action('wp_footer', 'wcs_js_modal');

function wcs_js_modal() {
    wp_enqueue_script( 'wcs_js_modal', get_template_directory_uri() . '/js/wcs_js_modal.js', array("jquery") );
}


//========================================================== 
// Inclut l'entête de la page
//========================================================== 
get_header();
?>

<!-- Start of content wrapper -->
<div> <!--id="cr3ativconference_contentwrapper"> -->
    <div class="wcs-conf"> <!--class="conf-wrapper">-->

        <h1><?php _e("[:fr]Programme[:en]Schedule[:]");?></h1>
        
        <?php
/*------------------------------------------
DEBUT

Récupération et traitement des données
- Journées
- pauses/intro ou autres
- communications
- intervenants et co-auteurs
------------------------------------------*/

        // Récupère toutes "communications" triées par jour et heure.
        add_filter('posts_orderby','cr3ativoderby2');
        
        $wp_query = new WP_Query(
                            array(
                            'post_type'         => 'cr3ativconference',
                            'posts_per_page'    => -1,
                            'order'             => 'ASC',
                            'meta_key'          => 'cr3ativconf_date',
                            'meta_query'        => array(
                                    array(
                                      'key' => 'cr3ativconf_date',
                                    ),
                                    array(
                                      'key' => 'cr3ativconf_starttime',
                                    )
                                )
                            )
                        ); 
        
        remove_filter('posts_orderby','cr3ativoderby2');
        
        $is_same_day        = false;
        $day_date           = '';
        $day_name           = '';
        $day_desc           = '';
        $day_css_class      = '';
        $is_same_session    = true;
        $session_date       = '';
        $session_name       = '';
        $session_desc       = '';
        $comm_time          = '';
        $person_ids         = array();
        $html_list_pers     = '';

        while (have_posts()) : 
            the_post();

            // -------------------------------------------------------------------------------
            // récupère les données de la communication
            // -------------------------------------------------------------------------------
            $meetingdate = $post->cr3ativconf_date;
            $starttime   = $post->cr3ativconf_starttime;
            $endtime     = $post->cr3ativconf_endtime;
            $person_ids  = $post->cr3ativconf_speakers;
            if ( is_array($post->cr3ativconf_coauthors) ) {
                $person_ids = array_merge( $person_ids, $post->cr3ativconf_coauthors );
            }

            
            $comm_time   = $starttime;
            if ($endtime != ('')) { 
                $comm_time .= " - $endtime"; 
            }

            $is_same_day   = ($session_date == $meetingdate);
            $session_date  = $meetingdate;

            // -------------------------------------------------------------------------------
            // pour chaque communication, récupère les catégories (sessions, journées, pauses)
            // -------------------------------------------------------------------------------
            $is_break_or_no_desc = false;

            $terms = wp_get_post_terms(
                        $post->ID, 
                        'cr3ativconfcategory', 
                        array('fields'=>'all')
                        );

            foreach($terms as $term) {

                // s'il s'agit d'une journée
                if (!$is_same_day && stristr($term->slug, "day")) {
                    $day_name = $term->name;
                    $day_desc = $term->description;
                    $day_css_class = $term->slug;
                }

                // s'il s'agit d'une session
                if (stristr($term->slug, "session") && !empty($term->name)) {
                    $is_same_session = ($session_name == $term->name);

                    if (!$is_same_session) {
                        $session_name = $term->name;
                        $session_desc = $term->description;
                    }
                }

                // s'il s'agit d'une pause ou d'une communication
                // sans description (ex: introduction, accueil
                // des participants)
                if ($term->slug == "no-desc" ||
                    $term->slug == "break") {
                    $is_break_or_no_desc = true;
                }
            } // fin du foreach terms

            // -------------------------------------------------------------------------------
            // Récupère la liste des personnes (intervenants et co-auteurs)
            // -------------------------------------------------------------------------------
            $html_list_pers     = '';

            if ( is_array($person_ids) ) { 
                
                $array_persons = array();
                foreach ( $person_ids as $person_id ) {

                    $post_pers   = get_post_meta( $person_id ); 
                    $html_pers  = "<strong>{$post_pers["speakerfirstname"][0]}";
                    $html_pers .= " ".strtoupper($post_pers["speakerlastname"][0])."</strong>";
    
                    if (isset($post_pers["speakeradditionnal"])) {
                        $html_pers .= " <em>(".__($post_pers["speakeradditionnal"][0]).")</em>";
                    }

                    array_push( $array_persons, $html_pers );
                
                }
                $html_list_pers = implode(", ", $array_persons);
            }  // fin du if is_array (persons_ids)

/*------------------------------------------
AFFICHAGE HTML
------------------------------------------*/
        ?>

        <div>
     
            <?php 
                // JOURNEE
                if (!$is_same_day) { 
            ?>

                <div class="wcs-day">
               
                    <!-- titre journée -->
                    <h4 class="<?php echo $day_css_class; ?>"><?php echo $day_name; ?></h4>
         
                    <!-- lieu -->
                    <h6 class="<?php echo $day_css_class; ?>"><?php echo __($day_desc); ?></h6>

               </div>
               
            <?php 
                }
                
                // SESSIONS
                if (!$is_same_session){ 
            ?>
                <div class='wcs-session <?php echo $day_css_class; ?>'>

                    <!-- libellé session -->
                    <h5><?php echo $session_name; ?></h5>
         
                    <!-- description session -->
                    <h6><?php echo __($session_desc); ?></h6>

                </div>
            <?php
                } 
            ?>

                <!-- COMMUNICATION -->
                <div class="wcs-comm <?php echo $day_css_class; ?>">
                    <h6>

                        <!-- heure -->
                        <span class='wcs-hours <?php echo $day_css_class; ?>'><?php echo $comm_time; ?></span>

                        <!-- titre pause ou autre non communication -->
                        <span class='wcs-comm-title'>

                        <?php 
                            // titre pause ou autre non communication
                            if ($is_break_or_no_desc) {
                                the_title();
                            }
                            else {

                            // titre communication
                        ?>
<?php
/*
                        <button  title="<?php _e( '[:fr]Afficher [:en]Display [:i]', 'squarecode' );  the_title_attribute();?>"
                            class="wcs-bt-open <?php echo $day_css_class; ?>"> <?php 
                            the_title(); ?></button>                        
*/
                        
?>                        
                            <div class="wcs-modal">                  

                                <!-- titre communication -->
                                <button  title="<?php _e( '[:fr]Afficher [:en]Display [:i]', 'squarecode' );  the_title_attribute();?>"
                                    class="wcs-bt-open <?php echo $day_css_class; ?>">
                                    <?php the_title(); ?>
                                </button>

                                <div class="wcs-content" style="display:none">
                                    <div class="wcs-content-text">
                                        <h4><?php the_title(); ?></h4>
                                        <p><?php the_content(); ?></p> 
                                           
                                        <button class="wcs-bt-close">
                                        <?php _e( '[:fr]Fermer[:en]Close[:]', 'cr3at_conf' ); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        </span>             

                    </h6>
                </div>

                <!-- DEBUT INTERVENANTS -->
                <div class="wcs-pers">
                <?php echo $html_list_pers; ?>
                </div><!-- End of speaker list -->

        </div>
        <?php endwhile; ?>

    </div>

    <div class="cr3ativconference_clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>