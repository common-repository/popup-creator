<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect-contacttable.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once (dirname(__FILE__) . '/alphaconnect-table.php');

    /***************************
     * Contact Details Table
     ***************************/
    
class ALPHACONNECTCONTACT extends ALPHACONNECTTABLE
{
    public function __construct()
    {
        global $wpdb;
        parent::__construct('');
        
        $this->acpcsetRowsPerPage(ALPHACONNECT_POPUP_TABLE_LIMIT);
        $this->acpcsetTablename($wpdb->prefix . 'acpc_contactdetails');
        $this->acpcsetColumns(array(
            'id',
            'firstname',
            'lastname',
            'mobile',
            'e_mail',
            'subject',
            'message',
            'address'
            
        ));
        $this->acpcsetDisplayColumns(array(
            'id' => 'ID',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'mobile' => 'Mobile',
            'e_mail' => 'E-Mail',
            'subject' => 'Subject',
            'message' => 'Message',
            'address' => 'Address',
            'option' => 'Option'
        ));
        $this->acpcsetSortableColumns(array(
            'id' => array(
                'id',
                false
            ),
            'mobile' => array(
                'mobile',
                true
            ),
            $this->setInitialSort(array(
                'id' => 'DESC'
            ))
        ));
    }
    
    public function acpccustomizeRow(&$row)
    {
        $id         = $row[0];
        $isActivePopupCreator = AlpConPopupGetData::acpc_isActivePopupCreator($id);
        $ajax_Nonce = wp_create_nonce("alpContactDetaileRemove");
        $row[8]     = '<span><a href="#" alp-popup-data-id="' . $id . '" data-ajax_Nonce="' . $ajax_Nonce . '" class="alp-row-delete-link Delete_Color">' . __('Delete', 'alppc') . '&nbsp;<i class="dashicons dashicons-trash" aria-hidden="true"></i></a>';
    }
}