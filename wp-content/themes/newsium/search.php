<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Newsium
 */

get_header(); ?>
<div class="af-container-block-wrapper clearfix">
    <section id="primary" class="content-area">
        <main id="main" class="site-main">

			<?php
			if ( have_posts() ) : ?>

                <header class="header-title-wrapper">
                    <h1 class="page-title"><?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'newsium' ), '<span>' . get_search_query() . '</span>' );
						?></h1>
                </header><!-- .header-title-wrapper -->
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">		 </script>
						<ins class="adsbygoogle"
							 style="display:block"
							 data-ad-format="fluid"
							 data-ad-layout-key="-gr+f-2d-4l+hg"
							 data-ad-client="ca-pub-9533624882283470"
							 data-ad-slot="9538533111"></ins>
						<script>
							 (adsbygoogle = window.adsbygoogle || []).push({});
						</script>

				<?php

                //div wrap start
				do_action( 'newsium_archive_layout_before_loop' );
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */

					get_template_part( 'template-parts/content', get_post_format() );


				endwhile;
				//div wrap end
				do_action( 'newsium_archive_layout_after_loop' );
				?>
                <div class="col-1 clearfix">
                    <div class="newsium-pagination">
						<?php newsium_numeric_pagination(); ?>
                    </div>
                </div>
			<?php
			else : ?>
				<?php

				get_template_part( 'template-parts/content', 'none' ); ?>
			<?php

			endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_sidebar();
?>
</div>
<?php
get_footer();
