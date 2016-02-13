<?php 
	
	/**
	 *
	 * Template elements before the page content
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
	
	// check if the sidebar is set to be a left column
	$args = array();
	$args_val = $args == null || ($args != null && $args['sidebar'] == true || $args['sidebar_wc'] == true );
	
	$gk_mainbody_class = '';
	
	if(get_option($gk_tpl->name . '_page_layout', 'right') == 'left' && gk_is_active_sidebar('sidebar') && $args_val && $wc_check == 'disable') {
		$gk_mainbody_class .= ' class= "gk-column-left"';
	}
	
	if(get_option($gk_tpl->name . '_wooc_layout', 'right') == 'left' && gk_is_active_sidebar('sidebar_wc') && $args_val && $wc_check == 'enable') {
		$gk_mainbody_class .= ' class= "gk-column-wc-left"';
	}
	
?>

<div class="gk-page-wrap<?php if(get_option($gk_tpl->name . '_template_homepage_mainbody', 'N') == 'N' && is_home()) : ?> gk-is-homepage<?php endif; ?>">
	<div class="gk-page">
		<div id="gk-mainbody-columns"<?php echo $gk_mainbody_class; ?>>	
			<section>
				<?php if(gk_is_active_sidebar('top1')) : ?>
				<div id="gk-top1">
					<div class="widget-area">
						<?php gk_dynamic_sidebar('top1'); ?>
						
						<!--[if IE 8]>
						<div class="ie8clear"></div>
						<![endif]-->
					</div>
				</div>
				<?php endif; ?>

				<!-- Mainbody -->
				<?php if(gk_is_active_sidebar('mainbody_top')) : ?>
				<div id="gk-mainbody-top">
					<?php gk_dynamic_sidebar('mainbody_top'); ?>
				</div>
				<?php endif; ?>