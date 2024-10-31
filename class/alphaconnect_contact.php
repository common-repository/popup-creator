<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect_contact.php
*  =================================== */


 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once (dirname(__FILE__).'/alphaconnect-database.php');

class alphaconnect_contact extends ALPHACONNECTPOPUPCREATOR {
	
		public $content;
		public $title;
		public $contactForm;

		public function acpc_setContent($content)
		{
			$this->content = $content;
		}

		public function acpc_getContent()
		{
			return $this->content;
		}

		public function acpc_setContactForm($options)
		{
			$this->contactForm = $options;
		}
	
		public function acpc_getContactForm()
		{
			return $this->contactForm;
		}
	
		public static function create($data, $obj = null)
		{
			$obj = new self();
			$options = json_decode($data['options'], true);
			$contactForm = $options['contactForm'];
	
			$obj->acpc_setContactForm($contactForm);
			$obj->acpc_setContent($data['contact']);
	
			return parent::create($data, $obj);
		}
	
		public function save($data = array())
		{
	
			$editMode = $this->acpc_getPopupId()?true:false;
	
			$res = parent::save($data);
			if ($res===false) return false;
	
			$alpContactForm = $this->acpc_getPopupTitle();
			$contactForm = $this->acpc_getContactForm();
	
			global $wpdb;
			if ($editMode) {
				$alpContactForm = stripslashes($alpContactForm);
				$sql = $wpdb->prepare("UPDATE ".$wpdb->prefix."acpc_contact SET title=%s, options=%s WHERE id=%d",$alpContactForm, $contactForm, $this->acpc_getPopupId());
				$res = $wpdb->query($sql);
			}
			else {
	
				$sql = $wpdb->prepare("INSERT INTO ".$wpdb->prefix."acpc_contact (id, title, options) VALUES (%d, %s, %s)",$this->acpc_getPopupId(),$alpContactForm, $contactForm);
				$res = $wpdb->query($sql);
			}
			return $res;
			
		}
	
		protected function acpc_setCustomOptions($id){
			global $wpdb;
			$st = $wpdb->prepare("SELECT title, options FROM ".$wpdb->prefix."acpc_contact WHERE id = %d", $id);
			$arr = $wpdb->get_row($st,ARRAY_A);
			$this->acpc_setContent($arr['title']);
			$this->acpc_setContactForm($arr['options']);
		}
		
