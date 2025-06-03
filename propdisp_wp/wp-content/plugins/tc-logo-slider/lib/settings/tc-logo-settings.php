<?php

if ( !class_exists('tc-logo-slider_Settings_API_Test' ) ):
class TC_Settings_API_Test {

    private $settings_api;

    function __construct() {
        $this->settings_api = new TC_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'sub_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'edit.php?post_type=tclogoslider', 'Settings API', 'delete_posts', 'settings_api_test', array($this, 'plugin_page') );
    }

     function sub_menu()
    {
      add_submenu_page( 'edit.php?post_type=tclogoslider','Logo Settings','Logo Settings', 'manage_options','logo-settings',array($this, 'plugin_page'));
    }

    function my_custom_submenu_page_callback() {

    	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    		echo '<h2>My Custom Submenu Page</h2>';
    	echo '</div>';

    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'tcls_basics',
                'title' => __( 'Basic Settings', 'tc-logo-slider' )
            ),
            array(
                'id' => 'tcls_advanced',
                'title' => __( 'Advanced Settings', 'tc-logo-slider' )
            ),
            array(
                'id' => 'tc-logo-slider_others',
                'title' => __( 'General Styling', 'tc-logo-slider' )
            ),
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'tcls_basics' => array(

              array(
                  'name'    => 'auto-play',
                  'label'   => __( 'Auto Play', 'tc-logo-slider' ),
                  'type'    => 'radio',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),
              array(
                  'name'    => 'auto_play_timeout',
                  'label'   => __( 'Auto Play Timeout', 'tc-logo-slider' ),
                  'type'              => 'number',
                  'default'           => 1000,
                  'sanitize_callback' => 'intval'
              ),

          array(
                  'name'    => 'auto_play_speed',
                  'label'   => __( 'Auto Play Speed', 'owl-carousel-wp' ),
                  'desc'    => __( 'Set autoplay Speed', 'owl-carousel-wp' ),
                  'type'              => 'text',
                  'default'           => 3000,
                  'sanitize_callback' => 'intval'
              ),

          array(
                  'name'    => 'nav_speed',
                  'label'   => __( 'Navigation Speed', 'owl-carousel-wp' ),
                  'desc'    => __( 'Navigation Speed', 'owl-carousel-wp' ),
                  'type'              => 'text',
                  'default'           => 3000,
                  'sanitize_callback' => 'intval'
              ),
             array(
                  'name'    => 'pagination_speed',
                  'label'   => __( 'Pagination Speed', 'owl-carousel-wp' ),
                  'desc'    => __( 'Pagination/Dots Speed', 'owl-carousel-wp' ),
                  'type'              => 'text',
                  'default'           => 3000,
                  'sanitize_callback' => 'intval'
              ),


              array(
                  'name'    => 'stop-onhover',
                  'label'   => __( 'Stop On Hover', 'tc-logo-slider' ),
                  'type'    => 'radio',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),
              array(
                  'name'    => 'loop',
                  'label'   => __( 'Carousel Loop', 'tc-logo-slider' ),
                  'type'    => 'radio',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),

             array(
                  'name'              => 'slideBy',
                  'label'             => __( 'slideBy Items Number', 'owl-carousel-wp' ),
                  'desc'              => __( 'Number of Items Slide once', 'owl-carousel-wp' ),
                  'type'              => 'text',
                  'default'           => 1,
                  'sanitize_callback' => 'intval'
              ),

              array(
                  'name'              => 'tcls_lg_desktops',
                  'label'             => __( 'Items in Large Desktops', 'tc-logo-slider' ),
                  'desc'              => __( 'Desktop that screen size larger than 1198px', 'tc-logo-slider' ),
                  'type'              => 'number',
                  'default'           => 5,
                  'sanitize_callback' => 'intval'
              ),

              array(
                  'name'              => 'sm_desktops',
                  'label'             => __( 'Item in Desktops', 'tc-logo-slider' ),
                  'desc'              => __( 'Desktop that screen size larger than 978px', 'tc-logo-slider' ),
                  'type'              => 'number',
                  'default'           => 5,
                  'sanitize_callback' => 'intval'
              ),

              array(
                  'name'              => 'items-tablet-val',
                  'label'             => __( 'Item in Tablets', 'tc-logo-slider' ),
                  'desc'              => __( 'Tablets Devices screen size 768px and Up', 'tc-logo-slider' ),
                  'type'              => 'number',
                  'default'           => 3,
                  'sanitize_callback' => 'intval'
              ),
              array(
                  'name'              => 'items-mobile-val',
                  'label'             => __( 'Item in Mobile', 'tc-logo-slider' ),
                  'desc'              => __( 'Mobile screen size 768px and less', 'tc-logo-slider' ),
                  'type'              => 'number',
                  'default'           => 2,
                  'sanitize_callback' => 'intval'
              ),


            ),
            'tcls_advanced' => array(

                array(
                    'name'    => 'nav-val',
                    'label'   => __( 'Show Navigation ', 'tc-logo-slider' ),
                    'type'    => 'radio',
                    'default' => 'true',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),

                array(
                    'name'    => 'dots-val',
                    'label'   => __('Show Dots ', 'tc-logo-slider' ),
                    'type'    => 'radio',
                    'default' => 'true',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),
                array(
                      'name' => 'tc_crop_img',
                      'label' => __( 'Crop Logo Image', 'tc-logo-slider' ),
                      'desc' => __( 'Crop logo Images, if they are in different sizes. It will resizes and crops Images automatically.', 'tc-logo-slider' ),
                      'default' => 'no',
                      'type' => 'radio',
                      'options' => array(
                          'yes' => __('Yes', 'tc-logo-slider'),
                          'no' => __('No', 'tc-logo-slider')
                      )
                  ),
                  array(
                      'name'              => 'tc_crop_img_width',
                      'label'             => __( 'Expected logo Image Cropping Width', 'tc-logo-slider' ),
                      'type'              => 'number',
                      'default'           => '160',
                      'desc'    => __( 'recomended size 160 .No need to add px', 'tc-logo-slider' ),
                      'sanitize_callback' => 'intval'
                  ),
                  array(
                      'name'              => 'tc_crop_img_height',
                      'label'             => __( 'Expected Logo Image Cropping height', 'tc-logo-slider' ),
                      'type'              => 'number',
                      'default'           => '90',
                      'desc'    => __( 'recomended size 90  .No need to add px', 'tc-logo-slider' ),
                      'sanitize_callback' => 'intval'
                  ),



            ),
              'tc-logo-slider_others' => array(

              array(
                  'name'    => 'nav-color',
                  'label'   => __( 'Navigation Color', 'tc-logo-slider' ),
                  'desc'    => __( 'Change Navigation Color for all style', 'tc-logo-slider' ),
                  'type'    => 'color',
                  'default' => '#67537A'
              ),
              array(
                  'name'    => 'nav-hcolor',
                  'label'   => __( 'Navigation Hover Color', 'tc-logo-slider' ),
                  'desc'    => __( 'Change Navigation hover Color for all style', 'tc-logo-slider' ),
                  'type'    => 'color',
                  'default' => '#AA99BA'
              ),
              array(
                  'name'    => 'dots-color',
                  'label'   => __( 'Dots Color', 'tc-logo-slider' ),
                  'desc'    => __( 'Change Dots Color for all style', 'tc-logo-slider' ),
                  'type'    => 'color',
                  'default' => '#67537A'
              ),
              array(
                  'name'    => 'dots-hcolor',
                  'label'   => __( 'Dots Hover Color', 'tc-logo-slider' ),
                  'desc'    => __( 'Change Dots Hover Color for all style', 'tc-logo-slider' ),
                  'type'    => 'color',
                  'default' => '#AA99BA'
              ),
            ),

        );

        return $settings_fields;
    }

    function plugin_page() {
      echo '<div class="wrap-setting-tc-wooslider">';
          echo '<div class="tcwps-setting">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
        ?>
        <div class="tcwps-info-wrap">

          <div class="tcwps-info-box">
        <h3 class="tcwps-info-box-title"> Upgrade To Pro </h1>
          <ul class="pro-features-box">
            <li> <span class="dashicons dashicons-yes"></span>7 Different Navigation Style and Position.</li>
            <li> <span class="dashicons dashicons-yes"></span> Slide,List,Grid,Filter Layouts .</li>
        		<li> <span class="dashicons dashicons-yes"></span> Better and Quicker support.</li>
            <li> <span class="dashicons dashicons-yes"></span> 5 Nice Image Hover Effects.</li>
            <li> <span class="dashicons dashicons-yes"></span> Shortcodes Generator.</li>
            <li> <span class="dashicons dashicons-yes"></span> Grayscale Effect.</li>
            <li> <span class="dashicons dashicons-yes"></span> Advance settings panel with all necessary options.</li>


            <li> <span class="dashicons dashicons-yes"></span> Carousel from any specific Category.</li>
            <li> <span class="dashicons dashicons-yes"></span> Tooltip (Show logo title in a tooltip popup.</li>

            <li> <span class="dashicons dashicons-yes"></span> Show Logo Title.</li>

            <li> <span class="dashicons dashicons-yes"></span>  Advanced Settings to enable/disable Show Tooltip ,Pagination ,Pagination Number , Navigation and Auto height.</li>


            <li> <span class="dashicons dashicons-yes"></span> Support within 6 hours.</li>
            <li> <span class="dashicons dashicons-yes"></span> Unlimited Color changing option for Quick view Button.</li>

            <li> <span class="dashicons dashicons-yes"></span> Fully Responsive – logo Items on Large Desktop, Small Desktop, Tablet, mobile can be changeable ..</li>
            <li> <span class="dashicons dashicons-yes"></span> Logo border show/hide option.</li>
            <li> <span class="dashicons dashicons-yes"></span> changeable Navigation and Pagination color.</li>

            <li> <span class="dashicons dashicons-yes"></span> And many more.</li>
          </ul>
          <a class="tc-button tc-btn-red" href="https://www.themescode.com/items/tc-logo-slider/" target="_blank">Go Pro!</a>

        </div>

        <div class="tcwps-info-box">
      <h3 class="tcwps-info-box-title"> Social Networks </h1>
        <ul class="pro-features">
        <li><a class="" href="https://www.facebook.com/themescode.official/" target="_blank">Facebook</a></li>
        <li><a class="" href="https://twitter.com/themescode" target="_blank">Twitter</a></li>
        <li><a class="" href="http://www.youtube.com/c/Themescode" target="_blank">Youtube</a></li>
        <li><a class="" href="http://www.youtube.com/c/Wpbrim " target="_blank">Learn WordPress</a></li>

      </ul>
      <p>Thanks</p>
      </div>

        </div>

      <?php
       echo '</div>';

    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
