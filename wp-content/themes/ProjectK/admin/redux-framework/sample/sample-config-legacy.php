<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux_Framework_sample_config' ) ) {

        class Redux_Framework_sample_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                // If Redux is running as a plugin, this will remove the demo notice and links
                //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                // Function to test the compiler hook and demo CSS output.
                // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
                //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

                // Change the arguments after they've been declared, but before the panel is created
                //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

                // Change the default value of a field after it's been set, but before it's been useds
                //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

                // Dynamically add a section. Can be also used to modify sections/fields
                //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                //print_r($options); //Option values
                //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

                /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', 'thefoxwp' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'thefoxwp' ),
                    'icon'   => 'el el-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'thefoxwp' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'thefoxwp' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'thefoxwp' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'thefoxwp' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'thefoxwp' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'thefoxwp' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'thefoxwp' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'thefoxwp' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }

                // ACTUAL DECLARATION OF SECTIONS
                $this->sections[] = array(
                    'title'  => __( 'Home Settings', 'thefoxwp' ),
                    'desc'   => __( 'Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'thefoxwp' ),
                    'icon'   => 'el el-home',
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(

                        array(
                            'id'       => 'opt-web-fonts',
                            'type'     => 'media',
                            'title'    => __( 'Web Fonts', 'thefoxwp' ),
                            'compiler' => 'true',
                            'mode'     => false,
                            // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'     => __( 'Basic media uploader with disabled URL input field.', 'thefoxwp' ),
                            'subtitle' => __( 'Upload any media using the WordPress native uploader', 'thefoxwp' ),
                            'hint'     => array(
                                //'title'     => '',
                                'content' => 'This is a <b>hint</b> tool-tip for the webFonts field.<br/><br/>Add any HTML based text you like here.',
                            )
                        ),
                        array(
                            'id'       => 'section-media-checkbox',
                            'type'     => 'switch',
                            'title'    => __( 'Section Show', 'thefoxwp' ),
                            'subtitle' => __( 'With the "section" field you can create indent option sections.', 'thefoxwp' ),

                        ),
                        array(
                            'id'       => 'section-media-start',
                            'type'     => 'section',
                            'title'    => __( 'Media Options', 'thefoxwp' ),
                            'subtitle' => __( 'With the "section" field you can create indent option sections.', 'thefoxwp' ),
                            'indent'   => true, // Indent all options below until the next 'section' option is set.
                            'required' => array( 'section-media-checkbox', "=", 1 ),
                        ),
                        array(
                            'id'       => 'opt-media',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Media w/ URL', 'thefoxwp' ),
                            'compiler' => 'true',
                            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'     => __( 'Basic media uploader with disabled URL input field.', 'thefoxwp' ),
                            'subtitle' => __( 'Upload any media using the WordPress native uploader', 'thefoxwp' ),
                            'default'  => array( 'url' => 'http://s.wordpress.org/style/images/codeispoetry.png' ),
                            //'hint'      => array(
                            //    'title'     => 'Hint Title',
                            //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                            //)
                        ),
                        array(
                            'id'       => 'section-media-end',
                            'type'     => 'section',
                            'indent'   => false, // Indent all options below until the next 'section' option is set.
                            'required' => array( 'section-media-checkbox', "=", 1 ),
                        ),
                        array(
                            'id'       => 'media-no-url',
                            'type'     => 'media',
                            'title'    => __( 'Media w/o URL', 'thefoxwp' ),
                            'desc'     => __( 'This represents the minimalistic view. It does not have the preview box or the display URL in an input box. ', 'thefoxwp' ),
                            'subtitle' => __( 'Upload any media using the WordPress native uploader', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'media-no-preview',
                            'type'     => 'media',
                            'preview'  => false,
                            'title'    => __( 'Media No Preview', 'thefoxwp' ),
                            'desc'     => __( 'This represents the minimalistic view. It does not have the preview box or the display URL in an input box. ', 'thefoxwp' ),
                            'subtitle' => __( 'Upload any media using the WordPress native uploader', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-gallery',
                            'type'     => 'gallery',
                            'title'    => __( 'Add/Edit Gallery', 'thefoxwp' ),
                            'subtitle' => __( 'Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'            => 'opt-slider-label',
                            'type'          => 'slider',
                            'title'         => __( 'Slider Example 1', 'thefoxwp' ),
                            'subtitle'      => __( 'This slider displays the value as a label.', 'thefoxwp' ),
                            'desc'          => __( 'Slider description. Min: 1, max: 500, step: 1, default value: 250', 'thefoxwp' ),
                            'default'       => 250,
                            'min'           => 1,
                            'step'          => 1,
                            'max'           => 500,
                            'display_value' => 'label'
                        ),
                        array(
                            'id'            => 'opt-slider-text',
                            'type'          => 'slider',
                            'title'         => __( 'Slider Example 2 with Steps (5)', 'thefoxwp' ),
                            'subtitle'      => __( 'This example displays the value in a text box', 'thefoxwp' ),
                            'desc'          => __( 'Slider description. Min: 0, max: 300, step: 5, default value: 75', 'thefoxwp' ),
                            'default'       => 75,
                            'min'           => 0,
                            'step'          => 5,
                            'max'           => 300,
                            'display_value' => 'text'
                        ),
                        array(
                            'id'            => 'opt-slider-select',
                            'type'          => 'slider',
                            'title'         => __( 'Slider Example 3 with two sliders', 'thefoxwp' ),
                            'subtitle'      => __( 'This example displays the values in select boxes', 'thefoxwp' ),
                            'desc'          => __( 'Slider description. Min: 0, max: 500, step: 5, slider 1 default value: 100, slider 2 default value: 300', 'thefoxwp' ),
                            'default'       => array(
                                1 => 100,
                                2 => 300,
                            ),
                            'min'           => 0,
                            'step'          => 5,
                            'max'           => '500',
                            'display_value' => 'select',
                            'handles'       => 2,
                        ),
                        array(
                            'id'            => 'opt-slider-float',
                            'type'          => 'slider',
                            'title'         => __( 'Slider Example 4 with float values', 'thefoxwp' ),
                            'subtitle'      => __( 'This example displays float values', 'thefoxwp' ),
                            'desc'          => __( 'Slider description. Min: 0, max: 1, step: .1, default value: .5', 'thefoxwp' ),
                            'default'       => .5,
                            'min'           => 0,
                            'step'          => .1,
                            'max'           => 1,
                            'resolution'    => 0.1,
                            'display_value' => 'text'
                        ),
                        array(
                            'id'      => 'opt-spinner',
                            'type'    => 'spinner',
                            'title'   => __( 'JQuery UI Spinner Example 1', 'thefoxwp' ),
                            'desc'    => __( 'JQuery UI spinner description. Min:20, max: 100, step:20, default value: 40', 'thefoxwp' ),
                            'default' => '40',
                            'min'     => '20',
                            'step'    => '20',
                            'max'     => '100',
                        ),
                        array(
                            'id'       => 'switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Switch On', 'thefoxwp' ),
                            'subtitle' => __( 'Look, it\'s on!', 'thefoxwp' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'switch-off',
                            'type'     => 'switch',
                            'title'    => __( 'Switch Off', 'thefoxwp' ),
                            'subtitle' => __( 'Look, it\'s on!', 'thefoxwp' ),
                            //'options' => array('on', 'off'),
                            'default'  => false,
                        ),
                        array(
                            'id'       => 'switch-parent',
                            'type'     => 'switch',
                            'title'    => __( 'Switch - Nested Children, Enable to show', 'thefoxwp' ),
                            'subtitle' => __( 'Look, it\'s on! Also hidden child elements!', 'thefoxwp' ),
                            'default'  => 0,
                            'on'       => 'Enabled',
                            'off'      => 'Disabled',
                        ),
                        array(
                            'id'       => 'switch-child1',
                            'type'     => 'switch',
                            'required' => array( 'switch-parent', '=', '1' ),
                            'title'    => __( 'Switch - This and the next switch required for patterns to show', 'thefoxwp' ),
                            'subtitle' => __( 'Also called a "fold" parent.', 'thefoxwp' ),
                            'desc'     => __( 'Items set with a fold to this ID will hide unless this is set to the appropriate value.', 'thefoxwp' ),
                            'default'  => false,
                        ),
                        array(
                            'id'       => 'switch-child2',
                            'type'     => 'switch',
                            'required' => array( 'switch-parent', '=', '1' ),
                            'title'    => __( 'Switch2 - Enable the above switch and this one for patterns to show', 'thefoxwp' ),
                            'subtitle' => __( 'Also called a "fold" parent.', 'thefoxwp' ),
                            'desc'     => __( 'Items set with a fold to this ID will hide unless this is set to the appropriate value.', 'thefoxwp' ),
                            'default'  => false,
                        ),
                        array(
                            'id'       => 'opt-patterns',
                            'type'     => 'image_select',
                            'tiles'    => true,
                            'required' => array(
                                array( 'switch-child1', 'equals', 1 ),
                                array( 'switch-child2', 'equals', 1 ),
                            ),
                            'title'    => __( 'Images Option (with pattern=>true)', 'thefoxwp' ),
                            'subtitle' => __( 'Select a background pattern.', 'thefoxwp' ),
                            'default'  => 0,
                            'options'  => $sample_patterns
                            ,
                        ),
                        array(
                            'id'       => 'opt-homepage-layout',
                            'type'     => 'sorter',
                            'title'    => 'Layout Manager Advanced',
                            'subtitle' => 'You can add multiple drop areas or columns.',
                            'compiler' => 'true',
                            'options'  => array(
                                'enabled'  => array(
                                    'highlights' => 'Highlights',
                                    'slider'     => 'Slider',
                                    'staticpage' => 'Static Page',
                                    'services'   => 'Services'
                                ),
                                'disabled' => array(),
                                'backup'   => array(),
                            ),
                            'limits'   => array(
                                'disabled' => 1,
                                'backup'   => 2,
                            ),
                        ),
                        array(
                            'id'       => 'opt-homepage-layout-2',
                            'type'     => 'sorter',
                            'title'    => 'Homepage Layout Manager',
                            'desc'     => 'Organize how you want the layout to appear on the homepage',
                            'compiler' => 'true',
                            'options'  => array(
                                'disabled' => array(
                                    'highlights' => 'Highlights',
                                    'slider'     => 'Slider',
                                ),
                                'enabled'  => array(
                                    'staticpage' => 'Static Page',
                                    'services'   => 'Services'
                                ),
                            ),
                        ),
                        array(
                            'id'          => 'opt-slides',
                            'type'        => 'slides',
                            'title'       => __( 'Slides Options', 'thefoxwp' ),
                            'subtitle'    => __( 'Unlimited slides with drag and drop sortings.', 'thefoxwp' ),
                            'desc'        => __( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'thefoxwp' ),
                            'placeholder' => array(
                                'title'       => __( 'This is a title', 'thefoxwp' ),
                                'description' => __( 'Description Here', 'thefoxwp' ),
                                'url'         => __( 'Give us a link!', 'thefoxwp' ),
                            ),
                        ),
                        array(
                            'id'       => 'opt-presets',
                            'type'     => 'image_select',
                            'presets'  => true,
                            'title'    => __( 'Preset', 'thefoxwp' ),
                            'subtitle' => __( 'This allows you to set a json string or array to override multiple preferences in your theme.', 'thefoxwp' ),
                            'default'  => 0,
                            'desc'     => __( 'This allows you to set a json string or array to override multiple preferences in your theme.', 'thefoxwp' ),
                            'options'  => array(
                                '1' => array(
                                    'alt'     => 'Preset 1',
                                    'img'     => ReduxFramework::$_url . '../sample/presets/preset1.png',
                                    'presets' => array(
                                        'switch-on'     => 1,
                                        'switch-off'    => 1,
                                        'switch-parent' => 1
                                    )
                                ),
                                '2' => array(
                                    'alt'     => 'Preset 2',
                                    'img'     => ReduxFramework::$_url . '../sample/presets/preset2.png',
                                    'presets' => '{"opt-slider-label":"1", "opt-slider-text":"10"}'
                                ),
                            ),
                        ),
                        array(
                            'id'          => 'opt-typography',
                            'type'        => 'typography',
                            'title'       => __( 'Typography', 'thefoxwp' ),
                            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                            'google'      => true,
                            // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => true,
                            // Select a backup non-google font in addition to a google font
                            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                            //'subsets'       => false, // Only appears if google is true and subsets not set to false
                            //'font-size'     => false,
                            //'line-height'   => false,
                            //'word-spacing'  => true,  // Defaults to false
                            //'letter-spacing'=> true,  // Defaults to false
                            //'color'         => false,
                            //'preview'       => false, // Disable the previewer
                            'all_styles'  => true,
                            // Enable all Google Font style/weight variations to be added to the page
                            'output'      => array( 'h2.site-description, .entry-title' ),
                            // An array of CSS selectors to apply this font style to dynamically
                            'compiler'    => array( 'h2.site-description-compiler' ),
                            // An array of CSS selectors to apply this font style to dynamically
                            'units'       => 'px',
                            // Defaults to px
                            'subtitle'    => __( 'Typography option with each property can be called individually.', 'thefoxwp' ),
                            'default'     => array(
                                'color'       => '#333',
                                'font-style'  => '700',
                                'font-family' => 'Abel',
                                'google'      => true,
                                'font-size'   => '33px',
                                'line-height' => '40px'
                            ),
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'icon'   => 'el el-cogs',
                    'title'  => __( 'General Settings', 'thefoxwp' ),
                    'fields' => array(
                        array(
                            'id'       => 'opt-layout',
                            'type'     => 'image_select',
                            'compiler' => true,
                            'title'    => __( 'Main Layout', 'thefoxwp' ),
                            'subtitle' => __( 'Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'thefoxwp' ),
                            'options'  => array(
                                '1' => array(
                                    'alt' => '1 Column',
                                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                                ),
                                '2' => array(
                                    'alt' => '2 Column Left',
                                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                                ),
                                '3' => array(
                                    'alt' => '2 Column Right',
                                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                                ),
                                '4' => array(
                                    'alt' => '3 Column Middle',
                                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                                ),
                                '5' => array(
                                    'alt' => '3 Column Left',
                                    'img' => ReduxFramework::$_url . 'assets/img/3cl.png'
                                ),
                                '6' => array(
                                    'alt' => '3 Column Right',
                                    'img' => ReduxFramework::$_url . 'assets/img/3cr.png'
                                )
                            ),
                            'default'  => '2'
                        ),
                        array(
                            'id'       => 'opt-textarea',
                            'type'     => 'textarea',
                            'required' => array( 'layout', 'equals', '1' ),
                            'title'    => __( 'Tracking Code', 'thefoxwp' ),
                            'subtitle' => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'thefoxwp' ),
                            'validate' => 'js',
                            'desc'     => 'Validate that it\'s javascript!',
                        ),
                        array(
                            'id'       => 'opt-ace-editor-css',
                            'type'     => 'ace_editor',
                            'title'    => __( 'CSS Code', 'thefoxwp' ),
                            'subtitle' => __( 'Paste your CSS code here.', 'thefoxwp' ),
                            'mode'     => 'css',
                            'theme'    => 'monokai',
                            'desc'     => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                            'default'  => "#header{\nmargin: 0 auto;\n}"
                        ),
                        /*
                    array(
                        'id'        => 'opt-ace-editor-js',
                        'type'      => 'ace_editor',
                        'title'     => __('JS Code', 'thefoxwp'),
                        'subtitle'  => __('Paste your JS code here.', 'thefoxwp'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default'   => "jQuery(document).ready(function(){\n\n});"
                    ),
                    array(
                        'id'        => 'opt-ace-editor-php',
                        'type'      => 'ace_editor',
                        'title'     => __('PHP Code', 'thefoxwp'),
                        'subtitle'  => __('Paste your PHP code here.', 'thefoxwp'),
                        'mode'      => 'php',
                        'theme'     => 'chrome',
                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default'   => '<?php\nisset ( $redux ) ? true : false;\n?>'
                    ),
                    */
                        array(
                            'id'       => 'opt-editor',
                            'type'     => 'editor',
                            'title'    => __( 'Footer Text', 'thefoxwp' ),
                            'subtitle' => __( 'You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'thefoxwp' ),
                            'default'  => 'Powered by Redux Framework.',
                        ),
                        array(
                            'id'       => 'password',
                            'type'     => 'password',
                            'username' => true,
                            'title'    => 'SMTP Account',
                            //'placeholder' => array('username' => 'Enter your Username')
                        )
                    )
                );

                $this->sections[] = array(
                    'icon'       => 'el el-website',
                    'title'      => __( 'Styling Options', 'thefoxwp' ),
                    'subsection' => true,
                    'fields'     => array(
                        array(
                            'id'       => 'opt-select-stylesheet',
                            'type'     => 'select',
                            'title'    => __( 'Theme Stylesheet', 'thefoxwp' ),
                            'subtitle' => __( 'Select your themes alternative color scheme.', 'thefoxwp' ),
                            'options'  => array( 'default.css' => 'default.css', 'color1.css' => 'color1.css' ),
                            'default'  => 'default.css',
                        ),
                        array(
                            'id'       => 'opt-color-background',
                            'type'     => 'color',
                            'output'   => array( '.site-title' ),
                            'title'    => __( 'Body Background Color', 'thefoxwp' ),
                            'subtitle' => __( 'Pick a background color for the theme (default: #fff).', 'thefoxwp' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                        ),
                        array(
                            'id'       => 'opt-background',
                            'type'     => 'background',
                            'output'   => array( 'body' ),
                            'title'    => __( 'Body Background', 'thefoxwp' ),
                            'subtitle' => __( 'Body background with image, color, etc.', 'thefoxwp' ),
                            //'default'   => '#FFFFFF',
                        ),
                        array(
                            'id'       => 'opt-color-footer',
                            'type'     => 'color',
                            'title'    => __( 'Footer Background Color', 'thefoxwp' ),
                            'subtitle' => __( 'Pick a background color for the footer (default: #dd9933).', 'thefoxwp' ),
                            'default'  => '#dd9933',
                            'validate' => 'color',
                        ),
                        array(
                            'id'       => 'opt-color-rgba',
                            'type'     => 'color_rgba',
                            'title'    => __( 'Color RGBA', 'thefoxwp' ),
                            'subtitle' => __( 'Gives you the RGBA color.', 'thefoxwp' ),
                            'default'  => array(
                                'color' => '#7e33dd',
                                'alpha' => '.8'
                            ),
                            'output'   => array( 'body' ),
                            'mode'     => 'background',
                            'validate' => 'colorrgba',
                        ),
                        array(
                            'id'       => 'opt-color-header',
                            'type'     => 'color_gradient',
                            'title'    => __( 'Header Gradient Color Option', 'thefoxwp' ),
                            'subtitle' => __( 'Only color validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'default'  => array(
                                'from' => '#1e73be',
                                'to'   => '#00897e'
                            )
                        ),
                        array(
                            'id'       => 'opt-link-color',
                            'type'     => 'link_color',
                            'title'    => __( 'Links Color Option', 'thefoxwp' ),
                            'subtitle' => __( 'Only color validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            //'regular'   => false, // Disable Regular Color
                            //'hover'     => false, // Disable Hover Color
                            //'active'    => false, // Disable Active Color
                            //'visited'   => true,  // Enable Visited Color
                            'default'  => array(
                                'regular' => '#aaa',
                                'hover'   => '#bbb',
                                'active'  => '#ccc',
                            )
                        ),
                        array(
                            'id'       => 'opt-header-border',
                            'type'     => 'border',
                            'title'    => __( 'Header Border Option', 'thefoxwp' ),
                            'subtitle' => __( 'Only color validation can be done on this field type', 'thefoxwp' ),
                            'output'   => array( '.site-header' ),
                            // An array of CSS selectors to apply this font style to
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'default'  => array(
                                'border-color'  => '#1e73be',
                                'border-style'  => 'solid',
                                'border-top'    => '3px',
                                'border-right'  => '3px',
                                'border-bottom' => '3px',
                                'border-left'   => '3px'
                            )
                        ),
                        array(
                            'id'       => 'opt-spacing',
                            'type'     => 'spacing',
                            'output'   => array( '.site-header' ),
                            // An array of CSS selectors to apply this font style to
                            'mode'     => 'margin',
                            // absolute, padding, margin, defaults to padding
                            'all'      => true,
                            // Have one field that applies to all
                            //'top'           => false,     // Disable the top
                            //'right'         => false,     // Disable the right
                            //'bottom'        => false,     // Disable the bottom
                            //'left'          => false,     // Disable the left
                            //'units'         => 'em',      // You can specify a unit value. Possible: px, em, %
                            //'units_extended'=> 'true',    // Allow users to select any type of unit
                            //'display_units' => 'false',   // Set to false to hide the units if the units are specified
                            'title'    => __( 'Padding/Margin Option', 'thefoxwp' ),
                            'subtitle' => __( 'Allow your users to choose the spacing or margin they want.', 'thefoxwp' ),
                            'desc'     => __( 'You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'thefoxwp' ),
                            'default'  => array(
                                'margin-top'    => '1px',
                                'margin-right'  => '2px',
                                'margin-bottom' => '3px',
                                'margin-left'   => '4px'
                            )
                        ),
                        array(
                            'id'             => 'opt-dimensions',
                            'type'           => 'dimensions',
                            'units'          => 'em',    // You can specify a unit value. Possible: px, em, %
                            'units_extended' => 'true',  // Allow users to select any type of unit
                            'title'          => __( 'Dimensions (Width/Height) Option', 'thefoxwp' ),
                            'subtitle'       => __( 'Allow your users to choose width, height, and/or unit.', 'thefoxwp' ),
                            'desc'           => __( 'You can enable or disable any piece of this field. Width, Height, or Units.', 'thefoxwp' ),
                            'default'        => array(
                                'width'  => 200,
                                'height' => 100,
                            )
                        ),
                        array(
                            'id'       => 'opt-typography-body',
                            'type'     => 'typography',
                            'title'    => __( 'Body Font', 'thefoxwp' ),
                            'subtitle' => __( 'Specify the body font properties.', 'thefoxwp' ),
                            'google'   => true,
                            'default'  => array(
                                'color'       => '#dd9933',
                                'font-size'   => '30px',
                                'font-family' => 'Arial,Helvetica,sans-serif',
                                'font-weight' => 'Normal',
                            ),
                        ),
                        array(
                            'id'       => 'opt-custom-css',
                            'type'     => 'textarea',
                            'title'    => __( 'Custom CSS', 'thefoxwp' ),
                            'subtitle' => __( 'Quickly add some CSS to your theme by adding it to this block.', 'thefoxwp' ),
                            'desc'     => __( 'This field is even CSS validated!', 'thefoxwp' ),
                            'validate' => 'css',
                        ),
                        array(
                            'id'       => 'opt-custom-html',
                            'type'     => 'textarea',
                            'title'    => __( 'Custom HTML', 'thefoxwp' ),
                            'subtitle' => __( 'Just like a text box widget.', 'thefoxwp' ),
                            'desc'     => __( 'This field is even HTML validated!', 'thefoxwp' ),
                            'validate' => 'html',
                        ),
                    )
                );

                /**
                 *  Note here I used a 'heading' in the sections array construct
                 *  This allows you to use a different title on your options page
                 * instead of reusing the 'title' value.  This can be done on any
                 * section - kp
                 */
                $this->sections[] = array(
                    'icon'    => 'el el-bullhorn',
                    'title'   => __( 'Field Validation', 'thefoxwp' ),
                    'heading' => __( 'Validate ALL fields within Redux.', 'thefoxwp' ),
                    'desc'    => __( '<p class="description">This is the Description. Again HTML is allowed2</p>', 'thefoxwp' ),
                    'fields'  => array(
                        array(
                            'id'       => 'opt-text-email',
                            'type'     => 'text',
                            'title'    => __( 'Text Option - Email Validated', 'thefoxwp' ),
                            'subtitle' => __( 'This is a little space under the Field Title in the Options table, additional info is good in here.', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate' => 'email',
                            'msg'      => 'custom error message',
                            'default'  => 'test@test.com',
                            //                        'text_hint' => array(
                            //                            'title'     => 'Valid Email Required!',
                            //                            'content'   => 'This field required a valid email address.'
                            //                        )
                        ),
                        array(
                            'id'       => 'opt-text-post-type',
                            'type'     => 'text',
                            'title'    => __( 'Text Option with Data Attributes', 'thefoxwp' ),
                            'subtitle' => __( 'You can also pass an options array if you want. Set the default to whatever you like.', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'data'     => 'post_type',
                        ),
                        array(
                            'id'       => 'opt-multi-text',
                            'type'     => 'multi_text',
                            'title'    => __( 'Multi Text Option - Color Validated', 'thefoxwp' ),
                            'validate' => 'color',
                            'subtitle' => __( 'If you enter an invalid color it will be removed. Try using the text "blue" as a color.  ;)', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' )
                        ),
                        array(
                            'id'       => 'opt-text-url',
                            'type'     => 'text',
                            'title'    => __( 'Text Option - URL Validated', 'thefoxwp' ),
                            'subtitle' => __( 'This must be a URL.', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate' => 'url',
                            'default'  => 'http://reduxframework.com',
                            //                        'text_hint' => array(
                            //                            'title'     => '',
                            //                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
                            //                        )
                        ),
                        array(
                            'id'       => 'opt-text-numeric',
                            'type'     => 'text',
                            'title'    => __( 'Text Option - Numeric Validated', 'thefoxwp' ),
                            'subtitle' => __( 'This must be numeric.', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate' => 'numeric',
                            'default'  => '0',
                        ),
                        array(
                            'id'       => 'opt-text-comma-numeric',
                            'type'     => 'text',
                            'title'    => __( 'Text Option - Comma Numeric Validated', 'thefoxwp' ),
                            'subtitle' => __( 'This must be a comma separated string of numerical values.', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate' => 'comma_numeric',
                            'default'  => '0',
                        ),
                        array(
                            'id'       => 'opt-text-no-special-chars',
                            'type'     => 'text',
                            'title'    => __( 'Text Option - No Special Chars Validated', 'thefoxwp' ),
                            'subtitle' => __( 'This must be a alpha numeric only.', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate' => 'no_special_chars',
                            'default'  => '0'
                        ),
                        array(
                            'id'       => 'opt-text-str_replace',
                            'type'     => 'text',
                            'title'    => __( 'Text Option - Str Replace Validated', 'thefoxwp' ),
                            'subtitle' => __( 'You decide.', 'thefoxwp' ),
                            'desc'     => __( 'This field\'s default value was changed by a filter hook!', 'thefoxwp' ),
                            'validate' => 'str_replace',
                            'str'      => array(
                                'search'      => ' ',
                                'replacement' => 'thisisaspace'
                            ),
                            'default'  => 'This is the default.'
                        ),
                        array(
                            'id'       => 'opt-text-preg_replace',
                            'type'     => 'text',
                            'title'    => __( 'Text Option - Preg Replace Validated', 'thefoxwp' ),
                            'subtitle' => __( 'You decide.', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate' => 'preg_replace',
                            'preg'     => array(
                                'pattern'     => '/[^a-zA-Z_ -]/s',
                                'replacement' => 'no numbers'
                            ),
                            'default'  => '0'
                        ),
                        array(
                            'id'                => 'opt-text-custom_validate',
                            'type'              => 'text',
                            'title'             => __( 'Text Option - Custom Callback Validated', 'thefoxwp' ),
                            'subtitle'          => __( 'You decide.', 'thefoxwp' ),
                            'desc'              => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate_callback' => 'redux_validate_callback_function',
                            'default'           => '0'
                        ),
                        array(
                            'id'                => 'opt-text-custom_validate-class',
                            'type'              => 'text',
                            'title'             => __( 'Text Option - Custom Callback Validated - Class', 'thefoxwp' ),
                            'subtitle'          => __( 'You decide.', 'thefoxwp' ),
                            'desc'              => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate_callback' => array( $this, 'validate_callback_function' ),
                            // You can pass the current class
                            // Or pass the class name and method
                            //'validate_callback' => array(
                            //    'Redux_Framework_sample_config',
                            //    'validate_callback_function'
                            //),
                            'default'           => '0'
                        ),
                        array(
                            'id'       => 'opt-textarea-no-html',
                            'type'     => 'textarea',
                            'title'    => __( 'Textarea Option - No HTML Validated', 'thefoxwp' ),
                            'subtitle' => __( 'All HTML will be stripped', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate' => 'no_html',
                            'default'  => 'No HTML is allowed in here.'
                        ),
                        array(
                            'id'       => 'opt-textarea-html',
                            'type'     => 'textarea',
                            'title'    => __( 'Textarea Option - HTML Validated', 'thefoxwp' ),
                            'subtitle' => __( 'HTML Allowed (wp_kses)', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                            'default'  => 'HTML is allowed in here.'
                        ),
                        array(
                            'id'           => 'opt-textarea-some-html',
                            'type'         => 'textarea',
                            'title'        => __( 'Textarea Option - HTML Validated Custom', 'thefoxwp' ),
                            'subtitle'     => __( 'Custom HTML Allowed (wp_kses)', 'thefoxwp' ),
                            'desc'         => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate'     => 'html_custom',
                            'default'      => '<p>Some HTML is allowed in here.</p>',
                            'allowed_html' => array( '' ) //see http://codex.wordpress.org/Function_Reference/wp_kses
                        ),
                        array(
                            'id'       => 'opt-textarea-js',
                            'type'     => 'textarea',
                            'title'    => __( 'Textarea Option - JS Validated', 'thefoxwp' ),
                            'subtitle' => __( 'JS will be escaped', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'validate' => 'js'
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon'   => 'el el-check',
                    'title'  => __( 'Radio/Checkbox Fields', 'thefoxwp' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'thefoxwp' ),
                    'fields' => array(
                        array(
                            'id'       => 'opt-checkbox',
                            'type'     => 'checkbox',
                            'title'    => __( 'Checkbox Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'default'  => '1'// 1 = on | 0 = off
                        ),
                        array(
                            'id'       => 'opt-multi-check',
                            'type'     => 'checkbox',
                            'title'    => __( 'Multi Checkbox Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            //Must provide key => value pairs for multi checkbox options
                            'options'  => array(
                                '1' => 'Opt 1',
                                '2' => 'Opt 2',
                                '3' => 'Opt 3'
                            ),
                            //See how std has changed? you also don't need to specify opts that are 0.
                            'default'  => array(
                                '1' => '1',
                                '2' => '0',
                                '3' => '0'
                            )
                        ),
                        array(
                            'id'       => 'opt-checkbox-data',
                            'type'     => 'checkbox',
                            'title'    => __( 'Multi Checkbox Option (with menu data)', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'data'     => 'menu'
                        ),
                        array(
                            'id'       => 'opt-checkbox-sidebar',
                            'type'     => 'checkbox',
                            'title'    => __( 'Multi Checkbox Option (with sidebar data)', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'data'     => 'sidebars'
                        ),
                        array(
                            'id'       => 'opt-radio',
                            'type'     => 'radio',
                            'title'    => __( 'Radio Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                '1' => 'Opt 1',
                                '2' => 'Opt 2',
                                '3' => 'Opt 3'
                            ),
                            'default'  => '2'
                        ),
                        array(
                            'id'       => 'opt-radio-data',
                            'type'     => 'radio',
                            'title'    => __( 'Multi Checkbox Option (with menu data)', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'data'     => 'menu'
                        ),
                        array(
                            'id'       => 'opt-image-select',
                            'type'     => 'image_select',
                            'title'    => __( 'Images Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            //Must provide key => value(array:title|img) pairs for radio options
                            'options'  => array(
                                '1' => array( 'title' => 'Opt 1', 'img' => 'images/align-none.png' ),
                                '2' => array( 'title' => 'Opt 2', 'img' => 'images/align-left.png' ),
                                '3' => array( 'title' => 'Opt 3', 'img' => 'images/align-center.png' ),
                                '4' => array( 'title' => 'Opt 4', 'img' => 'images/align-right.png' )
                            ),
                            'default'  => '2'
                        ),
                        array(
                            'id'       => 'opt-image-select-layout',
                            'type'     => 'image_select',
                            'title'    => __( 'Images Option for Layout', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This uses some of the built in images, you can use them for layout options.', 'thefoxwp' ),
                            //Must provide key => value(array:title|img) pairs for radio options
                            'options'  => array(
                                '1' => array(
                                    'alt' => '1 Column',
                                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                                ),
                                '2' => array(
                                    'alt' => '2 Column Left',
                                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                                ),
                                '3' => array(
                                    'alt' => '2 Column Right',
                                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                                ),
                                '4' => array(
                                    'alt' => '3 Column Middle',
                                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                                ),
                                '5' => array(
                                    'alt' => '3 Column Left',
                                    'img' => ReduxFramework::$_url . 'assets/img/3cl.png'
                                ),
                                '6' => array(
                                    'alt' => '3 Column Right',
                                    'img' => ReduxFramework::$_url . 'assets/img/3cr.png'
                                )
                            ),
                            'default'  => '2'
                        ),
                        array(
                            'id'       => 'opt-sortable',
                            'type'     => 'sortable',
                            'title'    => __( 'Sortable Text Option', 'thefoxwp' ),
                            'subtitle' => __( 'Define and reorder these however you want.', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'label'     => true,
                            'options'  => array(
                                'si1' => 'Item 1',
                                'si2' => 'Item 2',
                                'si3' => 'Item 3',
                            )
                        ),
                        array(
                            'id'       => 'opt-check-sortable',
                            'type'     => 'sortable',
                            'mode'     => 'checkbox', // checkbox or text
                            'title'    => __( 'Sortable Text Option', 'thefoxwp' ),
                            'subtitle' => __( 'Define and reorder these however you want.', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'options'  => array(
                                'si1' => false,
                                'si2' => true,
                                'si3' => false,
                            )
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon'   => 'el el-list-alt',
                    'title'  => __( 'Select Fields', 'thefoxwp' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'thefoxwp' ),
                    'fields' => array(
                        array(
                            'id'       => 'opt-select',
                            'type'     => 'select',
                            'title'    => __( 'Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            //Must provide key => value pairs for select options
                            'options'  => array(
                                '1' => 'Opt 1',
                                '2' => 'Opt 2',
                                '3' => 'Opt 3',
                            ),
                            'default'  => '2'
                        ),
                        array(
                            'id'       => 'opt-select-optgroup',
                            'type'     => 'select',
                            'title'    => __( 'Select Option with optgroup', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            //Must provide key => value pairs for select options
                            'options'  => array(
                                'Group 1' => array(
                                    '1' => 'Opt 1',
                                    '2' => 'Opt 2',
                                    '3' => 'Opt 3',
                                ),

                                'Group 2' => array(
                                    '4' => 'Opt 4',
                                    '5' => 'Opt 5',
                                    '6' => 'Opt 6',
                                ),

                                '7' => 'Opt 7',
                                '8' => 'Opt 8',
                                '9' => 'Opt 9',
                            ),
                            'default'  => '2'
                        ),

                        array(
                            'id'       => 'opt-multi-select',
                            'type'     => 'select',
                            'multi'    => true,
                            'title'    => __( 'Multi Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                '1' => 'Opt 1',
                                '2' => 'Opt 2',
                                '3' => 'Opt 3'
                            ),
                            //'required' => array( 'opt-select', 'equals', array( '1', '3' ) ),
                            'default'  => array( '2', '3' )
                        ),
                        array(
                            'id'       => 'opt-select-image',
                            'type'     => 'select_image',
                            'title'    => __( 'Select Image', 'thefoxwp' ),
                            'subtitle' => __( 'A preview of the selected image will appear underneath the select box.', 'thefoxwp' ),
                            'options'  => $sample_patterns,
                            // Alternatively
                            //'options'   => Array(
                            //                'img_name' => 'img_path'
                            //             )
                            'default'  => 'tree_bark.png',
                        ),
                        array(
                            'id'   => 'opt-info',
                            'type' => 'info',
                            'desc' => __( 'You can easily add a variety of data from WordPress.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-categories',
                            'type'     => 'select',
                            'data'     => 'categories',
                            'title'    => __( 'Categories Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-categories-multi',
                            'type'     => 'select',
                            'data'     => 'categories',
                            'multi'    => true,
                            'title'    => __( 'Categories Multi Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-pages',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'title'    => __( 'Pages Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-multi-select-pages',
                            'type'     => 'select',
                            'data'     => 'pages',
                            'multi'    => true,
                            'title'    => __( 'Pages Multi Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-tags',
                            'type'     => 'select',
                            'data'     => 'tags',
                            'title'    => __( 'Tags Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-multi-select-tags',
                            'type'     => 'select',
                            'data'     => 'tags',
                            'multi'    => true,
                            'title'    => __( 'Tags Multi Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-menus',
                            'type'     => 'select',
                            'data'     => 'menus',
                            'title'    => __( 'Menus Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-multi-select-menus',
                            'type'     => 'select',
                            'data'     => 'menu',
                            'multi'    => true,
                            'title'    => __( 'Menus Multi Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-post-type',
                            'type'     => 'select',
                            'data'     => 'post_type',
                            'title'    => __( 'Post Type Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-multi-select-post-type',
                            'type'     => 'select',
                            'data'     => 'post_type',
                            'multi'    => true,
                            'title'    => __( 'Post Type Multi Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-multi-select-sortable',
                            'type'     => 'select',
                            'data'     => 'post_type',
                            'multi'    => true,
                            'sortable' => true,
                            'title'    => __( 'Post Type Multi Select Option + Sortable', 'thefoxwp' ),
                            'subtitle' => __( 'This field also has sortable enabled!', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-posts',
                            'type'     => 'select',
                            'data'     => 'post',
                            'title'    => __( 'Posts Select Option2', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-multi-select-posts',
                            'type'     => 'select',
                            'data'     => 'post',
                            'multi'    => true,
                            'title'    => __( 'Posts Multi Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-roles',
                            'type'     => 'select',
                            'data'     => 'roles',
                            'title'    => __( 'User Role Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-capabilities',
                            'type'     => 'select',
                            'data'     => 'capabilities',
                            'multi'    => true,
                            'title'    => __( 'Capabilities Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'opt-select-elusive',
                            'type'     => 'select',
                            'data'     => 'elusive-icons',
                            'title'    => __( 'Elusive Icons Select Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'Here\'s a list of all the elusive icons by name and icon.', 'thefoxwp' ),
                        ),
                    )
                );

                $theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'thefoxwp' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'thefoxwp' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'thefoxwp' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'thefoxwp' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';

                if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
                    $this->sections['theme_docs'] = array(
                        'icon'   => 'el el-list-alt',
                        'title'  => __( 'Documentation', 'thefoxwp' ),
                        'fields' => array(
                            array(
                                'id'       => '17',
                                'type'     => 'raw',
                                'markdown' => true,
                                'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                            ),
                        ),
                    );
                }

                // You can append a new section at any time.
                $this->sections[] = array(
                    'icon'   => 'el el-eye-open',
                    'title'  => __( 'Additional Fields', 'thefoxwp' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'thefoxwp' ),
                    'fields' => array(
                        array(
                            'id'       => 'opt-datepicker',
                            'type'     => 'date',
                            'title'    => __( 'Date Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' )
                        ),
                        array(
                            'id'   => 'opt-divide',
                            'type' => 'divide'
                        ),
                        array(
                            'id'       => 'opt-button-set',
                            'type'     => 'button_set',
                            'title'    => __( 'Button Set Option', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                '1' => 'Opt 1',
                                '2' => 'Opt 2',
                                '3' => 'Opt 3'
                            ),
                            'default'  => '2'
                        ),
                        array(
                            'id'       => 'opt-button-set-multi',
                            'type'     => 'button_set',
                            'title'    => __( 'Button Set, Multi Select', 'thefoxwp' ),
                            'subtitle' => __( 'No validation can be done on this field type', 'thefoxwp' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'thefoxwp' ),
                            'multi'    => true,
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                '1' => 'Opt 1',
                                '2' => 'Opt 2',
                                '3' => 'Opt 3'
                            ),
                            'default'  => array( '2', '3' )
                        ),
                        array(
                            'id'   => 'opt-info-field',
                            'type' => 'info',
                            'desc' => __( 'This is the info field, if you want to break sections up.', 'thefoxwp' )
                        ),
                        array(
                            'id'    => 'opt-info-warning',
                            'type'  => 'info',
                            'style' => 'warning',
                            'title' => __( 'This is a title.', 'thefoxwp' ),
                            'desc'  => __( 'This is an info field with the warning style applied and a header.', 'thefoxwp' )
                        ),
                        array(
                            'id'    => 'opt-info-success',
                            'type'  => 'info',
                            'style' => 'success',
                            'icon'  => 'el el-info-circle',
                            'title' => __( 'This is a title.', 'thefoxwp' ),
                            'desc'  => __( 'This is an info field with the success style applied, a header and an icon.', 'thefoxwp' )
                        ),
                        array(
                            'id'    => 'opt-info-critical',
                            'type'  => 'info',
                            'style' => 'critical',
                            'icon'  => 'el el-info-circle',
                            'title' => __( 'This is a title.', 'thefoxwp' ),
                            'desc'  => __( 'This is an info field with the critical style applied, a header and an icon.', 'thefoxwp' )
                        ),
                        array(
                            'id'       => 'opt-raw_info',
                            'type'     => 'info',
                            'required' => array( '18', 'equals', array( '1', '2' ) ),
                            'raw_html' => true,
                            'desc'     => $sampleHTML,
                        ),
                        array(
                            'id'     => 'opt-info-normal',
                            'type'   => 'info',
                            'notice' => true,
                            'title'  => __( 'This is a title.', 'thefoxwp' ),
                            'desc'   => __( 'This is an info notice field with the normal style applied, a header and an icon.', 'thefoxwp' )
                        ),
                        array(
                            'id'     => 'opt-notice-info',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'info',
                            'title'  => __( 'This is a title.', 'thefoxwp' ),
                            'desc'   => __( 'This is an info notice field with the info style applied, a header and an icon.', 'thefoxwp' )
                        ),
                        array(
                            'id'     => 'opt-notice-warning',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'warning',
                            'icon'   => 'el el-info-circle',
                            'title'  => __( 'This is a title.', 'thefoxwp' ),
                            'desc'   => __( 'This is an info notice field with the warning style applied, a header and an icon.', 'thefoxwp' )
                        ),
                        array(
                            'id'     => 'opt-notice-success',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'success',
                            'icon'   => 'el el-info-circle',
                            'title'  => __( 'This is a title.', 'thefoxwp' ),
                            'desc'   => __( 'This is an info notice field with the success style applied, a header and an icon.', 'thefoxwp' )
                        ),
                        array(
                            'id'     => 'opt-notice-critical',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'critical',
                            'icon'   => 'el el-info-circle',
                            'title'  => __( 'This is a title.', 'thefoxwp' ),
                            'desc'   => __( 'This is an notice field with the critical style applied, a header and an icon.', 'thefoxwp' )
                        ),
                        array(
                            'id'       => 'opt-custom-callback',
                            'type'     => 'callback',
                            'title'    => __( 'Custom Field Callback', 'thefoxwp' ),
                            'subtitle' => __( 'This is a completely unique field type', 'thefoxwp' ),
                            'desc'     => __( 'This is created with a callback function, so anything goes in this field. Make sure to define the function though.', 'thefoxwp' ),
                            'callback' => 'redux_my_custom_field'
                        ),
                        array(
                            'id'       => 'opt-custom-callback-class',
                            'type'     => 'callback',
                            'title'    => __( 'Custom Field Callback - Class', 'thefoxwp' ),
                            'subtitle' => __( 'This is a completely unique field type', 'thefoxwp' ),
                            'desc'     => __( 'This is created with a callback function, so anything goes in this field. Make sure to define the function though.', 'thefoxwp' ),
                            //'callback'  => array( $this, 'class_field_callback' ) // Can use the current class object
                            'callback' => array( 'Redux_Framework_sample_config', 'class_field_callback' )
                            // Can use just class name
                        ),
                        array(
                            'id'              => 'opt-customizer-only-in-section',
                            'type'            => 'select',
                            'title'           => __( 'Customizer Only Option', 'thefoxwp' ),
                            'subtitle'        => __( 'The subtitle is NOT visible in customizer', 'thefoxwp' ),
                            'desc'            => __( 'The field desc is NOT visible in customizer.', 'thefoxwp' ),
                            'customizer_only' => true,
                            //Must provide key => value pairs for select options
                            'options'         => array(
                                '1' => 'Opt 1',
                                '2' => 'Opt 2',
                                '3' => 'Opt 3'
                            ),
                            'default'         => '2'
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon'            => 'el el-list-alt',
                    'title'           => __( 'Customizer Only', 'thefoxwp' ),
                    'desc'            => __( '<p class="description">This Section should be visible only in Customizer</p>', 'thefoxwp' ),
                    'customizer_only' => true,
                    'fields'          => array(
                        array(
                            'id'              => 'opt-customizer-only',
                            'type'            => 'select',
                            'title'           => __( 'Customizer Only Option', 'thefoxwp' ),
                            'subtitle'        => __( 'The subtitle is NOT visible in customizer', 'thefoxwp' ),
                            'desc'            => __( 'The field desc is NOT visible in customizer.', 'thefoxwp' ),
                            'customizer_only' => true,
                            //Must provide key => value pairs for select options
                            'options'         => array(
                                '1' => 'Opt 1',
                                '2' => 'Opt 2',
                                '3' => 'Opt 3'
                            ),
                            'default'         => '2'
                        ),
                    )
                );

                $this->sections[] = array(
                    'title'  => __( 'WPML Example', 'thefoxwp' ),
                    'desc'   => __( 'These fields can be fully translated by WPML (WordPress Multi-Language). This serves as an example for you to implement. For extra details look at our <a href="http://docs.reduxframework.com/core/advanced/wpml-integration/" target="_blank">WPML Implementation</a> documentation.', 'thefoxwp' ),
                    'icon'   => 'el el-home',
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(
                        array(
                            'id'       => 'wpml-text',
                            'type'     => 'textarea',
                            'title'    => __( 'WPML Text', 'thefoxwp' ),
                            'desc'     => __( 'This string can be translated via WPML.', 'thefoxwp' ),
                        ),
                        array(
                            'id'       => 'wpml-multicheck',
                            'type'     => 'checkbox',
                            'title'    => __( 'WPML Multi Checkbox', 'thefoxwp' ),
                            'desc'     => __( 'You can literally translate the values via key.', 'thefoxwp' ),
                            //Must provide key => value pairs for multi checkbox options
                            'options'  => array(
                                '1' => 'Option 1',
                                '2' => 'Option 2',
                                '3' => 'Option 3'
                            ),
                        ),
                    )
                );

                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'thefoxwp' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'thefoxwp' ),
                    'icon'   => 'el el-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'icon'   => 'el el-info-circle',
                    'title'  => __( 'Theme Information', 'thefoxwp' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'thefoxwp' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );

                if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                    $tabs['docs'] = array(
                        'icon'    => 'el el-book',
                        'title'   => __( 'Documentation', 'thefoxwp' ),
                        'content' => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                    );
                }
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'thefoxwp' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'thefoxwp' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'thefoxwp' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'thefoxwp' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'thefoxwp' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'redux_demo',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Sample Options', 'thefoxwp' ),
                    'page_title'           => __( 'Sample Options', 'thefoxwp' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => true,
                    // Show the time the page took to load, etc
                    'update_notice'        => true,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => true,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => '',
                    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'el el-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-docs',
                    'href'   => 'http://docs.reduxframework.com/',
                    'title' => __( 'Documentation', 'thefoxwp' ),
                );

                $this->args['admin_bar_links'][] = array(
                    //'id'    => 'redux-support',
                    'href'   => 'https://github.com/ReduxFramework/redux-framework/issues',
                    'title' => __( 'Support', 'thefoxwp' ),
                );

                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-extensions',
                    'href'   => 'reduxframework.com/extensions',
                    'title' => __( 'Extensions', 'thefoxwp' ),
                );

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                    'title' => 'Visit us on GitHub',
                    'icon'  => 'el el-github'
                    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el el-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'http://twitter.com/reduxframework',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el el-twitter'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'http://www.linkedin.com/company/redux-framework',
                    'title' => 'Find us on LinkedIn',
                    'icon'  => 'el el-linkedin'
                );

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'thefoxwp' ), $v );
                } else {
                    $this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'thefoxwp' );
                }

                // Add content after the form.
                $this->args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'thefoxwp' );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public static function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_sample_config();
    } else {
        echo "The class named Redux_Framework_sample_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            $return['warning'] = $field;

            return $return;
        }
    endif;