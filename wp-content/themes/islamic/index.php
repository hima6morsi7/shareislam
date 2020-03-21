<?php
/*
 * This file is used to generate main index page.
 */
get_header ();
?>

            <section class="content-separator"></section>
            
                   <section class="page-body-outer">
                    <section class="page-body-wrapper container mt30">  <!--page-body-wrapper-start-->
                        <div class="content-wrapper"> 
                           <div class='cp-page-item'>
                              <section class='sixteen columns'>
                              <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                   <?php if (have_posts ()) { while ( have_posts () ) { the_post (); the_content (); }} ?> 
                               </div>
                              </section>  <!--sixteen-columns-end-->
                           </div><!--cp-page-item-end-->    
                       </div><!--content-wrapper-end--> 
                    </section><!--page-body-wrapper-end-->
                   </section>  
                    
<?php get_footer(); ?>