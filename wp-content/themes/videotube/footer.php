<?php if( !defined('ABSPATH') ) exit;?>
	<div id="footer">
		<div class="container">
			<?php if( is_active_sidebar( 'mars-footer-sidebar' ) ):?>
				<div class="footer-sidebar">
					<div class="row">
						<?php dynamic_sidebar('mars-footer-sidebar');?>
					</div>
				</div>
			<?php endif;?>
			<div class="copyright">
				<?php do_action('mars_copyright');?>
      </div>
		</div>
	</div><!-- /#footer -->
    <?php wp_footer();?>
</body>
</html>
