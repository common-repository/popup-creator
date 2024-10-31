<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-savefile.php
*  =================================== */
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

		/* ==================
		 	Popup Data Save
		 =================== */

add_action('admin_post_popup_save', 'acpc_PopupSave');

function alpSanitize($optionsKey, $isTextField = false)
{
	if (isset($_POST[$optionsKey])) {
		if ($optionsKey == "alp_popup_html"||
			$optionsKey == "alp_contactForm" ||
			$optionsKey == "alp_popup_subscriberform" ||
			$optionsKey == "all-selected-page" ||
			$optionsKey == "all-selected-posts" ||
			$isTextField == true )
			{			
			return wp_kses_post($_POST[$optionsKey]);
		}
		return sanitize_text_field($_POST[$optionsKey]);
	}
	else {
		return "";
	}
}

function acpc_PopupSave()
{
	global $wpdb;

	if(isset($_POST)) {
		current_user_can('alpPopupCreatorSave');
	}
	$_POST = stripslashes_deep($_POST);
	$postData = $_POST;
	$contactForm = array();
	$subscriberform = array();
	$options = array();
	$OptionsPages = alpSanitize('OptionsPages');
	$SelectePages = alpSanitize('SelectePages');
	$OptionsPosts = alpSanitize('OptionsPosts');
	$SelectePosts = alpSanitize('SelectePosts');

	$contactdetails = array();

	$SelectedPages = null;
	$AllPages = null;
	$SelectedPost = null;
	$AllPost = null;
	$allSelectedCategories = alpSanitize("posts-all-categories", true);

	 if($OptionsPages == 'all' && $SelectePages == 'on') {
		$AllPages = explode(",", alpSanitize('ShowAllPageID'));
	}
	if($OptionsPages == 'selected' && $SelectePages == 'on') {
		$SelectedPages =  explode(",",alpSanitize('ShowCustomPageID'));
	 }
   
	if($OptionsPosts == 'all' && $SelectePosts == 'on' ) {
		$AllPost = explode(",", alpSanitize('ShowAllPostID'));
	}
	if($OptionsPosts == 'selected' && $SelectePosts == 'on' ) {
		$SelectedPost =  explode(",",alpSanitize('ShowCustomPostID'));
	}


						/******************
						  	CONTACT FORM
						*******************/
	$contactForm = array( 					
		'FirstName' 					=> alpSanitize('FirstName'),
		'firstnameLable' 				=> alpSanitize('firstnameLable'),
		'firstnamePlaceholder' 			=> alpSanitize('firstnamePlaceholder'),
		'firstnameBorder' 				=> alpSanitize('firstnameBorder'),
		'firstnameBorderType' 			=> alpSanitize('firstnameBorderType'),
		'firstnameBorderColor' 			=> alpSanitize('firstnameBorderColor'),
		'firstnameRequired'				=> alpSanitize('firstnameRequired'),
		'firstnameBgcolour' 			=> alpSanitize('firstnameBgcolour'),
		'firstnameFontSize' 			=> alpSanitize('firstnameFontSize'),
		'firstnameFontColor' 			=> alpSanitize('firstnameFontColor'),
		'firstnameAlignment' 			=> alpSanitize('firstnameAlignment'),

		'LastName' 						=> alpSanitize('LastName'),
		'lastnameLable' 				=> alpSanitize('lastnameLable'),
		'lastnamePlaceholder' 			=> alpSanitize('lastnamePlaceholder'),
		'lastnameBorder' 				=> alpSanitize('lastnameBorder'),
		'lastnameBorderType' 			=> alpSanitize('lastnameBorderType'),
		'lastnameBorderColor' 			=> alpSanitize('lastnameBorderColor'),
		'lastnameRequired'				=> alpSanitize('lastnameRequired'),
		'lastnameBgcolour' 				=> alpSanitize('lastnameBgcolour'),
		'lastnameFontSize' 				=> alpSanitize('lastnameFontSize'),
		'lastnameFontColor' 			=> alpSanitize('lastnameFontColor'),
		'lastnameAlignment' 			=> alpSanitize('lastnameAlignment'),

		'Mobile' 						=> alpSanitize('Mobile'),
		'mobileLable' 					=> alpSanitize('mobileLable'),
		'mobilePlaceholder' 			=> alpSanitize('mobilePlaceholder'),
		'mobileBorder' 					=> alpSanitize('mobileBorder'),
		'mobileBorderType' 				=> alpSanitize('mobileBorderType'),
		'mobileBorderColor' 			=> alpSanitize('mobileBorderColor'),
		'mobileRequired'				=> alpSanitize('mobileRequired'),
		'mobileBgcolour' 				=> alpSanitize('mobileBgcolour'),
		'mobileFontSize' 				=> alpSanitize('mobileFontSize'),
		'mobileFontColor' 				=> alpSanitize('mobileFontColor'),
		'mobileAlignment' 				=> alpSanitize('mobileAlignment'),

		'Email' 						=> alpSanitize('Email'),
		'emailLable' 					=> alpSanitize('emailLable'),
		'emailPlaceholder' 				=> alpSanitize('emailPlaceholder'),
		'emailBorder' 					=> alpSanitize('emailBorder'),
		'emailBorderType' 				=> alpSanitize('emailBorderType'),
		'emailBorderColor' 				=> alpSanitize('emailBorderColor'),
		'emailRequired'					=> alpSanitize('emailRequired'),
		'emailBgcolour' 				=> alpSanitize('emailBgcolour'),
		'emailFontSize' 				=> alpSanitize('emailFontSize'),
		'emailFontColor' 				=> alpSanitize('emailFontColor'),
		'emailAlignment' 				=> alpSanitize('emailAlignment'),
	
		'Subject' 						=> alpSanitize('Subject'),
		'subjectLable' 					=> alpSanitize('subjectLable'),
		'subjectPlaceholder' 			=> alpSanitize('subjectPlaceholder'),
		'subjectBorder' 				=> alpSanitize('subjectBorder'),
		'subjectBorderType' 			=> alpSanitize('subjectBorderType'),
		'subjectBorderColor' 			=> alpSanitize('subjectBorderColor'),
		'subjectRequired'				=> alpSanitize('subjectRequired'),
		'subjectBgcolour' 				=> alpSanitize('subjectBgcolour'),
		'subjectFontSize' 				=> alpSanitize('subjectFontSize'),
		'subjectFontColor' 				=> alpSanitize('subjectFontColor'),
		'subjectAlignment' 				=> alpSanitize('subjectAlignment'),

		'Message' 						=> alpSanitize('Message'),
		'messageLable' 					=> alpSanitize('messageLable'),
		'messagePlaceholder' 			=> alpSanitize('messagePlaceholder'),
		'messageBorder' 				=> alpSanitize('messageBorder'),
		'messageBorderType' 			=> alpSanitize('messageBorderType'),
		'messageBorderColor' 			=> alpSanitize('messageBorderColor'),
		'messageRequired'				=> alpSanitize('messageRequired'),
		'messageBgcolour' 				=> alpSanitize('messageBgcolour'),
		'messageFontSize' 				=> alpSanitize('messageFontSize'),
		'messageFontColor' 				=> alpSanitize('messageFontColor'),
		'messageAlignment' 				=> alpSanitize('messageAlignment'),
		
		'Address' 						=> alpSanitize('Address'),
		'addressLable' 					=> alpSanitize('addressLable'),
		'addressPlaceholder' 			=> alpSanitize('addressPlaceholder'),
		'addressBorder' 				=> alpSanitize('addressBorder'),
		'addressBorderType' 			=> alpSanitize('addressBorderType'),
		'addressBorderColor' 			=> alpSanitize('addressBorderColor'),
		'addressRequired'				=> alpSanitize('addressRequired'),
		'addressBgcolour' 				=> alpSanitize('addressBgcolour'),
		'addressFontSize' 				=> alpSanitize('addressFontSize'),
		'addressFontColor' 				=> alpSanitize('addressFontColor'),
		'addressAlignment' 				=> alpSanitize('addressAlignment'),
	);

						/****************
						 SUBSCRIBER FORM
						*****************/
	$subscriberform = array( 					
		'subscriberemail' 				=> alpSanitize('subscriberemail'),
		'lablefiled' 					=> alpSanitize('lablefiled'),
		'placeholderfiled' 				=> alpSanitize('placeholderfiled'),
		'bordersize' 					=> alpSanitize('bordersize'),
		'bordertype' 					=> alpSanitize('bordertype'),
		'bordercolor' 					=> alpSanitize('bordercolor'),
		'requiredFiled' 				=> alpSanitize('requiredFiled'),
		'backgroundfiled' 				=> alpSanitize('backgroundfiled'),
		'fontsizefiled' 				=> alpSanitize('fontsizefiled'),
		'fontcolor' 					=> alpSanitize('fontcolor'),
		'fontalignment' 				=> alpSanitize('fontalignment'),
		'subscribersubmitbutton' 		=> alpSanitize('subscribersubmitbutton'),
		'buttonhight' 					=> alpSanitize('buttonhight'),
		'buttonwidth' 					=> alpSanitize('buttonwidth'),
		'buttonlable' 					=> alpSanitize('buttonlable'),
		'buttonbordersize' 				=> alpSanitize('buttonbordersize'),
		'buttonbordertype' 				=> alpSanitize('buttonbordertype'),
		'buttonbordercolor' 			=> alpSanitize('buttonbordercolor'),
		'buttonbackground' 				=> alpSanitize('buttonbackground'),
		'buttonfontsize' 				=> alpSanitize('buttonfontsize'),
		'buttonfontcolor' 				=> alpSanitize('buttonfontcolor'),

		'myprefix_image_id' 		    => alpSanitize('myprefix_image_id'),

		'subscribermessage' 			=> alpSanitize('subscribermessage'),
	);
						/******************
							FREE VIRSION
						*******************/
	$options = array(								
		'width' 						=> alpSanitize('width'),
		'height' 						=> alpSanitize('height'),
		'popup_dimension_mode' 			=> alpSanitize('popup_dimension_mode'),
		'popup_responsive_dimension_measure'=> alpSanitize('popup_responsive_dimension_measure'),
		'maxWidth' 						=> alpSanitize('maxWidth'),
		'maxHeight' 					=> alpSanitize('maxHeight'),
		'intervel'						=> alpSanitize('intervel'),
		'interveltime' 					=> alpSanitize('interveltime'),
		'intervelshowcount' 			=> alpSanitize('intervelshowcount'),
		'content-click-behavior' 		=> alpSanitize('content-click-behavior'),
		'click-redirect-to-url'			=> alpSanitize('click-redirect-to-url'),
		'redirect-to-new-tab' 			=> alpSanitize('redirect-to-new-tab'),
		'buttonDelayValue' 				=>alpSanitize('buttonDelayValue'),
		'isActiveStatus' 				=> alpSanitize('isActiveStatus'),
		'duration' 						=> (int)alpSanitize('duration'),
		'escKey' 						=> alpSanitize('escKey'),
		'isActivePopupStatus' 			=> alpSanitize('isActivePopupStatus'),
		'scrolling' 					=> alpSanitize('scrolling'),
		'disable-page-scrolling' 		=> alpSanitize('disable-page-scrolling'),
		'scaling' 						=> alpSanitize('scaling'),
		'reposition' 					=> alpSanitize('reposition'),
		'reopenAfterSubmission' 		=> alpSanitize('reopenAfterSubmission'),
		'popupFixed'  					=> alpSanitize('popupFixed'),
		'fixedPostion' 					=> alpSanitize('fixedPostion'),
		'overlayClose' 					=> alpSanitize('overlayClose'),
		'contentClick' 					=> alpSanitize('contentClick'),
		'opacity' 						=> alpSanitize('opacity'),
		'alpOverlayColor'				=> alpSanitize('alpOverlayColor'),
		'alp-content-background-color' 	=> alpSanitize('alp-content-background-color'),
		'closeButton'					=> alpSanitize('closeButton'),
		'theme' 						=> alpSanitize('theme'),
		'onScrolling' 					=> alpSanitize('onScrolling'),
		'repeatPopup' 					=> alpSanitize('repeatPopup'),
		'restrictionUrl' 				=> alpSanitize('restrictionUrl'),
		'repetitivePopup' 				=> alpSanitize('repetitivePopup'),
		'repetitivePopupPeriod' 		=> alpSanitize('repetitivePopupPeriod'),
		'SelectEventsPopup' 			=> alpSanitize('SelectEventsPopup'),

							/****************
							   PRO VIRSION
							*****************/
		'DateRange' 					=>alpSanitize('DateRange'),
		'DaterangeFromDate' 			=>alpSanitize('DaterangeFromDate'),
		'DaterangeToDate' 				=>alpSanitize('DaterangeToDate'),
		'SchedulePopUp' 				=>alpSanitize('SchedulePopUp'),
		'SchedulePopUpDate' 			=>alpSanitize('SchedulePopUpDate'),
		'MobileOnly' 					=>alpSanitize('MobileOnly'),
		'MobileDisable' 				=>alpSanitize('MobileDisable'),
		'Inactivity' 					=>alpSanitize('Inactivity'),
		'Inactivitytime' 				=>alpSanitize('Inactivitytime'),
		'WhileScrolling' 				=>alpSanitize('WhileScrolling'),
		'WhileScrollingtime' 			=>alpSanitize('WhileScrollingtime'),
		'SelectePages' 					=>alpSanitize('SelectePages'),
		'OptionsPages' 					=>alpSanitize('OptionsPages'),		
		'ShowAllPageID' 				=> $AllPages,
		'ShowCustomPageID' 				=> $SelectedPages,
		'SelectePosts' 					=> alpSanitize('SelectePosts'),
		'OptionsPosts' 					=> alpSanitize('OptionsPosts'),
		'ShowAllPostID' 				=> $AllPost,
		'ShowCustomPostID' 				=> $SelectedPost,
		'UserStatus' 					=> alpSanitize('UserStatus'),
		'loggedin-user' 				=> alpSanitize('loggedin-user'),
		'RandomPopUp' 					=> alpSanitize('RandomPopUp'),
		'AutoClosePopup' 				=> alpSanitize('AutoClosePopup'),
		'PopupClosingTimer' 			=> alpSanitize('PopupClosingTimer'),
		'DisablePopup' 					=> alpSanitize('DisablePopup'),
		'DisableOverlay' 				=> alpSanitize('DisableOverlay'),		
		'HideMobile' 					=> alpSanitize('HideMobile'),
		'contactForm' 					=> json_encode($contactForm),
		'subscriberform' 				=> json_encode($subscriberform),
		'contactdetails' 				=> json_encode($contactdetails)			
	);

	$html = 	  stripslashes(alpSanitize("alp_popup_html"));
	$contact = 	  stripslashes(alpSanitize("alp_contactForm"));
	$subscriber = stripslashes(alpSanitize("alp_popup_subscriberform"));
	$shortCode =  stripslashes(alpSanitize('shortcode'));
	$type = 	  alpSanitize('type');
	$title =      alpSanitize('title');
	$id =         alpSanitize('hidden_popup_number');
	$jsonDataArray = json_encode($options);

	$data = array(
		'id' => $id,
		'title' => $title,
		'type' => $type,	
		'html' => $html,		
		'shortcode' => $shortCode,
		'subscriber'=> $subscriber,
		'contact' => $contact,
		'options' => $jsonDataArray,
	);
	if (empty($title)) {
		wp_redirect(ALPHACONNECT_POPUP_ADMIN_URL."admin.php?page=popup_edit&type=$type&titleError=1");
		exit();
	}
	$popupName = "alphaconnect_".sanitize_text_field(lcfirst(strtolower($_POST['type'])));
	$popupClassName = $popupName;

	require_once (ALPHACONNECT_POPUP_CLASS ."/".$popupClassName.".php");

	if ($id == "") {
		global $wpdb;
		call_user_func(array($popupClassName, 'create'), $data);
		$lastId = $wpdb->get_var("SELECT LAST_INSERT_ID() FROM ".  $wpdb->prefix."acpc_popup");
		$postData['saveMod'] = '';
		$postData['popupId'] = $lastId;

		if(ALPHACONNECT_POPUP_PKG > ALPHACONNECT_POPUP_FREE) {
			ALPHACONNECTPOPUPCREATOR::removePopupFromPages($lastId,'page');
			ALPHACONNECTPOPUPCREATOR::removePopupFromPages($lastId,'categories');
			if($options['allPagesStatus']) {
				if(!empty($ShowAllPageID) && $ShowAllPageID != 'all') {
					setPopupForAllPages($lastId, $allSelectedPages, 'page');
				}
				else {
					updatePopupOptions($lastId, array('page'), true);
				}
			}
			
			if($options['allPostsStatus']) {
				if(!empty($showAllPosts) && $showAllPosts == "selected") {

					setPopupForAllPages($lastId, $allSelectedPosts, 'page');
				}
				else if($showAllPosts == "all") {
					updatePopupOptions($lastId, array('post'), true);
				}
				if($showAllPosts == "allCategories") {
					setPopupForAllPages($lastId, $allSelectedCategories, 'categories');
				}
			}

			if($options['allCustomPostsStatus']) {
				if(!empty($showAllCustomPosts) && $showAllCustomPosts == "selected") {
					setPopupForAllPages($lastId, $allSelectedCustomPosts, 'page');
				}
				else if($showAllCustomPosts == "all") {
					updatePopupOptions($lastId, $options['all-custom-posts'], true);
				}
			}
			
		}

		wp_redirect(ALPHACONNECT_POPUP_ADMIN_URL."admin.php?page=popup_edit&id=".$lastId."&type=$type&saved=1");
		exit();
	}
	else {
		$popup = ALPHACONNECTPOPUPCREATOR::acpc_findById($id);
		$popup->acpc_setPopupTitle($title);
		$popup->acpc_setPopupId($id);
		$popup->acpc_setPopupType($type);
		$popup->acpc_setPopupOptions($jsonDataArray);

		switch ($popupName) {
		
			case 'alphaconnect_html':
				$popup->acpc_setContent($html);
				break;
			case 'alphaconnect_contact':
				$popup->acpc_setContent($contact);
				$popup->acpc_setContactForm(json_encode($contactForm));
				break;	
			case 'alphaconnect_subscriber':
				$popup->acpc_setContent($subscriber);
				$popup->acpc_setSubscriberForm(json_encode($subscriberform));
				break;
		}
		$popup->save();
		wp_redirect(ALPHACONNECT_POPUP_ADMIN_URL."admin.php?page=popup_edit&id=$id&type=$type&saved=1");
		exit();
	}
	
}
		/* ==================
		 	Contact Form
		 =================== */

