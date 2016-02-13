<?php 
	
	/**
	 *
	 * Template elements after the page content
	 *
	 **/
	
	// create an access to the template main object
	global $gk_tpl, $woocommerce;

	// woocommerce check
	$wc_check = 'disable';
	if(isset($woocommerce)) {
		if(is_woocommerce()) {
			$wc_check = 'enable';
		}
		else {
			$wc_check = 'disable';
		}
	}
	
	// disable direct access to the file	
	defined('GAVERN_WP') or die('Access denied');
	
?>
		
				<?php if(gk_is_active_sidebar('mainbody_bottom')) : ?>
				<div id="gk-mainbody-bottom">
					<?php gk_dynamic_sidebar('mainbody_bottom'); ?>
				</div>
				<?php endif; ?>
				
				<!--[if IE 8]>
				<div class="ie8clear"></div>
				<![endif]-->
			</section><!-- end of the mainbody section -->
		
			<?php 
			if(
				get_option($gk_tpl->name . '_page_layout', 'right') != 'none' && 
				gk_is_active_sidebar('sidebar') && $wc_check == 'disable' &&
				(
					$args == null || 
					($args != null && $args['sidebar'] == true)
				)
			) : ?>
			<?php do_action('gavernwp_before_column'); ?>
			<aside id="gk-sidebar">
				<?php gk_dynamic_sidebar('sidebar'); ?>
				
				<!--[if IE 8]>
				<div class="ie8clear"></div>
				<![endif]-->
			</aside>
			<?php do_action('gavernwp_after_column'); ?>
			<?php endif; ?>
			
			<?php 
			if( 
				get_option($gk_tpl->name . '_wooc_layout', 'right') != 'none' && 
				gk_is_active_sidebar('sidebar_wc') && $wc_check == 'enable' &&
				( $args == null || ($args != null && $args['sidebar_wc'] == true) )
			) : ?>
			<?php do_action('gavernwp_before_column'); ?>
			<aside id="gk-sidebar_wc">
				<?php gk_dynamic_sidebar('sidebar_wc'); ?>
			</aside>
			<?php do_action('gavernwp_after_column'); ?>
			<?php endif; ?>
			
			<!--[if IE 8]>
			<div class="ie8clear"></div>
			<![endif]-->
		</div><!-- end of the #gk-mainbody-columns -->
	</div><!-- end of the .gk-page section -->
</div><!-- end of the .gk-page-wrap section -->	

<?php if(gk_is_active_sidebar('bottom')) : ?>
<div id="gk-bottom">
	<div class="widget-area gk-page">
		<?php gk_dynamic_sidebar('bottom'); ?>
	</div>
</div>
<?php endif; ?>