<?php
/* ===================================
* Name			: Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-ajaxfile.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function alpSanitizeAjaxField($optionValue,  $isTextField = false) {
	if(!$isTextField) {
	}
}

/* popup delete ajax refernce */
function acpc_PopupDelete()
{
	check_ajax_referer('AlpConPopupCreatorDeleteNonce', 'ajax_Nonce');

	$id = (int)@$_POST['popup_id'];

	if($id == 0 || !$id) {
		return;
	}
	require_once (ALPHACONNECT_POPUP_CLASS.'/alphaconnect-database.php');
	ALPHACONNECTPOPUPCREATOR::delete($id);
	ALPHACONNECTPOPUPCREATOR::removePopupFromPages($id);
	$args = array('popupId'=> $id);
	do_action('acpc_PopupDelete', $args);
}

add_action('wp_ajax_delete_popup_creator', 'acpc_PopupDelete');

/* contact details  delete ajax refernce */
function acpc_PopupDataDelete(){
	
	// check_ajax_referer('alpContactDetaileRemove', 'ajax_Nonce');

	$id = (int)@$_POST['data_id'];
	if($id == 0 || !$id) {
		return;
	}
	require_once (ALPHACONNECT_POPUP_CLASS.'/alphaconnect-database.php');
	ALPHACONNECTPOPUPCREATOR::deletedata($id);
	$args = array('popupId'=> $id);
	do_action('acpc_PopupDataDelete', $args);
}

add_action('wp_ajax_delete_popup_data_creator', 'acpc_PopupDataDelete');

/* Subscribers details  delete ajax refernce */
function acpc_subscriberDelete(){
	
		// check_ajax_referer('alpContactDetaileRemove', 'ajax_Nonce');

	$id = (int)@$_POST['data_id'];
	if($id == 0 || !$id) {
		return;
	}
	require_once (ALPHACONNECT_POPUP_CLASS.'/alphaconnect-database.php');
	ALPHACONNECTPOPUPCREATOR::deletedatasub($id);
	$args = array('popupId'=> $id);
	do_action('acpc_subscriberDelete', $args);
}

add_action('wp_ajax_delete_popup_data_creator', 'acpc_subscriberDelete');
