<?php
/**
 * Plugin Name:  Popup Creator
 * Plugin URI:  https://alphaconnectgroup.com/products/
 * Description: The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
 * Version:     1.0.2
 * Author:      Alpha Connect Group
 * Author URI:  https://alphaconnectgroup.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpcom
 */

require_once (dirname(__FILE__)."/alphaconnect-config.php");
require_once (ALPHACONNECT_POPUP_CLASS .'/alphaconnect-mainfunction.php');

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$mainPopupObjects = new AlpConPopupCreatorMain();
$mainPopupObjects->init();

require_once ( ALPHACONNECT_POPUP_CLASS .'/alphaconnect-database.php');                     /* db connect */
require_once ( ALPHACONNECT_POPUP_FILES .'/alphaconnect-function.php');                     /* functions connect */
require_once ( ALPHACONNECT_POPUP_FILES .'/alphaconnect-getdata.php');                      /* edit And get the value */
require_once ( ALPHACONNECT_POPUP_CLASS .'/alphaconnect-install.php');                      /* cretae tables */
require_once ( ALPHACONNECT_POPUP_PATH  .'/assets/style/alphaconnect-style.php' );          /* include our css file */
require_once ( ALPHACONNECT_POPUP_PATH  .'/assets/javascript/alphaconnect-javascript.php' );/* include our js file */

register_activation_hook(__FILE__, 'acpc_activate');

add_action('wpmu_new_blog', 'acpc_install');

function acpc_install(){
    ALPHACONNECT_INSTALL::acpcinstall();
} 
function acpc_activate() {
    update_option('ALPHACONNECT_POPUP_VERSION', ALPHACONNECT_POPUP_VERSION);
    ALPHACONNECT_INSTALL::acpcinstall();
}
require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-publicfile.php');                  /* Frontend script */ 
require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-mediafile.php');                   /* Manage old version shortcode */
require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-savefie.php');                     /* saving form data */
require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-ajaxfile.php');                    /* Ajax Refernce */
require_once ( ALPHACONNECT_POPUP_PATH . '/assets/rsa/rsa.php');                            /* Rsa data */