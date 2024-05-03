<?php
/**
 * Plugin Name: ETVO Blocks
 * Description: Special blocks for ETVO
 * Author: ETVO
 * Author URI: https://www.etvo-web.com
 * Version: 1.0
 * 
 * @package WordPress
 * @subpackage ETVO-Blocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Core constants 
define("PLUGIN_DIR", plugin_dir_path(__DIR__) . "etvo-blocks/");
define("PLUGIN_URL", plugins_url("etvo-blocks/"));
define("PLUGIN_CLASS", "ETVO_Blocks");

/**
 * ETVO Blocks plugin
 */
final class ETVO_Blocks {

    /**
     * Setup plugin
     * 
     * @since 1.0
     */
    public function __construct()
    {
        $this->plugin_constants();

        // Initialize blocks
        add_action('init', array(PLUGIN_CLASS, 'plugin_shortcodes'));

        // Enqueue scripts
        add_action('wp_enqueue_scripts', array(PLUGIN_CLASS, 'plugin_css'));
        add_action('wp_enqueue_scripts', array(PLUGIN_CLASS, 'plugin_js'));
    }

    /**
     * Define plugin constants
     *
     * @since 1.0
     */
    public static function plugin_constants() {
        
        // JS and CSS paths
        define('PLUGIN_CSS_URL', PLUGIN_URL . 'assets/css/');
        define('PLUGIN_JS_URL', PLUGIN_URL . 'assets/js/');

        // Include paths
        define('PLUGIN_SHORTCODES_DIR', PLUGIN_DIR . 'shortcodes/');
        define('PLUGIN_SHORTCODES_URL', PLUGIN_URL . 'shortcodes/');

        // Image paths
        define('PLUGIN_IMG_URL', PLUGIN_URL . 'assets/img/');
    }

    /**
     * Include blocks files
     *
     * @since 1.0
     */
    public static function plugin_shortcodes() {

        $dir = PLUGIN_SHORTCODES_DIR;

        include_once $dir . '/include.php'; 
        include_once $dir . '/helpers.php'; 
    }

    /**
     * Enqueue plugin CSS
     *
     * @since 1.0
     */
    public static function plugin_css() {
        $dir = PLUGIN_CSS_URL;

        // Registering the blocks.css for frontend + backend
        wp_enqueue_style(
            'plugin-etvo-css', 
            $dir . 'main.css',
            null,
            null
        );
        wp_enqueue_style(
            'plugin-bootstrap-css', 
            $dir . 'bootstrap.css',
            null,
            null
        );
    }

    /**
     * Enqueue plugin JS
     *
     * @since 1.0
     */
    public static function plugin_js() {
        $dir = PLUGIN_JS_URL;

        // Registering the blocks.js file in the dist folder
        wp_enqueue_script(
            'plugin-etvo-js',
            $dir . 'main.js',
            array(),
            null,
            true
        );
    }
    
    /**
     * Enqueue plugin admin CSS
     * 
     * @since 1.0
     */
    public static function plugin_admin_css() {
        $dir = PLUGIN_CSS_URL;

        // Registering the editor.css for backend
        wp_enqueue_style(
            'plugin-editor-css', 
            $dir . 'editor.css',
            array('wp-edit-blocks'),
            null
        );
    }
    
    /**
     * Enqueue plugin admin JS
     *
     * @since 1.0
     */
    public static function plugin_admin_js() {
        $dir = PLUGIN_JS_URL;

        // Registering the blocks.js file in the dist folder
        wp_enqueue_script(
            'plugin-blocks-js',
            $dir . 'blocks.js',
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components'),
            null,
            true
        );

        // WP Localized globals. Use dynamic PHP data in JavaScript via global object (array).
        wp_localize_script(
            'plugin-blocks-js',
            'pluginGlobal',
            [
                'dirPath' => PLUGIN_DIR,
                'dirUrl'  => PLUGIN_URL,
                'homeUrl' => home_url(),
            ]
        );
    }

    /**
     * Register custom category for Gutenberg blocks
     *
     * @param array $categories Categories already registered
     * @param WP_Post $post unused
     * @return array Updated list of block categories
     * @since 1.0
     */
    public static function custom_blocks_category($categories, $post) {
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'etvoblock',
                    'title' => __("Blocos ETVO")
                )
            ),
        );
    }
}

new ETVO_Blocks();