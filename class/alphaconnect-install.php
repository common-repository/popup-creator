<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect-install.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ALPHACONNECT_INSTALL
{
	public static $mainTableName = "acpc_popup";

	public static function createTables($blogId)
	{
		global $wpdb;
		update_option('ALPHACONNECT_POPUP_VERSION', ALPHACONNECT_POPUP_VERSION);
		
		$alpPopupBase = "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix.$blogId."acpc_popup (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`type` varchar(255) NOT NULL,
			`title` varchar(255) NOT NULL,
			`options` text NOT NULL,
			PRIMARY KEY (id)
		)";
		$alpPopupSettingsBase = "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix.$blogId."acpc_settings (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`options` LONGTEXT NOT NULL,
			`accesskey` varchar(255) NOT NULL,  
			`time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY (id)
		)";
		
	  	$optionsDefault = AlpConPopupGetData::acpc_getDefaultValues();
		$alpPopupInsertSettingsSql = $wpdb->prepare("INSERT IGNORE ". $wpdb->prefix.$blogId."acpc_settings (id, options) VALUES(%d,%s) ", 1, json_encode($optionsDefault['settingsParameters']));

		$alpPopupHtmlBase = "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix.$blogId."acpc_html (
			`id` int(11) NOT NULL,
			`content` text NOT NULL
		)";

		$alpPopupContactBase = "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix.$blogId."acpc_contact (
			`id` int(11) NOT NULL,
			`title` text NOT NULL,
			`options`  text NOT NULL,
			PRIMARY KEY (id)
		)";
		
		$alpPopupContactDetailsBase =  "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix.$blogId."acpc_contactdetails (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`firstname` varchar(150) NOT NULL,
			`lastname` varchar(150) NOT NULL,
			`mobile` varchar(50) NOT NULL,
			`e_mail` varchar(100) NOT NULL,
			`subject` varchar(150) NOT NULL,
			`message` text NOT NULL,
			`address` text NOT NULL,
			PRIMARY KEY (id)
		 )";
		 
		 $alpPopupsubScribersBase =  "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix.$blogId."acpc_subscriber (
			`id` int(11) NOT NULL,
			`title` text NOT NULL,
			`options`  text NOT NULL,
			PRIMARY KEY (id)
		 )";

		 $alpPopupSubscriberDetailsBase =  "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix.$blogId."acpc_subscriberdetails (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`Email` varchar(150) NOT NULL,
			PRIMARY KEY (id)
		 )";
		
		$wpdb->query($alpPopupBase);
		$wpdb->query($alpPopupSettingsBase);
		$wpdb->query($alpPopupInsertSettingsSql);
		$wpdb->query($alpPopupHtmlBase);
		$wpdb->query($alpPopupContactBase);
		$wpdb->query($alpPopupContactDetailsBase);		
		$wpdb->query($alpPopupsubScribersBase);
		$wpdb->query($alpPopupSubscriberDetailsBase);
	}

	public static function acpcinstall()
	{
		$obj = new self();
		$obj->createTables("");

		if(is_multisite() && get_current_blog_id() == 1 ) {
			global $wp_version;

			if($wp_version > '4.6.0') {
				$sites = get_sites();
			}else{
				$sites = wp_get_sites();
			}
			
			foreach($sites as $site) {

				if($wp_version > '5.0.0') {
					$blogId = $site->blog_id."_";
				}
				else {
					$blogId = $site['blog_id']."_";
				}
				if($blogId != 1) {
					self::createTables($blogId);
				}			
			}
		}
	}

	public static function acpcuninstallTables($blogId)
	{
		global $wpdb;
		$delete = "DELETE	FROM ".$wpdb->prefix.$blogId."postmeta WHERE meta_key = 'acpc_promotional_popup' ";
		$wpdb->query($delete);

		$popupTable = $wpdb->prefix.$blogId."acpc_popup";
		$popupSql = "DROP TABLE ". $popupTable;

		$popupSettingsDrop = $wpdb->prefix.$blogId."acpc_settings";
		$popupSettingsSql = "DROP TABLE ". $popupSettingsDrop;

		$popupHtmlTable = $wpdb->prefix.$blogId."acpc_html";
		$popupHtmlSql = "DROP TABLE ". $popupHtmlTable;

		$popupContactTable = $wpdb->prefix.$blogId."acpc_contact";
		$popupContactSql = "DROP TABLE ". $popupContactTable;

		$popupContactDetailTable = $wpdb->prefix.$blogId."acpc_contactdetails";
		$popupContactDetailsSql = "DROP TABLE ". $popupContactDetailTable;

		$popupSubscribersTable = $wpdb->prefix.$blogId."acpc_subscriber";
		$popupSubscribersSql = "DROP TABLE ". $popupSubscribersTable;

		$popupSubscribersDetailsTable = $wpdb->prefix.$blogId."acpc_subscriberdetails";
		$popupSubscribersDetailsSql = "DROP TABLE ". $popupSubscribersDetailsTable;


		$wpdb->query($popupSql);
		$wpdb->query($popupSettingsSql);
		$wpdb->query($popupHtmlSql);
		$wpdb->query($popupContactSql);
		$wpdb->query($popupContactDetailsSql);
		$wpdb->query($popupSubscribersSql);
		$wpdb->query($popupSubscribersDetailsSql);
	}

	public static function deleteAlpPopupOptions($blogId = '') {

		global $wpdb;
		$deleteALP = "DELETE FROM ".$wpdb->prefix.$blogId."options WHERE option_name LIKE '%ALP_CON_POPUP%'";
		$wpdb->query($deleteALP);
	}


	public static function acpcuninstall() {
		global $wpdb;
		$obj = new self();
		$obj->acpcuninstallTables("");

		if(is_multisite()) {
			$stites = wp_get_sites();
			foreach($stites as $site) {
				$blogsId = $site['blog_id']."_";
				global $wpdb;
				$obj->acpcuninstallTables($blogsId);
			}
		}
	}
}