add_action( 'admin_post_nopriv_process_form', 'acpc_contactform' );
add_action( 'admin_post_process_form', 'acpc_contactform' );

function acpc_contactform() {

	global $wpdb;

		$firstname 	= false;
		$lastname 	= false;
		$mobile 	= false;
		$email 		= false;
		$subject 	= false;
		$message 	= false;
		$address 	= false;

		if(isset($_REQUEST['firstname'])){
			$sanitized_firstname = $_REQUEST['firstname'];
			$firstname = sanitize_text_field($sanitized_firstname);
		} 
		if(isset($_REQUEST['lastname'])){
			$sanitized_lastname = $_REQUEST['lastname'];
			$lastname = sanitize_text_field($sanitized_lastname);
		} 
		if(isset($_REQUEST['mobilenumber'])){
			$mobile = preg_replace('/[^0-9]/', '', $_REQUEST['mobilenumber']);
		} 
		if(isset($_REQUEST['e_mail'])){
			$sanitized_email = $_REQUEST['e_mail'];
			$email = sanitize_email($sanitized_email);
		} 
		if(isset($_REQUEST['subject'])){
			$sanitized_subject = $_REQUEST['subject'];
			$subject = sanitize_text_field($sanitized_subject);
		} 
		if(isset($_REQUEST['message'])){
			$sanitized_message = $_REQUEST['message'];
			$message = sanitize_text_field($sanitized_message);
		} 
		if(isset($_REQUEST['address'])){
			$sanitized_address = $_REQUEST['address'];
			$address = sanitize_text_field($sanitized_address);
		} 


		$table_name = $wpdb->prefix . "acpc_contactdetails";
			$wpdb->insert( $table_name, array(    
				'firstname' => esc_html($firstname),
				'lastname'  => esc_html($lastname),
				'mobile'    => esc_html($mobile),
				'e_mail'    => esc_html($email),
				'subject'   => esc_html($subject),
				'message'   => esc_html($message),
				'address'   => esc_html($address)
			) );

			/*********************
				MAIL FUNCTION
			********************* */

			$admin_email = get_option('admin_email');
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$message = "<html>
							<body>
							<h3>Hi Admin New User Contact For You .!</h3><br>
								<lable><b>FirstName :</b> <span style='color:red;font-size: 18px;'><i>".esc_attr($firstname)."</i></span></lable><br>
								<lable><b>LastName :</b> <span style='color:red;font-size: 18px;'><i>".esc_attr($lastname) ."</i></span></lable><br>
								<lable><b>Mobile :</b> <span style='color:red;font-size: 18px;'><i>".esc_attr($mobile)."</i></span></lable><br>
								<lable><b>E-Mail :</b> <span style='color:red;font-size: 18px;'><i>".esc_attr($email)."</i></span></lable><br>
								<lable><b>Subject :</b> <span style='color:red;font-size: 18px;'><i>".esc_attr($subject)."</i></span></lable><br>
								<lable><b>Message :</b> <span style='color:red;font-size: 18px;'><i>".esc_attr($message)."</i></span></lable><br>
								<lable><b>Address :</b> <span style='color:red;font-size: 18px;'><i>".esc_attr($address)."</i></span></lable><br>
							</body>
						</html>";
			
			define('WP_USE_THEMES', false);
			$sent_message = wp_mail( $admin_email, $subject, $message, $headers );
			
			if ( $sent_message ) {    
				$url = get_site_url();
				if ( wp_redirect( $url ) ) {
					exit;
				}
			}
		}
		
		/* ==================
		 	Subscriber Form
		 =================== */

