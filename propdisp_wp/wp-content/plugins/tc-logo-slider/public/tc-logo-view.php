<?php
function tcls_option( $option, $section, $default = '' ) {

    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }

    return $default;
}

function tc_logo_trigger(){
  // items
  $tcls_lg_desktop=tcls_option('tcls_lg_desktops','tcls_basics', '5' );
  $tcls_sm_desktop=tcls_option('sm_desktops','tcls_basics', '5' );
  $tcls_tablets=tcls_option('items-tablet-val','tcls_basics', '3' );
  $tcls_mobi_items=tcls_option('items-mobile-val','tcls_basics', '1' );

  $tcls_aplaySpeed=tcls_option('auto_play_speed','tcls_basics', 3000 );
  $tcls_navSpeed=tcls_option('nav_speed','tcls_basics', 3000 );
  $tcls_dotsSpeed=tcls_option('pagination_speed','tcls_basics', 3000 );
  $tcls_slideBy= tcls_option('slideBy','tcls_basics', '1' );
?>
<style>
    .tcls-wrap .owl-controls .owl-nav [class*=owl-]{

    background:<?php echo tcls_option('nav-color', 'tc-logo-slider_others', '#000' ); ?>;
  }
  .tcls-wrap .owl-controls .owl-nav [class*='owl-']:hover {
     background: <?php echo tcls_option('nav-hcolor', 'tc-logo-slider_others', '#343434' ); ?>;
  }

  /* Dots */
  .tcls-wrap  .owl-theme .owl-dots .owl-dot span {
    background:<?php echo tcls_option('dots-color', 'tc-logo-slider_others', '#000' ); ?>;
  }
  .tcls-wrap  .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
    background:<?php echo tcls_option('dots-hcolor', 'tc-logo-slider_others', '#343434' ); ?>;
   }

</style>
<script type="text/javascript">

jQuery(document).ready(function(){
    jQuery(".owl-carousel").owlCarousel({

      // control
      autoplay:<?php  echo tcls_option('auto-play','tcls_basics', 'true' );?>,
      autoplayHoverPause:<?php  echo tcls_option('stop-onhover','tcls_basics', 'true' ); ?>,
      autoplayTimeout:<?php echo tcls_option('auto_play_timeout','tcls_basics', 1000 ); ?>,
      autoplaySpeed:<?php  echo $tcls_aplaySpeed;?>,
      navSpeed:<?php echo $tcls_navSpeed; ?>,
      dotsSpeed:<?php echo $tcls_dotsSpeed;?>,
      slideBy:<?php  echo $tcls_slideBy; ?>,
      slideTransition:'linear',
      loop:<?php echo tcls_option('loop','tcls_basics', 'true' ); ?>,
      margin:6,
      // Advances
      nav:<?php  echo tcls_option('nav-val','tcls_advanced', 'true' ); ?>,
      navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
      autoHeight:<?php  echo tcls_option('autoheight','tcls_advanced', 'false' ); ?>,
      dots:<?php echo tcls_option('dots-val','tcls_advanced', 'true' ); ?>,
      responsiveClass:true,
      responsive:{
          0:{
              items:<?php if(!empty($mobi_items)){echo $mobi_items; }else{ echo $tcls_mobi_items;} ?>,
          },
          600:{
              items:<?php if(!empty($tablets)){echo $tablets; }else{ echo $tcls_tablets;} ?>,

          },
          1000:{
              items:<?php if(!empty($sm_items)){echo $sm_items; }else{ echo $tcls_sm_desktop;} ?>,

          },
          1200:{
              items:<?php if(!empty($lg_items)){echo $lg_items; }else{ echo $tcls_lg_desktop;} ?>,

          },

      }

      });

});


</script>

<?php
}
add_action('wp_footer','tc_logo_trigger');

// Add Shortcode

function tc_logoslider_shortcode( $atts ) {
  // Resize image
  $tc_resize=tcls_option('tc_crop_img', 'tcls_advanced', 'yes' );
  $tc_crop_img_width=tcls_option('tc_crop_img_width', 'tcls_advanced', '160' );
  $tc_crop_img_height=tcls_option('tc_crop_img_height', 'tcls_advanced', '90' );

	// Attributes
	extract( shortcode_atts(
		array(
			'posts_num' => "-1",
			'order' => 'DESC',
			'orderby' => '',
      'logo_cat'=>'',
      'title'=>'Our Clients',

		), $atts )
	);
  $args = array(
      'orderby' => 'date',
       'order' => $order,
        'tclogo_category' =>$logo_cat,
        'showposts' => $posts_num,
        'post_type' => 'tclogoslider'
 );

 $tc_view ='<div class="tcls-wrap">';
 //$tc_view .='<h2 class="tcls-title">'.$title.'</h2>';
 //$tc_view .='<div id="tc-logo" class="tc-owl-carousel">';
 $tc_view .='<div id="tc-logo" class="owl-carousel owl-theme">';
 $tc_loop= new WP_Query( $args );

 		if ($tc_loop->have_posts()){

 			while ($tc_loop->have_posts()) : $tc_loop->the_post();  // logo loop start
 				$post_id = get_the_ID();
 			  	$logo_id = get_post_thumbnail_id();
 			      	$logo_mata = get_post_meta($logo_id,'tclogoslider_sectionid',true);
               $logo_url = wp_get_attachment_image_src($logo_id, array(200,120), true);
                 $logo = $logo_url[0];
                 //resize image
                 $tc_thumb = get_post_thumbnail_id();
                 $tc_img_url = wp_get_attachment_url($tc_thumb,'full'); //get img URL
                 $tc_resized_logo = aq_resize($tc_img_url,$tc_crop_img_width,$tc_crop_img_height,true,true,true );
                 // end resize image

                 $logo_meta = get_post_meta( $post_id);
 			    	       $client_url = $logo_meta['client_url'][0];
        		 					$tc_view.= '<div class="item">';
 				          if($client_url) :
                 $tc_view.='<a href="'.$client_url.'">'; // client url
                 endif;
               //$tc_view.='<img src="'. $logo .'" alt="'. $logo_mata .'" />';

               if($tc_resize=='yes'){
                  $tc_view.='<img src="'. $tc_resized_logo .'" alt="'. $logo_mata .'" />';
                }else{
               $tc_view.='<img src="'. $logo .'" alt="'. $logo_mata .'" />';
                }
             if($client_url) :
             $tc_view.= '</a>'; // client url end
           endif;
 				$tc_view.='</div>';
 		endwhile; //
  }else{
    $tc_view.='<h3> No Logo was Added!</h3> ';
  }
 	$tc_view.='</div>';
   $tc_view.='</div>';
 	wp_reset_query();

 	return $tc_view;
}
add_shortcode('tc-logo-slider', 'tc_logoslider_shortcode' );

 ?>