		protected function acpc_getExtraRenderOptions(){
			$options = json_decode($this->acpc_getContactForm(), true);	
			$alpFirstName	 		 = $options['FirstName'];	
			$alpfirstnameLable       = $options['firstnameLable'];
			$alpfirstnamePlaceholder = $options['firstnamePlaceholder'];
			$alpfirstnameBorder      = $options['firstnameBorder'];
			$alpfirstnameBorderType  = $options['firstnameBorderType'];
			$alpfirstnameBorderColor = $options['firstnameBorderColor'];
			$alpfirstnameRequired    = $options['firstnameRequired'];
			$alpfirstnameBgcolour    = $options['firstnameBgcolour'];
			$alpfirstnameFontSize    = $options['firstnameFontSize'];
			$alpfirstnameFontColor   = $options['firstnameFontColor'];
			$alpfirstnameAlignment   = $options['firstnameAlignment'];

		
			$alpLastName	 		= $options['LastName'];	
			$alplastnameLable       = $options['lastnameLable'];
			$alplastnamePlaceholder = $options['lastnamePlaceholder'];
			$alplastnameBorder      = $options['lastnameBorder'];
			$alplastnameBorderType  = $options['lastnameBorderType'];
			$alplastnameBorderColor = $options['lastnameBorderColor'];
			$alplastnameRequired    = $options['lastnameRequired'];
			$alplastnameBgcolour    = $options['lastnameBgcolour'];
			$alplastnameFontSize    = $options['lastnameFontSize'];
			$alplastnameFontColor   = $options['lastnameFontColor'];
			$alplastnameAlignment   = $options['lastnameAlignment'];

			$alpMobile	 		   = $options['Mobile'];	
			$alpmobileLable        = $options['mobileLable'];
			$alpmobilePlaceholder  = $options['mobilePlaceholder'];
			$alpmobileBorder       = $options['mobileBorder'];
			$alpmobileBorderType   = $options['mobileBorderType'];
			$alpmobileBorderColor  = $options['mobileBorderColor'];
			$alpmobileRequired     = $options['mobileRequired'];
			$alpmobileBgcolour     = $options['mobileBgcolour'];
			$alpmobileFontSize     = $options['mobileFontSize'];
			$alpmobileFontColor    = $options['mobileFontColor'];
			$alpmobileAlignment    = $options['mobileAlignment'];
			
			$alpEmail	 		  = $options['Email'];	
			$alpemailLable        = $options['emailLable'];
			$alpemailPlaceholder  = $options['emailPlaceholder'];
			$alpemailBorder       = $options['emailBorder'];
			$alpemailBorderType   = $options['emailBorderType'];
			$alpemailBorderColor  = $options['emailBorderColor'];
			$alpemailRequired     = $options['emailRequired'];
			$alpemailBgcolour     = $options['emailBgcolour'];
			$alpemailFontSize     = $options['emailFontSize'];
			$alpemailFontColor    = $options['emailFontColor'];
			$alpemailAlignment    = $options['emailAlignment'];

			$alpSubject	 		   = $options['Subject'];	
			$alpsubjectLable       = $options['subjectLable'];
			$alpsubjectPlaceholder = $options['subjectPlaceholder'];
			$alpsubjectBorder      = $options['subjectBorder'];
			$alpsubjectBorderType  = $options['subjectBorderType'];
			$alpsubjectBorderColor = $options['subjectBorderColor'];
			$alpsubjectRequired    = $options['subjectRequired'];
			$alpsubjectBgcolour    = $options['subjectBgcolour'];
			$alpsubjectFontSize    = $options['subjectFontSize'];
			$alpsubjectFontColor   = $options['subjectFontColor'];
			$alpsubjectAlignment   = $options['subjectAlignment'];

			$alpMessage	 		   = $options['Message'];	
			$alpmessageLable       = $options['messageLable'];
			$alpmessagePlaceholder = $options['messagePlaceholder'];
			$alpmessageBorder      = $options['messageBorder'];
			$alpmessageBorderType  = $options['messageBorderType'];
			$alpmessageBorderColor = $options['messageBorderColor'];
			$alpmessageRequired    = $options['messageRequired'];
			$alpmessageBgcolour    = $options['messageBgcolour'];
			$alpmessageFontSize    = $options['messageFontSize'];
			$alpmessageFontColor   = $options['messageFontColor'];
			$alpmessageAlignment   = $options['messageAlignment'];

			$alpAddress	 		   = $options['Address'];	
			$alpaddressLable       = $options['addressLable'];
			$alpaddressPlaceholder = $options['addressPlaceholder'];
			$alpaddressBorder      = $options['addressBorder'];
			$alpaddressBorderType  = $options['addressBorderType'];
			$alpaddressBorderColor = $options['addressBorderColor'];
			$alpaddressRequired    = $options['addressRequired'];
			$alpaddressBgcolour    = $options['addressBgcolour'];
			$alpaddressFontSize    = $options['addressFontSize'];
			$alpaddressFontColor   = $options['addressFontColor'];
			$alpaddressAlignment   = $options['addressAlignment'];
		
			$content = $this->acpc_getContent();

			$content = '<center><h2 class="html-popup-headline">Contact Form</h2></center>
			
			<input type="hidden" name="action" value="process_form">
			<input type="hidden" name="aphaNonce" value="'.$ajax_Nonce.'">';
			if($alpFirstName == "on"){							
			$content.='<div class="form-group">
							<label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">'.esc_attr($alpfirstnameLable).'</label>
							<div class="col-sm-8">
								<input type="text" name="firstname" class="form-control form-control-sm" style="border: '.esc_attr($alpfirstnameBorder).' '.esc_attr($alpfirstnameBorderType).' '.esc_attr($alpfirstnameBorderColor).'; background-color:'.esc_attr($alpfirstnameBgcolour).'; font-size:'.esc_attr($alpfirstnameFontSize).'; color:'.esc_attr($alpfirstnameFontColor).'; text-align:'.esc_attr($alpfirstnameAlignment).';" '.esc_attr($alpfirstnameRequired).' placeholder="'.esc_attr($alpfirstnamePlaceholder).'">
							</div>
						  </div><br><br>';
			}
			if($alpLastName == "on"){							
			$content.='<div class="form-group ">
								<label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">'.esc_attr($alplastnameLable).'</label>
								<div class="col-sm-8">
									<input type="text" name="lastname" class="form-control form-control-sm" style="border: '.esc_attr($alplastnameBorder).' '.esc_attr($alplastnameBorderType).' '.esc_attr($alplastnameBorderColor).'; background-color:'.esc_attr($alplastnameBgcolour).'; font-size:'.esc_attr($alplastnameFontSize).'; color:'.esc_attr($alplastnameFontColor).'; text-align:'.esc_attr($alplastnameAlignment).';" '.esc_attr($alplastnameRequired).' placeholder="'.esc_attr($alplastnamePlaceholder).'">
								</div>
							  </div><br><br>';
			}
			if($alpMobile == "on"){							
			$content .='<div class="form-group ">
								<label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">'.esc_attr($alpmobileLable).'</label>
								<div class="col-sm-8">
									<input type="text" name="mobilenumber" class="form-control form-control-sm" style="border: '.esc_attr($alpmobileBorder).' '.esc_attr($alpmobileBorderType).' '.esc_attr($alpmobileBorderColor).'; background-color:'.esc_attr($alpmobileBgcolour).'; font-size:'.esc_attr($alpmobileFontSize).'; color:'.esc_attr($alpmobileFontColor) .'; text-align:'.esc_attr($alpmobileAlignment).';" '.esc_attr($alpmobileRequired).' placeholder="'.esc_attr($alpmobilePlaceholder).'">
								</div>
							  </div><br><br>';
			}
			if($alpEmail == "on"){							
			$content .='<div class="form-group ">
								<label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">'.esc_attr($alpemailLable).'</label>
								<div class="col-sm-8">
									<input type="email" name="e_mail" class="form-control form-control-sm" style="border: '.esc_attr($alpemailBorder).' '.esc_attr($alpemailBorderType).' '.esc_attr($alpemailBorderColor).'; background-color:'.esc_attr($alpemailBgcolour).'; font-size:'.esc_attr($alpemailFontSize).'; color:'.esc_attr($alpemailFontColor).'; text-align:'.esc_attr($alpemailAlignment).';" '.esc_attr($alpemailRequired).' placeholder="'.esc_attr($alpemailPlaceholder).'">
								</div>
							  </div><br><br>';
			}
			if($alpSubject == "on"){							
			$content.='<div class="form-group ">
								<label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">'.esc_attr($alpsubjectLable).'</label>
								<div class="col-sm-8">
									<input type="text" name="subject" class="form-control form-control-sm" style="border: '.esc_attr($alpsubjectBorder).' '.esc_attr($alpsubjectBorderType).' '.esc_attr($alpsubjectBorderColor).'; background-color:'.esc_attr($alpsubjectBgcolour).'; font-size:'.esc_attr($alpsubjectFontSize) .'; color:'.esc_attr($alpsubjectFontColor).'; text-align:'.esc_attr($alpsubjectAlignment).';" '.esc_attr($alpsubjectRequired).' placeholder="'.esc_attr($alpsubjectPlaceholder).'">
								</div>
							  </div><br><br>';
			}
			if($alpMessage == "on"){							
			$content.='<div class="form-group ">
								<label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">'.esc_attr($alpmessageLable).'</label>
								<div class="col-sm-8">
								<input type="text" name="message" class="form-control form-control-sm" style="border: '.esc_attr($alpmessageBorder).' '.esc_attr($alpmessageBorderType).' '.esc_attr($alpmessageBorderColor).'; background-color:'.esc_attr($alpmessageBgcolour).'; font-size:'.esc_attr($alpmessageFontSize).'; color:'.esc_attr($alpmessageFontColor).'; text-align:'.esc_attr($alpmessageAlignment).';" '.esc_attr($alpmessageRequired).' placeholder="'.esc_attr($alpmessagePlaceholder).'">
								</div>
							  </div><br><br>';
			}
			if($alpAddress == "on"){							
			$content.='<div class="form-group ">
								<label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">'.esc_attr($alpaddressLable).'</label>
								<div class="col-sm-8">
									<input type="text" name="address" class="form-control form-control-sm" style="border: '.esc_attr($alpaddressBorder).' '.esc_attr($alpaddressBorderType).' '.esc_attr($alpaddressBorderColor).'; background-color:'.esc_attr($alpaddressBgcolour).'; font-size:'.esc_attr($alpaddressFontSize).'; color:'.esc_attr($alpaddressFontColor).'; text-align:'.esc_attr($alpaddressAlignment).';" '.esc_attr($alpaddressRequired).' placeholder="'.esc_attr($alpaddressPlaceholder).'">
								</div>
							  </div><br><br>';
			}
			$content .= '<div class="form-group">
							<div class="col-sm-12">
								<button type="submit" id="submitedContactForm" name="submitedContactForm" class="btn btn-success" >Submit</button>
							</div>
						</div>';
			$alpurl =  ALPHACONNECT_POPUP_MAIL;				 
			return array('html'=>"<div class='alp-wp-editor-container'><div class='html-uploader-wrapper'><form method='post' id='MyForm' action='$alpurl'>
			$content</form></div></div>");
		}
		public function acpc_render()
		{
			return parent::acpc_render();
		}
	}