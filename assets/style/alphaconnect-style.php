<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-style.php
*  =================================== */


 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
 	/********************************
	 * 		Load css file
	 ********************************/

	function acpc_admin_style($hooks) {
		if ('toplevel_page_popupcreator' != $hooks && 
			'popup-creator_page_popup_create' != $hooks  && 
			'popup-creator_page_popup_edit' !=$hooks &&
			'popup-creator_page_settings_popup' !=$hooks &&
			'popup-creator_page_contactdetails' !=$hooks &&
			'popup-creator_page_subscribers_user' !=$hooks ){
			return;
		}
		wp_register_style('alphaconnect_style', ALPHACONNECT_POPUP_STYLE . '/alphaconnect-style.css', array(), ALPHACONNECT_POPUP_VERSION);
		wp_enqueue_style('alphaconnect_style');

		wp_register_style('alphaconnect-datepicker', ALPHACONNECT_POPUP_STYLE. '/admin/bootstrap-datepicker.css', array());
		wp_enqueue_style('alphaconnect-datepicker');

		wp_register_style('alphaconnect_bootstrap', ALPHACONNECT_POPUP_STYLE . '/admin/bootstrap.min.css',  array() );
		wp_enqueue_style('alphaconnect_bootstrap');
		
		$RsaStatus = ALPHACONNECTFUNCTION::popupTablesRsaStatus();
		if(!empty($RsaStatus)) {
		wp_register_style('alphaconnect_multiselect', ALPHACONNECT_POPUP_STYLE . '/admin/bootstrap-multiselect.css', array(), ALPHACONNECT_POPUP_VERSION );
		wp_enqueue_style('alphaconnect_multiselect');
		}else{
			return false;
		}
	
	}
	add_action( 'admin_enqueue_scripts', 'acpc_admin_style' );
