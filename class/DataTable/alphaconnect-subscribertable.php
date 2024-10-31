<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect-subscribertable.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once (dirname(__FILE__).'/alphaconnect-table.php');

 	/***************************
     * Subscriber Details Table
     ***************************/
class ALPHACONNECTSUBSCRIBER extends ALPHACONNECTTABLE
{
	public function __construct()
	{
		global $wpdb;
		parent::__construct('');

		$this->acpcsetRowsPerPage(ALPHACONNECT_POPUP_TABLE_LIMIT);
		$this->acpcsetTablename($wpdb->prefix.'acpc_subscriberdetails');
		$this->acpcsetColumns(array(
			'id',			
			'Email',	
		));
		$this->acpcsetDisplayColumns(array(
			'id' 		=> 'ID',
			'Email' 	=> 'E-Mail',
			'option' 	=> 'Option'
		));
		$this->acpcsetSortableColumns(array(
			'id' => array('id', false),
			'mobile' => array('mobile', true),
			$this->setInitialSort(array(
			   'id' => 'DESC'			
	       ))
		));
	}
 
	public function acpccustomizeRow(&$row)
	{
		$id = $row[0];
		$ajax_Nonce = wp_create_nonce("alpSubscribersDetaileRemove");
		$row[2] = '<span><a href="#" alp-popup-data-id="'.$id.'" data-ajax_Nonce="'.$ajax_Nonce.'" class="alprowdeletelink Delete_Color">'.__('Delete', 'alppc').'&nbsp;<i class="dashicons dashicons-trash" aria-hidden="true"></i></a>';
	}
 }