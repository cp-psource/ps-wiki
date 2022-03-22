<?php

global $blog_id, $wp_query, $wiki, $post, $current_user;

get_header( 'wiki' );

?>

<div id="primary" class="wiki-primary-event">

    <div id="content">

        <div class="padder">

            <div id="wiki-page-wrapper">

                <h1 class="entry-title"><?php the_title(); ?></h1>



                <div class="psource_wiki psource_wiki_single">

                    <?php _e('Die gesuchte Wiki-Seite existiert nicht. Fühle Dich frei, es selbst zu erstellen.', 'wiki'); ?>

                    <div class="psource_wiki_tabs psource_wiki_tabs_top"><div class="psource_wiki_clear"></div></div>

                </div>

                <?php

                $wiki->new_wiki_form(false);

                ?>

            </div>

        </div>

    </div>

</div>



<?php get_sidebar('wiki'); ?>



<?php get_footer('wiki'); ?>



<style type="text/css">

.error404 #primary {

	float: left;

	margin: 0 -26.4% 0 0;

}

.error404 #primary #content {

	margin: 0 34% 0 7.6%;

    width: 58.4%;

}

.error404 #main .widget {

	clear: both;

	margin: 0 0 2.2em;

	width: auto;

}

.error404 #main #searchform {

	border: none;

	background: none;

}

.error404 #main #s {

	width: 77%;

}

</style>