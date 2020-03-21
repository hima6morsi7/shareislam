<?php
	/*
	 * This file will generate 404 error page.
	 */	
get_header(); ?>

            <section class="content-separator"></section>
            
            <section class="page-body-outer">
                   <section class="page-body-wrapper container mt30">
 				   	    <div class="content-wrapper <?php echo $sidebar_class; ?>">
    						<section class="sixteen columns">
     							 <h1 class="heading-404">W-P-L-O-C-K-E-R-.-C-O-M
                                    <?php echo __('404','cp_front_end'); ?>
                                 </h1>
     							 <h3 class="sub-heading-404">
                                    <?php echo __('We are sorry! But the page you were looking for does not exist.','cp_front_end'); ?>
                                 </h3>
    						</section>
                        </div>
                   </section>
            </section>       
<!--content-separator-->
<?php get_footer();?>
