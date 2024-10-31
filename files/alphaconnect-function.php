<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File          : alphaconnect-function.php
*  =================================== */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ALPHACONNECTFUNCTION {

	    /************************************    
           Table filed set delete option
         ************************************/

    public static function popupTablesDeleteSatus() {

		global $wpdb;

		$st = $wpdb->prepare("SELECT * FROM ". $wpdb->prefix ."acpc_settings WHERE id = %d",1);
		$arr = $wpdb->get_row($st,ARRAY_A);

		if(empty($arr)) {
			return true;
		}

		$options = json_decode($arr['options'], true);
		$deleteStatus = ($options['tables-delete-status'] == 'on' ? true: false);
		
		return $deleteStatus;
	}	

	public static function popupTablesRsaStatus() {

	   global $wpdb;

	   $access_key = $wpdb->get_var($wpdb->prepare("SELECT accesskey FROM ". $wpdb->prefix ."acpc_settings WHERE id = %d",1)); 
		
	   $encrytedserver = md5($_SERVER['HTTP_HOST']);
		
		if($encrytedserver == $access_key ) {
			return true;
		}
	}	

        /************************************    
				Select Box Function
		************************************/
    public static function createSelectBox($data, $selectedValue, $attrs) {

        $attrString = '';
        $selected = '';
       
       if(!empty($attrs) && isset($attrs)) {

           foreach ($attrs as $attrName => $attrValue) {
               $attrString .= ''.$attrName.'="'.$attrValue.'" ';
           }
       }

       $selectBox = '<select '.$attrString.'>';

       foreach ($data as $value => $label) {

           if(is_array($selectedValue)) {
               $isSelected = in_array($value, $selectedValue);
               if($isSelected) {
                   $selected = 'selected';
               }
           }
           else if($selectedValue == $value) {
               $selected = 'selected';
           }
           else if(is_array($value) && in_array($selectedValue, $value)) {
               $selected = 'selected';
           }

           $selectBox .= '<option value="'.$value.'" '.$selected.'>'.$label.'</option>';
           $selected = '';
       }

       $selectBox .= '</select>';

       return $selectBox;
    }

        /************************************    
			  Radio Button Function
         ************************************/
	public static function alpCreateRadioElements($radioElements, $checkedValue)
	{
		$content = '';
		for ($i = 0; $i < count($radioElements); $i++) {
			$checked = '';
			$br = '';
			$radioElement = @$radioElements[$i];
			$name = @$radioElement['name'];
			$label = @$radioElement['label'];
			$value = @$radioElement['value'];
			$brValue = @$radioElement['newline'];
			$additionalHtml = @$radioElement['additionalHtml'];
			if($checkedValue == $value) {
				$checked = 'checked';
			}
			if($brValue) {
				$br = "<br>";
			}
			$content .= '<input class="radio-btn-fix" type="radio" name="'.$name.'" value="'.$value.'" '.$checked.'>';
			$content .= $additionalHtml.$br;
		}
		return $content;
	}

        /************************************    
           		Find Current user status 
         ************************************/
	public static function ShowMenuForCurrentUser() {
		$usersSelectedRoles = AlpConPopupGetData::acpc_getValue('plugin_users_role', 'settings');
		
		$currentUserRole = AlpConPopupGetData::acpc_getCurrentUserRole();

		if (is_super_admin()) {
			return true;
		}
		$usersSelectedRoles = (array)$usersSelectedRoles;
		if ((!empty($usersSelectedRoles) && !in_array($currentUserRole, $usersSelectedRoles))) {
			return false;
		}
		return true;
	}

	    /************************************  
		 *     Gudenberg Block   
         ************************************/
	public static function getGutenbergEditorIdAndTitle($excludesPopups = array()){
		$allPopups = ALPHACONNECTPOPUPCREATOR::findAll();
		$popupIdTitles = array();

		if (empty($allPopups)) {
			return $popupIdTitles;
		}

		foreach ($allPopups as $popup) {
			if (empty($popup)) {
				continue;
			}

			$id = $popup->acpc_getPopupId();
			$title = $popup->acpc_getPopupTitle();
			$type = $popup->acpc_getPopupType();

			if (!empty($excludesPopups)) {
				foreach ($excludesPopups as $excludesPopupId) {
					if ($excludesPopupId != $id) {
						$array = array();
						$array['id'] = $id;
						$array['title'] = $title . ' - ' . $type;
						$popupIdTitles[] = $array;
					}
				}
			}
			else {
				$array = array();
				$array['id'] = $id;
				$array['title'] = $title . ' - ' . $type;
				$popupIdTitles[] = $array;
			}
		}

		return $popupIdTitles;
	}

	public static function getGutenbergPopupEvent()
	{
		$data =  array(
			array('value' => '', 'title' => __('Select Event')),
			array('value' => 'onload', 'title' => __('On load')),
			array('value' => 'onclick', 'title' => __('On click')),
			array('value' => 'onhover', 'title' => __('On hover'))
		);
		return $data;
	}

}