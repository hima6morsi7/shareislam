<?php
/**
 * Recommended plugins
 *
 * @package Newsium
 */

if ( ! function_exists( 'newsium_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function newsium_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'WP Post Author', 'newsium' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'newsium' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
            array(
                'name'     => __( 'Everest Forms', 'newsium' ),
                'slug'     => 'everest-forms',
                'required' => false,
            ),
            array(
                'name'     => __( 'Smush Image Compression and Optimization', 'newsium' ),
                'slug'     => 'wp-smushit',
                'required' => false,
            ),
            array(
                'name'     => __( 'MailChimp for WordPress', 'newsium' ),
                'slug'     => 'mailchimp-for-wp',
                'required' => false,
            ),
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'newsium_recommended_plugins' );
