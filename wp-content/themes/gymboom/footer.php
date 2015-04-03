<?php global $template_dir; ?>

	<footer>
		
		<?php if (is_active_sidebar('bottom-footer-1') || is_active_sidebar('bottom-footer-2') || is_active_sidebar('bottom-footer-right')){ ?>
		<section class="top">
			<section class="shell">
			
				<ul>
		
					<li class="one_third"><?php if (is_active_sidebar('bottom-footer-1')){
						dynamic_sidebar('bottom-footer-1');
					} ?></li>
					
					<li class="one_third"><?php if (is_active_sidebar('bottom-footer-2')){
						dynamic_sidebar('bottom-footer-2');
					} ?></li>
					
					<li class="one_third last"><?php if (is_active_sidebar('bottom-footer-3')){
						dynamic_sidebar('bottom-footer-3');
					} ?></li>
				
				</ul>
			
			</section>
		</section>
		<?php } ?>
		
		<?php if (!ot_get_option('js_bottom_bar_disabled')): ?>
			<section class="bottom">
				<section class="shell">
					<p><a href="#wrap" id="back-to-top" class="right"><?php _e('Back to Top','gymboom'); ?></a> <?php display_bottom_left_content(); ?></p>
				</section>
			</section>
		<?php endif; ?>
	</footer>
</section>

<script type="text/javascript">
	var customColor = '<?php echo (ot_get_option('js_highlight_color') ? str_replace('#','',ot_get_option('js_highlight_color')) : '0ca6bd'); ?>';
	var templateDir = '<?php echo $template_dir; ?>';
	var in_lang = '<?php _e('in','gymboom'); ?>';
</script>

<?php wp_footer(); ?>

</body>
</html>