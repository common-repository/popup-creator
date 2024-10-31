<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect-mainfunction.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; 

 /************************
  * Create Menu Options
  ***********************/

class AlpConPopupCreatorMain {

	public function init() {

		$this->filters();
		$this->acpcactions();
	}

	public function acpcactions() {
		
		add_action("admin_menu",array($this, "acpc_addmenu"));
	}
	/*********  SubMenu page   ************/

    public function acpc_addmenu($args) {
		$showCurrentUser = ALPHACONNECTFUNCTION::ShowMenuForCurrentUser();
		if(!$showCurrentUser) {
			return false;
		}


	add_menu_page("Popup Creator", "Popup Creator", "manage_options","popupcreator",array($this,"acpc_mainmenu"),"dashicons-screenoptions");
	add_submenu_page("popupcreator", "All Popups", "All Popups", 'manage_options', "popupcreator", array($this,"acpc_mainmenu"));
	add_submenu_page("popupcreator", "Add New", "Add New", 'manage_options', "popup_create", array($this,"acpc_createpopup"));	
	add_submenu_page("popupcreator", "Edit Popup", "Settings", 'manage_options', "settings_popup", array($this,"acpc_popupsettings"));
	$RsaStatus = ALPHACONNECTFUNCTION::popupTablesRsaStatus();
		if(!empty($RsaStatus)) {
			add_submenu_page("popupcreator", "Subscribers", "Subscribers", 'manage_options', "subscribers_user", array($this,"acpc_subscribers"));
			add_submenu_page("popupcreator", "ContactDetails", "Contact Details", 'manage_options', "contactdetails", array($this,"acpc_contactdetails"));
		}
        
	add_submenu_page("popupcreator", "Edit Popup", null, 'manage_options', "popup_edit", array($this,"acpc_editpopup"));
   } 

	/************* Popup Table Page ************************/

    public function acpc_mainmenu() {

		require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-mainpage.php');
	}

	/************* Add New Popup Page **********************/

	public function acpc_createpopup() {

		require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-addnew.php'); 
	}

	/************* Create New Popup Page *********************/

	public function acpc_editpopup() {
		
		require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-createnew.php');
	}

	/************* Subscriber Details Table Page *************/

	public function acpc_subscribers() {

		require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-subscriberdetails.php');
	}

	/************* Contact Details Table Page ****************/

	public function acpc_contactdetails() {

		require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-contactdetails.php');
	}

	/************* Popup Setting Page ************************/

	public function acpc_popupsettings() {

		require_once ( ALPHACONNECT_POPUP_FILES . '/alphaconnect-settings.php');
	}
    
    public function filters() {
      
        add_filter('plugin_action_links_'. ALPHACONNECT_POPUP_BASENAME, array($this, 'popupPluginActionLink'));
    }

    public function popupPluginActionLink($links) {

        $popupActionLink = array(
            '<a href="' . ALPHACONNECT_POPUP_PRO_URL . '" target="_blank">Pro Version</a>'
        );
      
        return array_merge( $links, $popupActionLink );
    }
}