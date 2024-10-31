<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect-database.php
*  =================================== */


 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class ALPHACONNECTPOPUPCREATOR {

	protected $id;
	protected $type;
	protected $title;
	protected $width;
	protected $height;
	protected $delay;
	protected $options;
	public static $registeredScripts = false;

	public function acpc_setPopupType($type){
		$this->type = $type;
	}
	public function acpc_getPopupType() {
		return $this->type;
	}
	public function acpc_setPopupTitle($title){
		$this->title = $title;
	}
	public function acpc_getPopupTitle() {
		return $this->title;
	}
	public function acpc_setPopupId($id){
		$this->id = $id;
	}
	public function acpc_getPopupId() {
		return $this->id;
	}
	public function acpc_setPopupWidth($width){
		$this->width = $width;
	}
	public function acpc_getPopupWidth() {
		return $this->width;
	}
	public function acpc_setPopupHeight($height){
		$this->height = $height;
	}
	public function acpc_getPopupHeight() {
		return $this->height;
	}
	public function acpc_setPopupDelay($delay){
		$this->delay = $delay;
	}
	public function acpc_getPopupDelay() {
		return $this->delay;
	}
	public function acpc_setPopupOptions($options) {
		$this->options = $options;
	}
	public function acpc_getPopupOptions() {
		return $this->options;
	}
	public static function acpc_findById($id) {

		global $wpdb;
		$st = $wpdb->prepare("SELECT * FROM ". $wpdb->prefix ."acpc_popup WHERE id = %d",$id);
		$arr = $wpdb->get_row($st,ARRAY_A);
		if(!$arr) return false;
		return self::acpc_objectfromarray($arr);

	}

	abstract protected function acpc_setCustomOptions($id);

	abstract protected function acpc_getExtraRenderOptions();

	private static function acpc_objectfromarray($arr, $obj = null) {

		$jsonData = json_decode($arr['options'], true);

		$type = alpSafeStr($arr['type']);

		if ($obj===null) {
			$className = "alphaconnect_".lcfirst(strtolower($type));
			require_once (dirname(__FILE__).'/'.$className.'.php');
			$obj = new $className();
		}

		$obj->acpc_setPopupType(alpSafeStr($type));
		$obj->acpc_setPopupTitle(alpSafeStr($arr['title']));
		if (@$arr['id']) $obj->acpc_setPopupId($arr['id']);
		$obj->acpc_setPopupWidth(alpSafeStr(@$jsonData['width']));
		$obj->acpc_setPopupHeight(alpSafeStr(@$jsonData['height']));
		$obj->acpc_setPopupDelay(alpSafeStr(@$jsonData['delay']));
		$obj->acpc_setPopupOptions(alpSafeStr($arr['options']));

		if (@$arr['id']) $obj->acpc_setCustomOptions($arr['id']);

		return $obj;
	}

	public static function create($data, $obj)
	{
		self::acpc_objectfromarray($data, $obj);
		return $obj->save();
	}
	public function save($data = array()) {

		$id = $this->acpc_getPopupId();
		$type = $this->acpc_getPopupType();
		$title = $this->acpc_getPopupTitle();
		$options = $this->acpc_getPopupOptions();

		global $wpdb;

		if($id  == '') {
				$sql = $wpdb->prepare( "INSERT INTO ". $wpdb->prefix ."acpc_popup(type,title,options) VALUES (%s,%s,%s)",$type,$title,$options);
				$res = $wpdb->query($sql);


			if ($res) {
				$id = $wpdb->insert_id;
				$this->acpc_setPopupId($id);
			}
			return $res;

		}
		else {
			$sql = $wpdb->prepare("UPDATE ". $wpdb->prefix ."acpc_popup SET type=%s,title=%s,options=%s WHERE id=%d",$type,$title,$options,$id);
			$res = $wpdb->query($sql);
			if(!$wpdb->show_errors()) {
				$res = 1;
			}

			return $res;
		}
	}
	public static function findAll($orderBy = null, $limit = null, $offset = null) {

		global $wpdb;

		$query = "SELECT * FROM ". $wpdb->prefix ."acpc_popup";

		if ($orderBy) {
			$query .= " ORDER BY ".$orderBy;
		}

		if ($limit) {
			$query .= " LIMIT ".intval($offset).','.intval($limit);
		}

		$popups = $wpdb->get_results($query, ARRAY_A);

		$arr = array();
		foreach ($popups as $popup) {
			$arr[] = self::acpc_objectfromarray($popup);
		}

		return $arr;
	}

	public static function delete($id) {
			$pop = self::acpc_findById($id);
			$type =  $pop->acpc_getPopupType();
			$table = 'acpc_'.$type;
			
			global $wpdb;
			$wpdb->query(
				$wpdb->prepare(
					"DELETE FROM ". $wpdb->prefix ."$table WHERE id = %d"
					,$id
				)
			);
			$wpdb->query(
				$wpdb->prepare(
					"DELETE FROM ". $wpdb->prefix ."acpc_popup WHERE id = %d"
					,$id
				)
			);

			$wpdb->query(
				$wpdb->prepare(
					"DELETE FROM ". $wpdb->prefix ."postmeta WHERE meta_value = %d and meta_key = 'wp_acpc_popup'"
					,$id
				)
			);
	}
	public static function deletedata($id) {
		$pop = self::acpc_findById($id);
		$table = 'acpc_contactdetails';
		global $wpdb;
		$wpdb->query(
			$wpdb->prepare(
				"DELETE FROM ". $wpdb->prefix ."$table WHERE id = %d"
				,$id
			)
		);
	}

	public static function deletedatasub($id) {
		$pop = self::acpc_findById($id);
		$table = 'acpc_subscriberdetails';
		global $wpdb;
		$wpdb->query(
			$wpdb->prepare(
				"DELETE FROM ". $wpdb->prefix ."$table WHERE id = %d"
				,$id
			)
		);
	}

	public static function setPopupForPost($post_id, $popupId) {
		update_post_meta($post_id, 'wp_acpc_popup' , $popupId);
	}

	public function acpc_getRemoveOptions() {
		return array();
	}

	private function acpc_addPopupStyles() {
		$styles = '';
		$popupId = $this->acpc_getPopupId();
		$options = $this->acpc_getPopupOptions();
		$options = json_decode($options, true);
		$contentPadding = 0;
		if(empty($options)) {
			return '';
		}

		if(!empty($options['popup-content-padding'])) {
			$contentPadding = $options['popup-content-padding'];
		}

		$styles .= '<style>';

		$styles .= '.alp-popup-overlay-'.$popupId.',.alp-popup-content-'.$popupId.',
				   #alp-popup-content-wrapper-'.$popupId.'
				     {
			             padding: '.$contentPadding.'px !important;
					  }
					  </style>';
		echo $styles;
	}

	public function acpc_render() {
		$popupId = $this->acpc_getPopupId();
		$this->acpc_addPopupStyles();
		$parentOption = array('id'=>$this->acpc_getPopupId(),'title'=>$this->acpc_getPopupTitle(),'type'=>$this->acpc_getPopupType(),'width',$this->acpc_getPopupWidth(),'height'=>$this->acpc_getPopupHeight(),'delay'=>$this->acpc_getPopupDelay());
		$getexrArray = $this->acpc_getExtraRenderOptions();
		$options = json_decode($this->acpc_getPopupOptions(),true);
		if(empty($options)) $options = array();
		$alpPopupVars = 'ALPHACONNECT_POPUP_DATA['.$this->acpc_getPopupId().'] ='.json_encode(array_merge($parentOption, $options, $getexrArray)).';';

		return $alpPopupVars;
	}
	public static function acpc_getTotalRowCount() {
		global $wpdb;
		$res =  $wpdb->get_var( "SELECT COUNT(id) FROM ". $wpdb->prefix ."acpc_popup" );
		return $res;
	}
	public static function acpc_getPagePopupId($page,$popup) {
		global $wpdb;
		$sql = $wpdb->prepare("SELECT meta_value FROM ". $wpdb->prefix ."postmeta WHERE post_id = %d AND meta_key = %s",$page,$popup);
		$row = $wpdb->get_row($sql);
		$id = 0;
		if($row) {
			$id =  (int)@$row->meta_value;
		}
		return $id;
	}

	public function acpc_AddPopupContentToFooter($content, $popupId) {

		add_action('wp_footer', function() use ($content, $popupId){
			$content = apply_filters('acpc_content', $content, $popupId);
			if(empty($content)) {
				$content = '';
			}
			$popupContent = "<div style=\"display:none\"><div id=\"alp-popup-content-wrapper-$popupId\">$content</div></div>";
			echo $popupContent;
		}, 1);
	}

}

function alpSafeStr ($param) {
	return ($param===null?'':$param);
}