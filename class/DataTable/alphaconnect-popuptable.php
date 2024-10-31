<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect-popuptable.php
*  =================================== */


 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once (dirname(__FILE__).'/alphaconnect-table.php');

 	/***************************
     * Popup Table
     ***************************/

class ALPHACONNECTMAINTABLE extends ALPHACONNECTTABLE
{
	public function __construct()
	{
		global $wpdb;
		parent::__construct('');
		$this->acpcsetRowsPerPage(ALPHACONNECT_POPUP_TABLE_LIMIT);
		$this->acpcsetTablename($wpdb->prefix.'acpc_popup');
		$this->acpcsetColumns(array(
			'id',			
			'title',
			'type'		
		));
		$this->acpcsetDisplayColumns(array(
			'id' 		=> 'ID',
			'title' 	=> 'Title',
			'type' 		=> 'Type',
			'shortcode' => 'Shortcode',
			'options' 	=> 'Options'
		));
		$this->acpcsetSortableColumns(array(
			'id' 		=> array('id', false),
			'title' 	=> array('title', true),
			$this->setInitialSort(array(
	           'id' 	=> 'DESC'
	       ))
		));
	}

	public function acpccustomizeRow(&$row)
	{
		$id = $row[0];
		$ajax_Nonce = wp_create_nonce("AlpConPopupCreatoreDeactivateNonce");
		$isActivePopupCreator = AlpConPopupGetData::acpc_isActivePopupCreator($id);
        $type = $row[2];
       	$editUrl = admin_url()."admin.php?page=popup_edit&id=".$id."&type=".$type."";
		$row[3] = "<input type='text' onfocus='this.select();' readonly value='[popup_creator id=".$id."]' class='form-control col-md-7 offset-md-2'>";		
		$ajax_Nonce = wp_create_nonce("AlpConPopupCreatorDeleteNonce");
		$row[4] = '<span><a href="'.@$editUrl.'" class="Edit_Color">'.__('Edit', 'alppc').'&nbsp;<i class="dashicons dashicons-edit"></i></a>&nbsp;&nbsp;<a href="#" data-alp-popup-id="'.$id.'" data-ajax_Nonce="'.$ajax_Nonce.'" class="alp-js-delete-link Delete_Color">'.__('Delete', 'alppc').'&nbsp;<i class="dashicons dashicons-trash" aria-hidden="true"></i></a>';
	}
 }