<?php

add_filter('manage_edit-tclogoslider_columns', 'add_new_tclogoslider_columns');
function add_new_tclogoslider_columns($tclogoslider_columns) {


  $new_columns= array(
    'cb' => '<input type="checkbox" />',
    'title' => __( 'Title' ),
    'featured_image' => __( 'Client Logo' ),
    'logo_cat'=>_('Logo Category'),
      'c_url'=>_('Logo Url'),
    'author' => __( 'Author' ),
    'date' => __( 'Date' )
  );


    return $new_columns;
}

add_action('manage_tclogoslider_posts_custom_column', 'manage_tclogoslider_columns', 10, 2);
function get_logo($post_ID)
{
    $logo_id = get_post_thumbnail_id($post_ID);
    return $logo_url = wp_get_attachment_image_src($logo_id, array(40,40), true);
}
function manage_tclogoslider_columns( $column,$post_ID) {
  $logo=get_logo($post_ID);
    switch ( $column ) {
	case 'featured_image' :
		global $post;
		$slug = '' ;
		$slug = $post->ID;
    $featured_image ='<img src="' . $logo[0] . '"/>';
    echo $featured_image;
    break;
    case 'logo_cat' :
     $logo_cats = wp_get_post_terms($post_ID, 'tclogo_category', array("fields" => "names"));
       foreach ( $logo_cats as $logo_cat ) {
             echo $logo_cat.'<br>';

     }
      break;
      case 'c_url' :
      $client_url = get_post_meta( get_the_ID(), 'client_url', true );
          echo $client_url;
      // echo 'www';
    }
}


 ?>
