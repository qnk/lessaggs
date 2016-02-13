<?php 
	
	/**
	 *
	 * Template part loading the responsive CSS code
	 *
	 **/
	
	// create an access to the template main object
	global $gk_tpl, $woocommerce;
	global $fullwidth;
	
	// disable direct access to the file	
	defined('GAVERN_WP') or die('Access denied');
	
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
	
?>

<style type="text/css">
	.gk-page { max-width: <?php echo get_option($gk_tpl->name . '_template_width', 1170); ?>px; }
	<?php if(
		get_option($gk_tpl->name . '_page_layout', 'right') != 'none' && 
		gk_is_active_sidebar('sidebar') && 
		($fullwidth != true) && $wc_check == 'disable'
	) : ?>
	#gk-mainbody-columns > aside { width: <?php echo get_option($gk_tpl->name . '_sidebar_width', '30'); ?>%;}
	#gk-mainbody-columns > section { width: <?php echo 100 - get_option($gk_tpl->name . '_sidebar_width', '30'); ?>%; }
	
	<?php elseif(
		get_option($gk_tpl->name . '_wooc_layout', 'right') != 'none' && 
		gk_is_active_sidebar('sidebar_wc') && 
		($fullwidth != true) && $wc_check == 'enable'
	) : ?>
	#gk-mainbody-columns > aside { width: <?php echo get_option($gk_tpl->name . '_wc_sidebar_width', '30'); ?>%;}
	#gk-mainbody-columns > section { width: <?php echo 100 - get_option($gk_tpl->name . '_wc_sidebar_width', '30'); ?>%; }
	<?php else : ?>
	#gk-mainbody-columns > section { width: 100%; }
	<?php endif; ?>
	
	@media (min-width: <?php echo get_option($gk_tpl->name . '_tablet_width', '1040') + 1; ?>px) {
		#gk-mainmenu-collapse { height: auto!important; }
	}
	
	
</style>

<?php
// check the dependencies for the desktop.small.css file
if(get_option($gk_tpl->name . "_shortcodes3_state", 'Y') == 'Y') {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-shortcodes-template'), false, '(max-width: '. get_option($gk_tpl->name . '_theme_width', '1170') . 'px)');
} elseif(get_option($gk_tpl->name . "_shortcodes2_state", 'Y') == 'Y') {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-shortcodes-elements'), false, '(max-width: '. get_option($gk_tpl->name . '_theme_width', '1170') . 'px)');
} elseif(get_option($gk_tpl->name . "_shortcodes1_state", 'Y') == 'Y') {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-shortcodes-typography'), false, '(max-width: '. get_option($gk_tpl->name . '_theme_width', '1170') . 'px)');
} else {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-extensions'), false, '(max-width: '. get_option($gk_tpl->name . '__theme_width', '1170') . 'px)');
}

// tablet.css is always loaded after the desktop.small.css file
wp_enqueue_style('gavern-tablet', gavern_file_uri('css/tablet.css'), array('gavern-extensions'), false, '(max-width: '. get_option($gk_tpl->name . '_tablet_width', '1040') . 'px)');

// tablet.small.css is always loaded after the tablet.css file
wp_enqueue_style('gavern-tablet-small', gavern_file_uri('css/tablet.small.css'), array('gavern-tablet'), false, '(max-width: '. get_option($gk_tpl->name . '_small_tablet_width', '800') . 'px)');

// mobile.css is always loaded after the tablet.small.css file
wp_enqueue_style('gavern-mobile', gavern_file_uri('css/mobile.css'), array('gavern-tablet-small'), false, '(max-width: '. get_option($gk_tpl->name . '_mobile_width', '600') . 'px)');