<?php
 if(!function_exists('AlphaconnectPopupCreatorConfig')) {

    class AlphaconnectPopupCreatorConfig
    {   
     public function __construct(){
            $this->init();            
        }
        private function init() { 
            if (!defined('ABSPATH')) {
                exit();  }            
                define('ALPHACONNECT_POPUP_BASENAME', 'popup-creator/popup-creator.php');              
                define("ALPHACONNECT_POPUP_PATH", dirname(__FILE__));
                define('ALPHACONNECT_POPUP_URL', plugins_url('', __FILE__));
                define('ALPHACONNECT_POPUP_ADMIN_URL', admin_url());
                define('ALPHACONNECT_POPUP_FILE', plugin_basename(__FILE__));
                define('ALPHACONNECT_POPUP_FILES', ALPHACONNECT_POPUP_PATH . '/files');
                define('ALPHACONNECT_POPUP_CLASS', ALPHACONNECT_POPUP_PATH . '/class');
                define('ALPHACONNECT_POPUP_ASSETS', ALPHACONNECT_POPUP_URL . '/assets');
                define('ALPHACONNECT_POPUP_STYLE', ALPHACONNECT_POPUP_ASSETS . '/style');
                define('ALPHACONNECT_POPUP_IMG', ALPHACONNECT_POPUP_ASSETS . '/img');
                define('ALPHACONNECT_POPUP_JS', ALPHACONNECT_POPUP_ASSETS . '/javascript');
                define('ALPHACONNECT_POPUP_RSA', ALPHACONNECT_POPUP_ASSETS . '/rsa');
                define('ALPHACONNECT_POPUP_ADMIN_JS', ALPHACONNECT_POPUP_ASSETS . '/javascript/admin/');
                define('ALPHACONNECT_POPUP_SRC', ALPHACONNECT_POPUP_PATH . '/src/block/');
                define('ALPHACONNECT_POPUP_TABLE_LIMIT', 10 );
	            define('ALPHACONNECT_POPUP_PRO', 0.0);
                define('ALPHACONNECT_POPUP_FREE', 1.2);
                define('ALPHACONNECT_POPUP_VERSION', 1.2);
                define('ALPHACONNECT_POPUP_PRO_URL', 'https://alphaconnectgroup.com/products/');
                define('ALPHACONNECT_POPUP_MAIL', ALPHACONNECT_POPUP_ADMIN_URL . 'admin-post.php');

                global $POPUP_TITLES;
                global $ALPCON_INSIDE_POPUPS;

                $ALPCON_INSIDE_POPUPS = array();

            $POPUP_TITLES = array(
                'html' => 'HTML',
                'contactForm' => 'Contact Form',
                'subscriber' => 'Subscriber',
            );
        }
        
        public static function popupJsDataInitValues(){
            $popupCreatorVersion = ALPHACONNECT_POPUP_VERSION;
            $RsaStatus = ALPHACONNECTFUNCTION::popupTablesRsaStatus();
            if(!empty($RsaStatus)){
                    $popupCreatorFunctionVersion = ALPHACONNECT_POPUP_PRO;
                 }else{
                $popupCreatorFunctionVersion = ALPHACONNECT_POPUP_FREE;   
            }

            $Stringdata = "<script type='text/javascript'>
                            ALPHACONNECT_POPUPS_QUEUE = [];
                            ALPHACONNECT_POPUP_DATA = [];
                            ALPHACONNECT_POPUP_URL = '" . ALPHACONNECT_POPUP_URL . "';
                            ALPHACONNECT_POPUP_VERSION='" . $popupCreatorVersion . "." . $popupCreatorFunctionVersion. "';
                           </script>";

            return $Stringdata;
        }
        public static function getPopupCreatorFrontendScriptLocalizedStoredData()   {
            global $post;
            $localizedStoredData = array(
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'ajax_Nonce' => wp_create_nonce('alpPbNonce'),
                'postID' => $post->ID
            );

            return $localizedStoredData;
        }
    }
         
    $popupConfiguration = new AlphaconnectPopupCreatorConfig();
 }