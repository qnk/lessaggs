<footer>

<div class="row">

<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12>
<?php
wp_nav_menu(
     array(
          'theme_location' => 'footer',
          'fallback_cb'    => false // Do not fall back to wp_page_menu()
     )
);
?>
</div>
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12>
<a class="btn btn-social-icon btn-twitter">
    <span class="fa fa-twitter"></span>
  </a>
<a class="btn btn-social-icon btn-facebook">
    <span class="fa fa-facebook"></span>
  </a></div>
<a class="btn btn-social-icon btn-instagram">
    <span class="fa fa-instagram"></span>
  </a></div>

</footer>

</body>
</html>

<script>
  jQuery('#menu-main-menu li:first-child').addClass( "active" );

  jQuery('#menu-main-menu a').on('click',function(){ jQuery('#menu-main-menu a').parent().removeClass('active') });

  jQuery('.featuredButton a').on('click',function(){ jQuery('.products').hide() ; jQuery('.featuredProducts').show(); jQuery('.featuredButton').addClass('active'); });
  jQuery('.menButton a').on('click',function(){ jQuery('.products').hide(); jQuery('.menProducts').show(); jQuery('.menButton').addClass('active'); });
  jQuery('.childButton a').on('click',function(){ jQuery('.products').hide(); jQuery('.childProducts').show(); jQuery('.childButton').addClass('active'); });
  jQuery('.selfmadeButton a').on('click',function(){ jQuery('.products').hide(); jQuery('.selfmadeProducts').show(); jQuery('selfmadeButton').addClass('active'); jQuery('.selfmadeButton').addClass('active'); });
</script>