add_action( 'admin_post_nopriv_subscriper_form', 'acpc_subscriperform' );
add_action( 'admin_post_subscriper_form', 'acpc_subscriperform' );
function acpc_subscriperform() {

	global $wpdb;

		$subscriberForm = false;

		if(isset($_REQUEST['subscriberForm'])){
			$subscriberForm = $_REQUEST['subscriberForm'];
			$sanitized_email = sanitize_email($subscriberForm);
		} 

		$table_name = $wpdb->prefix . "acpc_subscriberdetails";
		$wpdb->insert( $table_name, array(    
			'Email' => esc_html($sanitized_email),
		) );

		    /**********************
				MAIL FUNCTION
			***********************/
		  	$admin_email = get_option('admin_email');
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$subject = "New Form Submision";
			$message = "<html>
							<body>
							<h3>Hi Admin New User Contact For You .!</h3><br>
								<lable><b>Subscriber Mail :</b> <span style='color:red;font-size: 18px;'><i>".esc_attr($subscriberForm)."</i></span></lable><br>                  
							</body>
						</html>";

	       $sent_message = wp_mail( $admin_email, $subject, $message, $headers );

		 	if ( $sent_message ) {    
                $url = get_site_url();
                if ( wp_redirect( $url ) ) {
                    exit;
                }
            } 
	}
