<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 2 July 2019
* File 			: alphaconnect-jsjavascript.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; /*  Exit if accessed directly */

 require_once ( ALPHACONNECT_POPUP_FILES .'/alphaconnect-function.php');       /* functions connect */

wp_register_script('popup_handle', ALPHACONNECT_POPUP_URL . '/src/index.js',array('jquery'), ALPHACONNECT_POPUP_VERSION);

	/********************************
	 * 		Access Media file
	 ********************************/

add_action( 'wp_ajax_myprefix_get_image', 'acpc_get_image'   );
function acpc_get_image() {
    if(isset($_GET['id']) ){
        $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'myprefix-preview-image' ) );
        $data = array(
            'image'    => $image,
        );
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}

	/********************************
	 * 		Store LocalData file
	 ********************************/
$localizeData = array(
		'all_Popups' => ALPHACONNECTFUNCTION::getGutenbergEditorIdAndTitle(),
		'all_Events' => ALPHACONNECTFUNCTION::getGutenbergPopupEvent(),
		'title'   => __('Popup Creator'),
		'description'   => __('This block will help you to add Popup creators’s shortcode inside the page content'),
		'i18n'=> array(
			'title'            => __( 'WPForms', 'wpforms-lite' ),
			'description'      => __( 'Select and display one of your forms.', 'wpforms-lite' ),
			'form_keyword'     => __( 'form', 'wpforms-lite' ),
			'form_select'      => __( 'Select Popup', 'wpforms-lite' ),
			'form_settings'    => __( 'Form Settings', 'wpforms-lite' ),
			'form_selected'    => __( 'Form', 'wpforms-lite' ),
			'show_title'       => __( 'Show Title', 'wpforms-lite' ),
			'show_description' => __( 'Show Description', 'wpforms-lite' ),
		),
);


wp_localize_script( 'popup_handle', 'ALP_GUTENBERG_PARAMS', $localizeData );
wp_enqueue_script( 'popup_handle' );

	/********************************
	 * 	Run Admin Javasrcipt  file
	 ********************************/

function acpc_admin_scripts($hook) {	
	   if ( 'popup-creator_page_popup_edit' == $hook
		 || 'popup-creator_page_settings_popup' == $hook ) {

		wp_enqueue_media();
			$localizedData = array(
				'ajax_Nonce' => wp_create_nonce('popup-creator-ajax', 'alp_con_ajax_Nonce')
			);
			wp_localize_script('javascript', 'backendLocalData', $localizedData);

			wp_register_script('acpc_bootstrap-datepicker',ALPHACONNECT_POPUP_ADMIN_JS .'bootstrap-datepicker.js',array('jquery'));
			wp_enqueue_script('acpc_bootstrap-datepicker');

			// wp_register_script('acpc_bootstrap.min',ALPHACONNECT_POPUP_JS . '/bootstrap.min.js',array('jquery'),'',true );
			// wp_enqueue_script('acpc_bootstrap.min');

			// wp_register_script('acpc_popper',ALPHACONNECT_POPUP_JS . '/Popper.js',array('jquery'),'',true);
			// wp_enqueue_script('acpc_popper');

			wp_enqueue_script( 'bootstrap','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array( 'jquery' ),'',true );
			wp_enqueue_script( 'popper','https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery' ),'',true );

			wp_register_script('acpc_bootstrap-multiselect', ALPHACONNECT_POPUP_ADMIN_JS . 'bootstrap-multiselect.js', array('jquery'));
			wp_enqueue_script('acpc_bootstrap-multiselect');	
									
			$RsaStatus = ALPHACONNECTFUNCTION::popupTablesRsaStatus();
			if(!empty($RsaStatus)) {		
			wp_register_script('acpc_backend_pro', ALPHACONNECT_POPUP_JS . '/alphaconnect-probackend.js',array('jquery'),ALPHACONNECT_POPUP_VERSION);
			wp_enqueue_script('jquery');
			wp_enqueue_script('acpc_backend_pro');

			// wp_register_script('acpc_popper.min',ALPHACONNECT_POPUP_JS . '/Popper.js',array('jquery'));
			// wp_enqueue_script('acpc_popper.min');

			wp_register_script('acpc_backend', ALPHACONNECT_POPUP_JS . '/alphaconnect-backend.js',array('jquery'),ALPHACONNECT_POPUP_VERSION);
			wp_enqueue_script('acpc_backend');
				}else{		
			wp_register_script('acpc_backend', ALPHACONNECT_POPUP_JS . '/alphaconnect-backend.js',array('jquery'),ALPHACONNECT_POPUP_VERSION);
			wp_enqueue_script('jquery');
			wp_enqueue_script('acpc_backend');
	}
			
    }
	 else if('toplevel_page_popupcreator' == $hook  || $hook == 'toplevel_page_popup-settings'  || 'popup-creator_page_contactdetails' == $hook  || 'popup-creator_page_subscribers_user' == $hook  ){

		wp_register_script('acpc_ajax', ALPHACONNECT_POPUP_JS . '/alphaconnect-ajaxrequest.js',array('jquery'),ALPHACONNECT_POPUP_VERSION);
		wp_enqueue_script('acpc_ajax');
	    wp_enqueue_script('jquery');

	 }	
}

add_action('admin_enqueue_scripts', 'acpc_admin_scripts');


function acpc_frontendscript() {
	wp_enqueue_script('acpc_popup_core', plugins_url('/alphaconnect-core.js', __FILE__), ALPHACONNECT_POPUP_VERSION, true);
}
add_action('wp_enqueue_scripts', 'acpc_frontendscript');