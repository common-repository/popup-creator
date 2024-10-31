<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-getdata.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AlpConPopupGetData {

	public static function acpc_getDefaultValues() {

		$settingsParameters = array(
			'tables-delete-status' => 'on',
			'plugin_users_role' => array(),
			'alp-popup-time-zone' => 'Pacific/Midway'
		);

		$usersRoleList = self::acpc_getAllUserRoles();

		$defaultParams = array(
			'settingsParameters' =>  $settingsParameters,
			'usersRoleList' => $usersRoleList
		);

		return $defaultParams;
	}

	public static function acpc_getValue($optionName,$optionType) {

		$optionType = strtolower($optionType);
		$optionFunctionName = 'acpc_get'.ucfirst($optionType).'Options';
		$options = self::$optionFunctionName();
	

		if(isset($options[$optionName])) {
			return $options[$optionName];
		}
		
		$deafultSettings = $deafaultValues[$optionType.'Paramas'];

		return $deafultSettings[$optionName];
	}

	public static function acpc_getSettingsOptions() {

		global $wpdb;

		$st = $wpdb->prepare("SELECT options FROM ". $wpdb->prefix ."acpc_settings WHERE id = %d",1);
		$options = $wpdb->get_row($st, ARRAY_A);

		/*Option can be null when ex settings table does now exists for old users*/
		if(is_null($options)) {
			return array();
		}
		$options = json_decode($options['options'], true);

		return $options;
	}

	public static function acpc_getPopupTimeZone() {

		$options = self::acpc_getSettingsOptions();

		$popupImeZone = @$options['alp-popup-time-zone'];

		if(!isset($popupImeZone) || empty($popupImeZone)) {
			$popupImeZone = 'Asia/Yerevan';
		}
		
		return $popupImeZone;
	}

	public static function acpc_getPostsAllCategories() {

		 $cats =  get_categories(
			array(
				"hide_empty" => 0,
				"type"      => "post",      
				"orderby"   => "name",
				"order"     => "ASC"
			)
		);
		$catsParams = array();
		foreach ($cats as $cat) {

			$id = $cat->term_id;
			$name = $cat->name;
			$catsParams[$id] = $name;
		}

		return $catsParams;
	}

	public static function alpSetChecked($value) {

		if($value == '') {
			return '';
		}
		return 'checked';
	}

	public static function acpc_getAllUserRoles() {

		$rulesArray = array();
		if(!function_exists('get_editable_roles')){
			return $rulesArray;
		}

		$roles = get_editable_roles();
		foreach ($roles as $role_name => $role_info) {
			if($role_name == 'administrator') {
				continue;
			}
			$rulesArray["alpconpc_".$role_name] = $role_name;

		}
		return $rulesArray;
	}

	public static function acpc_getCurrentUserRole() {

		$role = 'administrator';

		if(is_multisite()) {

			$getUsersObj = get_users(
				array(
					'blog_id' => get_current_blog_id()
				)
			);
			if(is_array($getUsersObj)) {
				foreach ($getUsersObj as $key => $userData) {
					if($userData->ID == get_current_user_id()) {
						$roles = $userData->roles;
						if(is_array($roles) && !empty($roles)) {
							$role = $roles[0];
						}
					}
				}
			}

			return "alpconpc_".$role;
		}

		global $current_user, $wpdb;
		$userRoleKey = $wpdb->prefix . 'capabilities';
		$usersRoles = array_keys($current_user->$userRoleKey);

		if(is_array($usersRoles) && !empty($usersRoles)) {
			$role = $usersRoles[0];
		}

		return "alpconpc_".$role;
	}


	public static function acpc_isActivePopupCreator($id) {
		
		$obj = ALPHACONNECTPOPUPCREATOR::acpc_findById($id);
		if(empty($obj)) {
			return '';
		}
		$options = $obj->acpc_getPopupOptions();
		$options = json_decode($options, true);
	
		if(!isset($options['isActivePopupStatus']) || $options['isActivePopupStatus'] == 'on') {
			return "checked";
		}
		return "";
	}

	public static function acpc_getAllCustomPosts() {

		$args = array(
			'public' => true,
			'_builtin' => false
		);

		$allCustomPosts = get_post_types($args);

		return $allCustomPosts;
	}

	public static function acpc_getPopupPageUrl()
	{
		$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'post_title',
			'hierarchical' => 0,
			'exclude' => '',
			'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => 0,
			'parent' => -1,
			'exclude_tree' => '',
			'number' => 2,
			'offset' => 0,
			'post_type' => 'page',
			'post_status' => 'publish'
		);
		$pages = get_pages($args);

		if(empty($pages[0])) {
			return "";
		}

		$pageId  = $pages[0]->ID;
		$pageUrl = get_permalink($pageId);
		return $pageUrl;
	}
}