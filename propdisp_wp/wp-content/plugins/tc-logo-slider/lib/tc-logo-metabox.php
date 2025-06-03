<?php
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function tc_logo_slider_add_meta_box() {

		add_meta_box(
			'tclogoslider_sectionid',
			__( "Client's URL", 'tc-logo-slider' ),
			'tc_logo_slider_meta_box_callback',
			'tclogoslider' // name of the post type

		);

}
add_action( 'add_meta_boxes', 'tc_logo_slider_add_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function tc_logo_slider_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	// tc_logo_slider_meta_box_nonce will match in three places
	wp_nonce_field( 'client_url_save_meta_box_data', 'tc_logo_slider_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'client_url', true );

	echo '<label for="tc_logo_slider_url_field">';
	_e( 'URL : ', 'tc-logo-slider' );
	echo '</label> ';
	echo '<input type="text" id="tc_logo_slider_url_field" name="tc_logo_slider_url_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function client_url_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['tc_logo_slider_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['tc_logo_slider_meta_box_nonce'], 'client_url_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Make sure that it is set.
	if ( ! isset( $_POST['tc_logo_slider_url_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['tc_logo_slider_url_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'client_url', $my_data );
}
add_action( 'save_post', 'client_url_save_meta_box_data' );


// Addverts for PRO version

 function tc_logo_pro_add_meta_box() {

 		add_meta_box(
 			'tc_logo_sectionid_pro',
 			__( "TC Logo Slider - PRO" , 'tc-logo-slider' ),
 			'tc_logo_meta_box_pro',
 			'tclogoslider'
 		);
 }
 add_action( 'add_meta_boxes', 'tc_logo_pro_add_meta_box' );

 function tc_logo_meta_box_pro() {  ?>

 	<p>
 	<h3 style="padding-left:0">Available features at TC Logo Slider - PRO</h3>
     <ol class="pro-features">
		<li> Logo images Auto resize and crop.</li>
		<li> Slide,List,Grid,Filter Layouts Styles. </li>
		<li> 5 Nice Logo Image Hover Effects.</li>
		<li> Shortcodes Generator – no need to copy /paste shortcode Attributes.</li>
		<li> Tooltip (Show logo title in a tooltip popup).</li>
		<li> Tooltip background, border and text color change option.</li>
		<li> Navigation, Pagination, Border, Logo Title and Logo Title Hover Color Changeable.</li>
		<li> Advanced settings panel with Basic , Advanced and Styling Settings.</li>
		<li> Basic Settings control Auto Play , Stop On Hover , Logo Number on (Lg Screen , Desktop , small Desktop and Tablet ).</li>
		<li>Advanced Settings to enable/disable Show Tooltip ,Pagination ,Pagination Number , Navigation and  Auto height. </li>
		<li> Styling Setting for changing Navigation Color , Border Color , Logo Height ,Logo Width.</li>
		<li> Unlimited logo slider can be displayed from different logo categories. </li>
		<li>Logo border show/hide option .</li>
		<li> Stop On Hover option .</li>
		<li>Fully Responsive – logo Items on Large Desktop, Small Desktop, Tablet, mobile can be changeable. </li>
		<li> Show Logo Title.</li>
		<li> Support within 6 hours.</li>
		<li> Price is very reasonable.</li>
		<li> All features of free version And many more….</li>
     </ol>
   </p>
   <p><a class="tc-button tc-btn-red"
     target="_blank" href="https://www.themescode.com/items/tc-logo-slider">Upgrade To PRO ! Only $15</a></p>
 <?php
 }


 // Learn WordPress with wpbrim

 function tc_learn_wpbrim_meta_box() {
	 add_meta_box(
		 'tc_learn_wp_sidebar',
		 __( "Video Tutorials" , 'tc-logo-slider' ),
		 'tc_learn_wp_link',
		 'tclogoslider',
		 'side',
		 'high'
	 );
 }
 add_action( 'add_meta_boxes', 'tc_learn_wpbrim_meta_box' );

 function tc_learn_wp_link() { ?>
		<p> Watch wpbrim Online Courses on Youtube and brush up your wordpress skills. Ready ? </p>

	 <p><a class="ph-button ph-btn-orange" href="https://goo.gl/PFkmUu" target="_blank">Watch Video Tutorials</a></p>
	 <div style="clear:both"></div>
 <?php
 }

 function tc_team_pro_features_meta_box() {
 	add_meta_box(
 		'tc_team_sectionid_pro_sidebar',
 		__( "TC Logo Slider Pro Features" , 'tc-logo-slider' ),
 		'tc_logo_pro_features',
 		'tclogoslider',
 		'side',
 		'low'
 	);
 }
 add_action( 'add_meta_boxes', 'tc_team_pro_features_meta_box' );

 function tc_logo_pro_features() { ?>
 	<ul>
		<li> Slide,List,Grid,Filter Layouts.</li>
		<li> 5 Nice Logo Image Hover Effects.</li>
		<li> Shortcodes Generator.</li>
		<li> Show Logo Title.</li>
		<li> Show logo title in a tooltip popup.</li>
		<li> Support within 6 hours.</li>
		<li> Price is very Reasonable.</li>
		<li> Support within 6 hours.</li>
		<li> 20 Shortcode Attribute.</li>
		<li> Amazing Tooltip on Hover.</li>
		<li> Background Color Changeable.</li>
		<li> Title Color Changeable.</li>
		<li> changeable Navigation and Pagination color.</li>
		<li> Logo Slider item stop on hover option.</li>
		<li> Logo Slider items auto & fixed height option.</li>
		<li> Advance settings panel with all necessary options.</li>
		<li> Control Logo Slider sliding speed.</li>
		<li>Enable / disable Logo Slider infinite loop.</li>
		<li>Logo Slider Stop on hover control.</li>
		<li>Number of Logos to move on transition.</li>
		<li>Tons of shortcode parameters</li>
		<li>Category wise Logo Slider</li>
		<li>Works with any WordPress Theme.</li>
		<li>Easy and user-friendly setup.</li>
		<li>Online documentation and support.</li>
		<li>And many more.</li>
 	</ul>
 	<p><a class="tc-button tc-btn-green" href="https://www.themescode.com/items/tc-logo-slider/" target="_blank">Get PRO</a></p>
 	<div style="clear:both"></div>
 <?php
 }


?>
