<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect_html.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once (dirname(__FILE__).'/alphaconnect-database.php');

class alphaconnect_html extends ALPHACONNECTPOPUPCREATOR {
	public $content;

	public function acpc_setContent($content) {
		$this->content = $content;
	}
	public function acpc_getContent() {
		return $this->content;
	}
	public static function create($data, $obj = null) {
		$obj = new self();
		
		$obj->acpc_setContent($data['html']);

		return parent::create($data, $obj);
	}

	
	public function save($data = array()) {

		$editMode = $this->acpc_getPopupId()?true:false;
		
		$res = parent::save($data);
		
		if ($res===false) return false;
	
	 $alpHtmlPopup = $this->acpc_getContent();

		global $wpdb;
		if ($editMode) {
			$alpHtmlPopup = stripslashes($alpHtmlPopup);
			$sql = $wpdb->prepare("UPDATE ". $wpdb->prefix ."acpc_html SET content=%s WHERE id=%d",$alpHtmlPopup,$this->acpc_getPopupId());	
			$res = $wpdb->query($sql);
		}
		else {

			$sql = $wpdb->prepare( "INSERT INTO ". $wpdb->prefix ."acpc_html (id, content) VALUES (%d,%s)",$this->acpc_getPopupId(),$alpHtmlPopup);	
			$res = $wpdb->query($sql);
		}
		return $res;
	}
	
	protected function acpc_setCustomOptions($id) {
		global $wpdb;
		$st = $wpdb->prepare("SELECT * FROM ". $wpdb->prefix ."acpc_html WHERE id = %d",$id);
		$arr = $wpdb->get_row($st,ARRAY_A);
		$this->acpc_setContent($arr['content']);
	}

	protected function acpc_getExtraRenderOptions() {
		$content = trim($this->acpc_getContent());
		$popupId = (int)$this->acpc_getPopupId();
		$this->acpc_AddPopupContentToFooter($content, $popupId);
		return array('html'=>$this->acpc_getContent());
	}

	public  function acpc_render() {
		return parent::acpc_render();
	}
}