<?php
/**
 * Plugin Name:  WP Featherlight
 * Plugin URI:   https://github.com/Azragh/ntd-featherlight
 * Description:  An ultra lightweight jQuery lightbox for WordPress images and galleries. (NTD fork with PHP 8.2+ fixes)
 * Version:      1.3.5
 * Author:       Cipher / Daniel Geiser (NTD fork)
 * Author URI:   https://www.new-time.ch/
 * License:      GPL-2.0+
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  wp-featherlight
 * Domain Path:  /languages
 * Update URI:   https://github.com/Azragh/ntd-featherlight
 *
 * @package   WPFeatherlight
 * @copyright Copyright (c) 2018, Cipher Development
 * @license   GPL-2.0+
 * @since     0.1.0
 */

defined( 'WPINC' ) || die;

// Load the main plugin class.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/constants.php';

add_action( 'plugins_loaded', array( wp_featherlight(), 'run' ) );
/**
 * Allow themes and plugins to access WP_Featherlight methods and properties.
 *
 * Because we aren't using a singleton pattern for our main plugin class, we
 * need to make sure it's only instantiated once in our helper function.
 * If you need to access methods inside the plugin classes, use this function.
 *
 * Example:
 *
 * <?php wp_featherlight()->scripts; ?>
 *
 * @since  0.1.0
 * @access public
 * @uses   WP_Featherlight
 * @return object WP_Featherlight A single instance of the main plugin class.
 */
function wp_featherlight() {
	static $plugin;
	if ( null === $plugin ) {
		$plugin = new WP_Featherlight( array( 'file' => __FILE__ ) );
	}
	return $plugin;
}

/**
 * Register an activation hook to run all necessary plugin setup procedures.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
register_activation_hook( __FILE__, array( wp_featherlight(), 'activate' ) );

// GitHub-Updates (PUC)
// GitHub-Updates (PUC)
if ( file_exists( __DIR__ . '/lib/plugin-update-checker/plugin-update-checker.php' ) ) {
    require_once __DIR__ . '/lib/plugin-update-checker/plugin-update-checker.php';

    // Vollqualifizierter Aufruf (kein "use" nötig, kein Syntax-Fehler)
    $ntd_fl_upd = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
        'https://github.com/Azragh/ntd-featherlight',
        __FILE__,
        'wp-featherlight'
    );
    // Falls dein Default-Branch "main" ist:
    $ntd_fl_upd->setBranch('main');
    // Nutze das Release-Asset (wp-featherlight.zip)
    $ntd_fl_upd->getVcsApi()->enableReleaseAssets();
}
