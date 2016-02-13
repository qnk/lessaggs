<?php

// disable direct access to the file	
defined('GAVERN_WP') or die('Access denied');

global $gk_tpl;

$cartActive = gk_is_active_sidebar('cart');
?>


<?php if($cartActive) : ?>
<div id="gk-popup-cart">	
	<div class="gk-popup-wrap">
		<i class="gk-icon-cross"></i>
		<?php gk_dynamic_sidebar('cart'); ?>
	</div>
</div>
<?php endif; ?>