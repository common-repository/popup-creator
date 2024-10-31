<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect-subscriber.php
*  =================================== */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once (dirname(__FILE__).'/alphaconnect-database.php');
class alphaconnect_subscriber extends ALPHACONNECTPOPUPCREATOR {

public $content;
public $title;
public $subscriberform;

public function acpc_setContent($content) {
	$this->content = $content;
}

public function acpc_getContent()
{
	return $this->content;
}

public function acpc_setSubscriberForm($options)
{
	$this->subscriberform = $options;
}

public function acpc_getSubscriberForm()
{
	return $this->subscriberform;
}

public static function create($data, $obj = null)
{
	$obj = new self();
	$options = json_decode($data['options'], true);
	$subscriberform = $options['subscriberform'];

	$obj->acpc_setSubscriberForm($subscriberform);
	$obj->acpc_setContent($data['contact']);

	return parent::create($data, $obj);
}

public function save($data = array())
{

	$editMode = $this->acpc_getPopupId()?true:false;

	$res = parent::save($data);
	if ($res===false) return false;

	$alpSubscriberForm = $this->acpc_getPopupTitle();
	$subscriberform = $this->acpc_getSubscriberForm();

	global $wpdb;
	if ($editMode) {
		$alpSubscriberForm = stripslashes($alpSubscriberForm);
		$sql = $wpdb->prepare("UPDATE ".$wpdb->prefix."acpc_subscriber SET title=%s, options=%s WHERE id=%d",$alpSubscriberForm, $subscriberform, $this->acpc_getPopupId());
		$res = $wpdb->query($sql);
	}
	else {

		$sql = $wpdb->prepare("INSERT INTO ".$wpdb->prefix."acpc_subscriber (id, title, options) VALUES (%d, %s, %s)",$this->acpc_getPopupId(),$alpSubscriberForm, $subscriberform);
		$res = $wpdb->query($sql);
	}
	return $res;
	
}

protected function acpc_setCustomOptions($id)
{
	global $wpdb;
	$st = $wpdb->prepare("SELECT title, options FROM ".$wpdb->prefix."acpc_subscriber WHERE id = %d", $id);
	$arr = $wpdb->get_row($st,ARRAY_A);
	$this->acpc_setContent($arr['title']);
	$this->acpc_setSubscriberForm($arr['options']);
}

protected function acpc_getExtraRenderOptions()
{
	$options = json_decode($this->acpc_getSubscriberForm(), true);

	$subscriberemail   			= $options['subscriberemail'];	
	$placeholderfiled  			= $options['placeholderfiled'];	
	$bordersize        			= $options['bordersize'];	
	$bordertype  	   			= $options['bordertype'];	
	$bordercolor 	   			= $options['bordercolor'];	
	$requiredFiled	   			= $options['requiredFiled'];	
	$backgroundfiled   			= $options['backgroundfiled'];	
	$fontsizefiled     			= $options['fontsizefiled'];	
	$fontcolor 		   			= $options['fontcolor'];	
	$fontalignment     			= $options['fontalignment'];	

	$alpsubscribersubmitbutton = $options['subscribersubmitbutton']; 
	$alpbuttonhight            = $options['buttonhight'];
    $alpbuttonwidth            = $options['buttonwidth'];  
    $alpbuttonlable            = $options['buttonlable'];
    $alpbuttonbordersize       = $options['buttonbordersize'];
    $alpbuttonbordertype       = $options['buttonbordertype'];
    $alpbuttonbordercolor      = $options['buttonbordercolor'];
    $alpbuttonbackground       = $options['buttonbackground'];
    $alpbuttonfontsize         = $options['buttonfontsize'];
    $alpbuttonfontcolor        = $options['buttonfontcolor'];

	$subscribermessage = $options['subscribermessage'];			
	$myprefix_image_id = $options['myprefix_image_id'];			

	$content = $this->acpc_getContent();

    $image = wp_get_attachment_image_url( $myprefix_image_id, 'thumbnail', false, array( 'id' => 'myprefix-preview-image' ) );


	$content = ' <div class="lib-panel">
					<div class="box-shadow">
					<input type="hidden" name="action" value="subscriper_form">
					<input type="hidden" name="aphaNonce" value="'.$ajax_Nonce.'">
                        <div class="col-md-6">
                            <img class="lib-img-show" src="'. esc_url($image).'" >
                        </div>
                        <div class="col-md-6">
                            <div class="lib-row lib-header">
							Subscriber Form
							<div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
							 '. esc_attr($subscribermessage) .'
							 <br><br>
							 <div class="form-group row">
								<div class="col-sm-12">
									<input type="email" name="subscriberForm" class="form-control form-control-sm" style="background-color:'.esc_attr($backgroundfiled).'; color:'.esc_attr($fontcolor).'; padding:15px;  text-align:'.esc_attr($fontalignment).';  font-size:'.esc_attr($fontsizefiled).'; border-style:'.esc_attr($bordertype).'; border-width: '.esc_attr($bordersize).'; border-color:'.esc_attr($bordercolor).';" '.esc_attr($requiredFiled).' placeholder="'.esc_attr($placeholderfiled).'"  id="SubscriberForm" value=""/>
								</div>
							  </div>  
								<div class="form-group">
									<div class="col-sm-12">
										<input type="submit" id="submitedSubscriberForm" class="btn btn-success" value="Submit"/>
									</div>
								</div>
                            </div>
                        </div>
				  </div>
				</div>';

	$alpurl = ALPHACONNECT_POPUP_MAIL;				 
	return array('html'=>"<form method='post' id='MyForm' action='$alpurl'>$content</form>");
}
	public function acpc_render(){
		return parent::acpc_render();
	}
}