<div class="loader"></div>
<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File          : alphaconnect-createnew.php
*  =================================== */

   /***************************
    * Show The Type Of Popups
    ***************************/

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

   $popupType = @sanitize_text_field($_GET['type']);
   if (!$popupType) {
       $popupType = 'html';
   }
   
   if (isset($_GET['id'])) {
       $id             = (int) $_GET['id'];
       $popupName      = "alphaconnect_" . lcfirst(strtolower($popupType));
       $popupClassName = $popupName;
       require_once (ALPHACONNECT_POPUP_PATH . "/class/" . $popupClassName . ".php");
       $result = call_user_func(array(
           $popupClassName,
           'acpc_findById'
       ), $id);
       $obj    = new $popupClassName();
       
       if (!$result) {
           wp_redirect(ALPHACONNECT_POPUP_ADMIN_URL . "page=popup_edit&type=" . $popupType . "");
   	}
   	        
       switch ($popupType) {        
           case 'html':
               $alpPopupDataHtml = $result->acpc_getContent();
               break;
           case 'contact':
               $alpContactForms = $result->acpc_getContactForm();
               break;
           case 'subscriber':
               $alpSubscriberForms = $result->acpc_getSubscriberForm();
               break;
           }
   
       /*****************
         FREE VIRSION
       ******************/
       $title                              = $result->acpc_getPopupTitle();
       $jsonData                           = json_decode($result->acpc_getPopupOptions(), true);
       $alpEscKey                          = @$jsonData['escKey'];
       $alpScrolling                       = @$jsonData['scrolling'];
       $alpDisablePageScrolling            = @$jsonData['disable-page-scrolling'];
       $alpScaling                         = @$jsonData['scaling'];
       $alpCloseButton                     = @$jsonData['closeButton'];
       $alpReposition                      = @$jsonData['reposition'];
       $alpOverlayClose                    = @$jsonData['overlayClose'];
       $alpReopenAfterSubmission           = @$jsonData['reopenAfterSubmission'];
       $alpPopupFixed                      = @$jsonData['popupFixed'];
       $alpFixedPostion                    = @$jsonData['fixedPostion'];
       $alpRepetitivePopup                 = @$jsonData['repetitivePopup'];
       $alpRepetitivePopupPeriod           = @$jsonData['repetitivePopupPeriod'];
       $alpIntervelPopup                   = @$jsonData['intervel'];
       $alpIntervelPopupTime               = @$jsonData['interveltime'];
       $alpIntervelPopupShow               = @$jsonData['intervelshowcount'];
       $alpContentClickBehavior            = @$jsonData['content-click-behavior'];
       $alpClickRedirectToUrl              = @$jsonData['click-redirect-to-url'];
       $alpCloseButtonDelay                = @$jsonData['buttonDelayValue'];
       $alpRedirectToNewTab                = @$jsonData['redirect-to-new-tab'];
       
       $alpPushToBottom                    = @alpSafeStr($jsonData['pushToBottom']);
       $alpOverlayColor                    = @$jsonData['alpOverlayColor'];
       $alpContentBackgroundColor          = @$jsonData['alp-content-background-color'];
       $alpContentClick                    = @$jsonData['contentClick'];
       $alpOpacity                         = @$jsonData['opacity'];
       $alpOnScrolling                     = @$jsonData['onScrolling'];
       $beforeScrolingPrsent               = @$jsonData['beforeScrolingPrsent'];
       $duration                           = @$jsonData['duration'];
       $delay                              = @$jsonData['delay'];
       $alpWidth                           = @$jsonData['width'];
       $alpHeight                          = @$jsonData['height'];
       $alpPopupDimensionMode              = @$jsonData['popup_dimension_mode'];
       $alpPopupResponsiveDimensionMeasure = @$jsonData['popup_responsive_dimension_measure'];
       $alpMaxWidth                        = @$jsonData['maxWidth'];
       $alpMaxHeight                       = @$jsonData['maxHeight'];
       $alpForMobile                       = @$jsonData['forMobile'];
       $alpRepeatPopup                     = @$jsonData['repeatPopup'];
       $alpDisablePopup                    = @$jsonData['disablePopup'];
       $alpColorboxTheme                   = @$jsonData['theme'];
       $alpRestrictionAction               = @$jsonData['restrictionAction'];
       $alpSelectEventsPopup               = @$jsonData['SelectEventsPopup'];
       
     
       /**************
         PRO VIRSION
       ***************/
       $alpDateRange          = @$jsonData['DateRange'];
       $alpDateRangeFromDate  = @$jsonData['DaterangeFromDate'];
       $alpDateRangeToDate    = @$jsonData['DaterangeToDate'];
       $alpSchedulePopUp      = @$jsonData['SchedulePopUp'];
       $alpSchedulePopUpDate  = @$jsonData['SchedulePopUpDate'];
       $alpMobileOnly         = @$jsonData['MobileOnly'];
       $alpMobileDisable      = @$jsonData['MobileDisable'];
       $alpInactivity         = @$jsonData['Inactivity'];
       $alpInactivitytime     = @$jsonData['Inactivitytime'];
       $alpWhileScrolling     = @$jsonData['WhileScrolling'];
       $alpWhileScrollingtime = @$jsonData['WhileScrollingtime'];
       $alpSelectePages       = @$jsonData['SelectePages'];
       $alpOptionsPages       = @$jsonData['OptionsPages'];
       $alpShowAllPageID      = @$jsonData['ShowAllPageID'];
       $alpShowCustomPageID   = @$jsonData['ShowCustomPageID'];    
       $alpSelectePosts       = @$jsonData['SelectePosts'];
       $alpOptionsPosts       = @$jsonData['OptionsPosts'];
       $alpShowAllPostID      = @$jsonData['ShowAllPostID'];
       $alpShowCustomPostID   = @$jsonData['ShowCustomPostID'];
       $alpUserStatus         = @$jsonData['UserStatus'];
       $alpLogedUser          = @$jsonData['loggedin-user'];
       $alpRandomPopUp        = @$jsonData['RandomPopUp'];
       $alpautoClosePopup     = @$jsonData['AutoClosePopup'];
       $alpPopupClosingTimer  = @$jsonData['PopupClosingTimer'];
       $alpDisablePopup       = @$jsonData['DisablePopup'];
       $alpDisableOverlay     = @$jsonData['DisableOverlay'];
       $alpHideMobile         = @$jsonData['HideMobile'];
   
   
       /**************
        CONTACT FORM
       ***************/
   
       /* 1.FIRST NAME */
       $alpContactForm          = json_decode(@$alpContactForms, true);
       $alpfirstname            = alpBoolToChecked(@$alpContactForm['FirstName']);
       $alpfirstnameLable       = @$alpContactForm['firstnameLable'];
       $alpfirstnamePlaceholder = @$alpContactForm['firstnamePlaceholder'];
       $alpfirstnameBorder      = @$alpContactForm['firstnameBorder'];
       $alpfirstnameBorderType  = @$alpContactForm['firstnameBorderType'];
       $alpfirstnameBorderColor = @$alpContactForm['firstnameBorderColor'];
       $alpfirstnameRequired    = @$alpContactForm['firstnameRequired'];
       $alpfirstnameBgcolour    = @$alpContactForm['firstnameBgcolour'];
       $alpfirstnameFontSize    = @$alpContactForm['firstnameFontSize'];
       $alpfirstnameFontColor   = @$alpContactForm['firstnameFontColor'];
       $alpfirstnameAlignment   = @$alpContactForm['firstnameAlignment'];
   
       /* 2.LAST NAME */
       $alplastname             = alpBoolToChecked(@$alpContactForm['LastName']);
       $alplastnameLable        = @$alpContactForm['lastnameLable'];
       $alplastnamePlaceholder  = @$alpContactForm['lastnamePlaceholder'];
       $alplastnameBorder       = @$alpContactForm['lastnameBorder'];
       $alplastnameBorderType   = @$alpContactForm['lastnameBorderType'];
       $alplastnameBorderColor  = @$alpContactForm['lastnameBorderColor'];
       $alplastnameRequired     = @$alpContactForm['lastnameRequired'];
       $alplastnameBgcolour     = @$alpContactForm['lastnameBgcolour'];
       $alplastnameFontSize     = @$alpContactForm['lastnameFontSize'];
       $alplastnameFontColor    = @$alpContactForm['lastnameFontColor'];
       $alplastnameAlignment    = @$alpContactForm['lastnameAlignment'];
   
       /* 3.MOBILE */
       $alpmobile               = alpBoolToChecked(@$alpContactForm['Mobile']);
       $alpmobileLable          = @$alpContactForm['mobileLable'];
       $alpmobilePlaceholder    = @$alpContactForm['mobilePlaceholder'];
       $alpmobileBorder         = @$alpContactForm['mobileBorder'];
       $alpmobileBorderType     = @$alpContactForm['mobileBorderType'];
       $alpmobileBorderColor    = @$alpContactForm['mobileBorderColor'];
       $alpmobileRequired       = @$alpContactForm['mobileRequired'];
       $alpmobileBgcolour       = @$alpContactForm['mobileBgcolour'];
       $alpmobileFontSize       = @$alpContactForm['mobileFontSize'];
       $alpmobileFontColor      = @$alpContactForm['mobileFontColor'];
       $alpmobileAlignment      = @$alpContactForm['mobileAlignment']; 
   
       /* 4.EMAIL */
       $alpemail                = alpBoolToChecked(@$alpContactForm['Email']);
       $alpemailLable           = @$alpContactForm['emailLable'];
       $alpemailPlaceholder     = @$alpContactForm['emailPlaceholder'];
       $alpemailBorder          = @$alpContactForm['emailBorder'];
       $alpemailBorderType      = @$alpContactForm['emailBorderType'];
       $alpemailBorderColor     = @$alpContactForm['emailBorderColor'];
       $alpemailRequired        = @$alpContactForm['emailRequired'];
       $alpemailBgcolour        = @$alpContactForm['emailBgcolour'];
       $alpemailFontSize        = @$alpContactForm['emailFontSize'];
       $alpemailFontColor       = @$alpContactForm['emailFontColor'];
       $alpemailAlignment       = @$alpContactForm['emailAlignment']; 
   
       /* 5.SUBJECT */
       $alpsubject              = alpBoolToChecked(@$alpContactForm['Subject']);
       $alpsubjectLable         = @$alpContactForm['subjectLable'];
       $alpsubjectPlaceholder   = @$alpContactForm['subjectPlaceholder'];
       $alpsubjectBorder        = @$alpContactForm['subjectBorder'];
       $alpsubjectBorderType    = @$alpContactForm['subjectBorderType'];
       $alpsubjectBorderColor   = @$alpContactForm['subjectBorderColor'];
       $alpsubjectRequired      = @$alpContactForm['subjectRequired'];
       $alpsubjectBgcolour      = @$alpContactForm['subjectBgcolour'];
       $alpsubjectFontSize      = @$alpContactForm['subjectFontSize'];
       $alpsubjectFontColor     = @$alpContactForm['subjectFontColor'];
       $alpsubjectAlignment     = @$alpContactForm['subjectAlignment']; 
   
       /* 6.MESSAGE */
       $alpmessage              = alpBoolToChecked(@$alpContactForm['Message']);
       $alpmessageLable         = @$alpContactForm['messageLable'];
       $alpmessagePlaceholder   = @$alpContactForm['messagePlaceholder'];
       $alpmessageBorder        = @$alpContactForm['messageBorder'];
       $alpmessageBorderType    = @$alpContactForm['messageBorderType'];
       $alpmessageBorderColor   = @$alpContactForm['messageBorderColor'];
       $alpmessageRequired      = @$alpContactForm['messageRequired'];
       $alpmessageBgcolour      = @$alpContactForm['messageBgcolour'];
       $alpmessageFontSize      = @$alpContactForm['messageFontSize'];
       $alpmessageFontColor     = @$alpContactForm['messageFontColor'];
       $alpmessageAlignment     = @$alpContactForm['messageAlignment']; 
   
       // 7.ADDRESS
       $alpaddress              = alpBoolToChecked(@$alpContactForm['Address']);
       $alpaddressLable         = @$alpContactForm['addressLable'];
       $alpaddressPlaceholder   = @$alpContactForm['addressPlaceholder'];
       $alpaddressBorder        = @$alpContactForm['addressBorder'];
       $alpaddressBorderType    = @$alpContactForm['addressBorderType'];
       $alpaddressBorderColor   = @$alpContactForm['addressBorderColor'];
       $alpaddressRequired      = @$alpContactForm['addressRequired'];
       $alpaddressBgcolour      = @$alpContactForm['addressBgcolour'];
       $alpaddressFontSize      = @$alpContactForm['addressFontSize'];
       $alpaddressFontColor     = @$alpContactForm['addressFontColor'];
       $alpaddressAlignment     = @$alpContactForm['addressAlignment']; 
      
           
       /****************
        SUBSCRIBER FORM
       *****************/
   
       /* Email Text Box*/
       $alpSubscriberForm       = json_decode(@$alpSubscriberForms, true);
       $alpsubscriberemail      = @$alpSubscriberForm['subscriberemail'];   
       $alpplaceholderfiled     = @$alpSubscriberForm['placeholderfiled'];     
       $alpbordersize           = @$alpSubscriberForm['bordersize']; 
       $alpbordertype           = @$alpSubscriberForm['bordertype']; 
       $alpbordercolor          = @$alpSubscriberForm['bordercolor']; 
       $alprequiredFiled        = @$alpSubscriberForm['requiredFiled']; 
       $alpbackgroundfiled      = @$alpSubscriberForm['backgroundfiled']; 
       $alpfontsizefiled        = @$alpSubscriberForm['fontsizefiled']; 
       $alpfontcolor            = @$alpSubscriberForm['fontcolor']; 
       $alpfontalignment        = @$alpSubscriberForm['fontalignment']; 
        
       /* Email Submit button filed*/
       $alpsubscribersubmitbutton= @$alpSubscriberForm['subscribersubmitbutton'];  
       $alpbuttonhight          = @$alpSubscriberForm['buttonhight'];
       $alpbuttonwidth          = @$alpSubscriberForm['buttonwidth']; 
       $alpbuttonlable          = @$alpSubscriberForm['buttonlable'];
       $alpbuttonbordersize     = @$alpSubscriberForm['buttonbordersize'];
       $alpbuttonbordertype     = @$alpSubscriberForm['buttonbordertype'];
       $alpbuttonbordercolor    = @$alpSubscriberForm['buttonbordercolor'];
       $alpbuttonbackground     = @$alpSubscriberForm['buttonbackground'];
       $alpbuttonfontsize       = @$alpSubscriberForm['buttonfontsize'];
       $alpbuttonfontcolor      = @$alpSubscriberForm['buttonfontcolor'];
           
       /* Content  Text Box*/
       $alpsubscribermessage = @$alpSubscriberForm['subscribermessage'];

       $alpmyprefix_image_id = @$alpSubscriberForm['myprefix_image_id'];     
   }
   
       $dataPopupId = @$id;
       if (!isset($id)) {
           $dataPopupId = "-1";
       }
   
       /***********************************
         FREE VIRSION SET AND GET VALUES
       ************************************/
   
       $colorboxDeafultValues = array(
       'escKey'                 => true,
       'closeButton'            => true,
       'scrolling'              => true,
       'disable-page-scrolling' => false,
       'reopenAfterSubmission'  => false,
       'repetitivePopup'        => false,
       'repetitivePopupPeriod'  => 10,
       'intervel'               => false,
       'interveltime'           => 10,
       'intervelshowcount'      => 2,
       'content-click-behavior' => 'close',
       'pushToBottom'           => true,
       'redirect-to-new-tab'    => true,
       'buttonDelayValue'       => 0,
       'reposition'             => false,
       'overlayClose'           => true,
       'contentClick'           => false,
       'scaling'                => false,
       'onScrolling'            => false,
       'repetPopup'             => false,
       'opacity'                => 0.7,
       'width'                  => '450px',
       'height'                 => '340px',
       'popup_dimension_mode'   => 'responsiveMode',
       'alp-content-background-color'=> '#ffffff',
       'popup_responsive_dimension_measure'=> 'auto',
       'maxWidth'               => false,
       'maxHeight'              => false,
       'fixed'                  => false,
       'top'                    => false,
       'right'                  => false,
       'bottom'                 => false,
       'left'                   => false,
       'duration'               => 1,
       'SelectEventsPopup'      => true
       );
   
       $escKey                          = alpBoolToChecked($colorboxDeafultValues['escKey']);
       $closeButton                     = alpBoolToChecked($colorboxDeafultValues['closeButton']);
       $scrolling                       = alpBoolToChecked($colorboxDeafultValues['scrolling']);
       $disablePageScrolling            = alpBoolToChecked($colorboxDeafultValues['disable-page-scrolling']);
       $reopenAfterSubmission           = alpBoolToChecked($colorboxDeafultValues['reopenAfterSubmission']);
       $repetitivePopup                 = alpBoolToChecked($colorboxDeafultValues['repetitivePopup']);
       $intervel                        = alpBoolToChecked($colorboxDeafultValues['intervel']);
       $pushToBottom                    = alpBoolToChecked($colorboxDeafultValues['pushToBottom']);
       $redirectToNewTab                = alpBoolToChecked($colorboxDeafultValues['redirect-to-new-tab']);
       $reposition                      = alpBoolToChecked($colorboxDeafultValues['reposition']);
       $overlayClose                    = alpBoolToChecked($colorboxDeafultValues['overlayClose']);
       $contentClick                    = alpBoolToChecked($colorboxDeafultValues['contentClick']);
       $scaling                         = alpBoolToChecked($colorboxDeafultValues['scaling']);
       $onScrolling                     = alpBoolToChecked($colorboxDeafultValues['onScrolling']);
       $repetPopup                      = alpBoolToChecked($colorboxDeafultValues['repetPopup']);
   
       $width                           = $colorboxDeafultValues['width'];
       $height                          = $colorboxDeafultValues['height'];
       $intervelTime                    = $colorboxDeafultValues['interveltime'];
       $intervelshowcount               = $colorboxDeafultValues['intervelshowcount'];
       $popupDimensionMode              = $colorboxDeafultValues['popup_dimension_mode'];
       $repetitivePopupPeriod           = $colorboxDeafultValues['repetitivePopupPeriod'];
       $ContentBackgroundColor          = $colorboxDeafultValues['alp-content-background-color'];
       $popupResponsiveDimensionMeasure = $colorboxDeafultValues['popup_responsive_dimension_measure'];
       $opacityValue                    = $colorboxDeafultValues['opacity'];
       $top                             = $colorboxDeafultValues['top'];
       $right                           = $colorboxDeafultValues['right'];
       $bottom                          = $colorboxDeafultValues['bottom'];
       $left                            = $colorboxDeafultValues['left'];
       $maxWidth                        = $colorboxDeafultValues['maxWidth'];
       $maxHeight                       = $colorboxDeafultValues['maxHeight'];
       $deafultFixed                    = $colorboxDeafultValues['fixed'];
       $defaultDuration                 = $colorboxDeafultValues['duration'];
       $contentClickBehavior            = $colorboxDeafultValues['content-click-behavior'];
       $buttonDelayValue                = $colorboxDeafultValues['buttonDelayValue'];
       $SelectEventsPopup               = $colorboxDeafultValues['SelectEventsPopup'];
   
       $alpEscKey                       = @alpSetChecked($alpEscKey, $escKey);
       $alpCloseButton                  = @alpSetChecked($alpCloseButton, $closeButton);
       $alpScrolling                    = @alpSetChecked($alpScrolling, $scrolling);
       $alpDisablePageScrolling         = @alpSetChecked($alpDisablePageScrolling, $disablePageScrolling);
       $alpReopenAfterSubmission        = @alpSetChecked($alpReopenAfterSubmission, $reopenAfterSubmission);
       $alpIntervelPopup                = @alpSetChecked($alpIntervelPopup, $intervel);
       $alpPushToBottom                 = @alpSetChecked($alpPushToBottom, $pushToBottom);
       $alpReposition                   = @alpSetChecked($alpReposition, $reposition);
       $alpOverlayClose                 = @alpSetChecked($alpOverlayClose, $overlayClose);
       $alpContentClick                 = @alpSetChecked($alpContentClick, $contentClick);
       $alpScaling                      = @alpSetChecked($alpScaling, $scaling);
       $alpOnScrolling                  = @alpSetChecked($alpOnScrolling, $onScrolling);
       $alpRepetitivePopup              = @alpSetChecked($alpRepetitivePopup, $repetitivePopup);
       $alpPopupFixed                   = @alpSetChecked($alpPopupFixed, $deafultFixed);
       $alpRepeatPopup                  = @alpSetChecked($alpRepeatPopup, $repetPopup);
       $alpRedirectToNewTab             = @alpSetChecked($alpRedirectToNewTab, $redirectToNewTab);
   
       /***********************************
         PRO VIRSION SET AND GET VALUES
       ************************************/
   
        $popupProDefaultValues = array(
            'DateRange'         => false,
            'DaterangeFromDate' => false,
            'DaterangeToDate'   => false,
            'SchedulePopUp'     => false,
            'SchedulePopUpDate' => false,
            'MobileOnly'        => false,
            'MobileDisable'     => false,
            'Inactivity'        => false,
            'WhileScrolling'    => false,
            'SelectePages'      => false,
            'OptionsPages'      => 'all',
            'ShowAllPageID'     => "all",
            'ShowCustomPageID'  => "Page_0",
            'SelectePosts'      => false,
            'OptionsPosts'      => 'all',
            'ShowAllPostID'     => "all",
            'ShowCustomPostID'  => "Post_0",
            'UserStatus'        => false,
            'loggedin-user'     => 'true',
            'RandomPopUp'       => false,
            'AutoClosePopup'    => false,
            'DisablePopup'      => false,
            'DisableOverlay'    => false,
            'HideMobile'        => false
        );
   
       $DateRange                          = alpBoolToChecked($popupProDefaultValues['DateRange']);
       $DateRangeFromDate                  = alpBoolToChecked($popupProDefaultValues['DaterangeFromDate']);
       $DateRangeToDate                    = alpBoolToChecked($popupProDefaultValues['DaterangeToDate']);
       $SchedulePopUp                      = alpBoolToChecked($popupProDefaultValues['SchedulePopUp']);
       $SchedulePopUpDate                  = alpBoolToChecked($popupProDefaultValues['SchedulePopUpDate']);
       $MobileOnly                         = alpBoolToChecked($popupProDefaultValues['MobileOnly']);
       $MobileDisable                      = alpBoolToChecked($popupProDefaultValues['MobileDisable']);
       $Inactivity                         = alpBoolToChecked($popupProDefaultValues['Inactivity']);
       $WhileScrolling                     = alpBoolToChecked($popupProDefaultValues['WhileScrolling']);
       $SelectePages                       = alpBoolToChecked($popupProDefaultValues['SelectePages']);
       $RandomPopUp                        = alpBoolToChecked($popupProDefaultValues['RandomPopUp']);
       $AutoClosePopup                     = alpBoolToChecked($popupProDefaultValues['AutoClosePopup']);
       $DisablePopup                       = alpBoolToChecked($popupProDefaultValues['DisablePopup']);
       $DisableOverlay                     = alpBoolToChecked($popupProDefaultValues['DisableOverlay']);
       $HideMobile                         = alpBoolToChecked($popupProDefaultValues['HideMobile']);
       $ShowAllPageID                      = alpBoolToChecked($popupProDefaultValues['ShowAllPageID']);
       $SelectePosts                       = alpBoolToChecked($popupProDefaultValues['SelectePosts']);
       $ShowAllPostID                      = alpBoolToChecked($popupProDefaultValues['ShowAllPostID']);
       $UserStatus                         = alpBoolToChecked($popupProDefaultValues['UserStatus']);
       $OptionsPages                       = $popupProDefaultValues['OptionsPages'];
       $ShowCustomPageID                   = $popupProDefaultValues['ShowCustomPageID'];   
       $OptionsPosts                       = $popupProDefaultValues['OptionsPosts'];
       $ShowCustomPostID                   = $popupProDefaultValues['ShowCustomPostID'];   
       $logedUser                          = $popupProDefaultValues['loggedin-user'];
   
       $alpDateRange                       = @alpSetChecked($alpDateRange, $DateRange);
       $alpSchedulePopUp                   = @alpSetChecked($alpSchedulePopUp, $SchedulePopUp);
       $alpMobileOnly                      = @alpSetChecked($alpMobileOnly, $MobileOnly);
       $alpMobileDisable                   = @alpSetChecked($alpMobileDisable, $MobileDisable);
       $alpInactivity                      = @alpSetChecked($alpInactivity, $Inactivity);
       $alpWhileScrolling                  = @alpSetChecked($alpWhileScrolling, $WhileScrolling);
       $alpSelectePages                    = @alpSetChecked($alpSelectePages, $SelectePages);
       $alpShowAllPageID                   = @alpSetChecked($alpShowAllPageID, $ShowAllPageID);
       $alpSelectePosts                    = @alpSetChecked($alpSelectePosts, $SelectePosts);
       $alpShowAllPostID                   = @alpSetChecked($alpShowAllPostID, $ShowAllPostID);
       $alpUserStatus                      = @alpSetChecked($alpUserStatus, $UserStatus);
       $alpRandomPopUp                     = @alpSetChecked($alpRandomPopUp, $RandomPopUp);
       $alpautoClosePopup                  = @alpSetChecked($alpautoClosePopup, $AutoClosePopup);
       $alpDisablePopup                    = @alpSetChecked($alpDisablePopup, $DisablePopup);
       $alpDisableOverlay                  = @alpSetChecked($alpDisableOverlay, $DisableOverlay);
       $alpHideMobile                      = @alpSetChecked($alpHideMobile, $HideMobile);
   
       $alpFromDate                        = @alpGetValue($alpDateRangeFromDate, $DateRangeFromDate);
       $alpToDate                          = @alpGetValue($alpDateRangeToDate, $DateRangeToDate);
       $alpScheduleDate                    = @alpGetValue($alpSchedulePopUpDate, $SchedulePopUpDate);
       $alpRepetitivePopupPeriod           = @alpGetValue($alpRepetitivePopupPeriod, $repetitivePopupPeriod);
       $alpCloseButtonDelay                = @alpGetValue($alpCloseButtonDelay, $buttonDelayValue);
       $alpOpacity                         = @alpGetValue($alpOpacity, $opacityValue);
       $alpWidth                           = @alpGetValue($alpWidth, $width);
       $alpHeight                          = @alpGetValue($alpHeight, $height);
       $alpPopupDimensionMode              = @alpGetValue($alpPopupDimensionMode, $popupDimensionMode);
       $alpContentBackgroundColor          = @alpGetValue($alpContentBackgroundColor, $ContentBackgroundColor);
       $alpIntervelPopupTime               = @alpGetValue($alpIntervelPopupTime, $intervelTime);
       $alpIntervelPopupShow               = @alpGetValue($alpIntervelPopupShow, $intervelshowcount);
       $alpPopupResponsiveDimensionMeasure = @alpGetValue($alpPopupResponsiveDimensionMeasure, $popupResponsiveDimensionMeasure);
       $alpMaxWidth                        = @alpGetValue($alpMaxWidth, $maxWidth);
       $alpMaxHeight                       = @alpGetValue($alpMaxHeight, $maxHeight);
       $duration                           = @alpGetValue($duration, $defaultDuration);
       $delay                              = @alpGetValue($delay, $defaultDelay);
       $alpContentClickBehavior            = @alpGetValue($alpContentClickBehavior, $contentClickBehavior);
       $alpSelectEventsPopup               = @alpGetValue($alpSelectEventsPopup, $SelectEventsPopup);
   
       $alpPopupDataHtml                   = @alpGetValue($alpPopupDataHtml, '');
       $alpPopupDataSubscriber             = @alpGetValue($alpPopupDataSubscriber, '');
       $alpPopupDataImage                  = @alpGetValue($alpPopupDataImage, '');
       $alpLogedUser                       = @alpGetValue($alpLogedUser, $logedUser);
       $alpOptionsPages                    = @alpGetValue($alpOptionsPages, $OptionsPages);
       $alpOptionsPosts                    = @alpGetValue($alpOptionsPosts, $OptionsPosts);
      
       /***********************************
         CONTACT FORM SET AND GET VALUES
       ************************************/
   
        $alpContactForm = array(
           'FirstName'             => true,
           'firstnameLable'        => 'First Name',
           'firstnamePlaceholder'  => 'Enter Your First Name',
           'firstnameBorder'       => '2px',
           'firstnameBorderType'   => 'solid',
           'firstnameRequired'     => 'required',
           'firstnameBgcolour'     => '#ffffff',
           'firstnameFontSize'     => '16px',
           'firstnameAlignment'    => 'left',
   
           'LastName'             => false,
           'lastnameLable'        => 'Last Name',
           'lastnamePlaceholder'  => 'Enter Your Last Name',
           'lastnameBorder'       => '2px',
           'lastnameBorderType'   => 'solid',
           'lastnameRequired'     => 'required',
           'lastnameBgcolour'     => '#ffffff',
           'lastnameFontSize'     => '16px',
           'lastnameAlignment'    => 'left',
   
           'Mobile'               => false,
           'mobileLable'          => 'Telephone',
           'mobilePlaceholder'    => 'Enter Your Telephone Number',
           'mobileBorder'         => '2px',
           'mobileBorderType'     => 'solid',
           'mobileRequired'       => 'required',
           'mobileBgcolour'       => '#ffffff',
           'mobileFontSize'       => '16px',
           'mobileAlignment'      => 'left',
   
           'Email'                => true,
           'emailLable'           => 'E-Mail',
           'emailPlaceholder'     => 'Enter Your E-Mail',
           'emailBorder'          => '2px',
           'emailBorderType'      => 'solid',
           'emailRequired'        => 'required',
           'emailBgcolour'        => '#ffffff',
           'emailFontSize'        => '16px',
           'emailAlignment'       => 'left',
   
           'Subject'               => false,
           'subjectLable'          => 'Subject',
           'subjectPlaceholder'    => 'Enter Your Subject',
           'subjectBorder'         => '2px',
           'subjectBorderType'     => 'solid',
           'subjectRequired'       => 'required',
           'subjectBgcolour'       => '#ffffff',
           'subjectFontSize'       => '16px',
           'subjectAlignment'      => 'left',
   
           'Message'               => false,
           'messageLable'          => 'Message',
           'messagePlaceholder'    => 'Enter Your Message',
           'messageBorder'         => '2px',
           'messageBorderType'     => 'solid',
           'messageRequired'       => 'required',
           'messageBgcolour'       => '#ffffff',
           'messageFontSize'       => '16px',
           'messageAlignment'      => 'left',
   
           'Address'               => false,
           'addressLable'          => 'Address',
           'addressPlaceholder'    => 'Enter Your Address',
           'addressBorder'         => '2px',
           'addressBorderType'     => 'solid',
           'addressRequired'       => 'required',
           'addressBgcolour'       => '#ffffff',
           'addressFontSize'       => '16px',
           'addressAlignment'      => 'left',
   
       );
   
       $firstname                  = $alpContactForm['FirstName'];
       $firstnameLable             = $alpContactForm['firstnameLable'];
       $firstnamePlaceholder       = $alpContactForm['firstnamePlaceholder'];
       $firstnameBorder            = $alpContactForm['firstnameBorder'];
       $firstnameBorderType        = $alpContactForm['firstnameBorderType'];
       $firstnameRequired          = $alpContactForm['firstnameRequired'];
       $firstnameBgcolour          = $alpContactForm['firstnameBgcolour'];
       $firstnameFontSize          = $alpContactForm['firstnameFontSize'];
       $firstnameAlignment         = $alpContactForm['firstnameAlignment'];
   
       $alpfirstname               = @alpGetValue($alpfirstname, $firstname);
       $alpfirstnameLable          = @alpGetValue($alpfirstnameLable, $firstnameLable);
       $alpfirstnamePlaceholder    = @alpGetValue($alpfirstnamePlaceholder, $firstnamePlaceholder);
       $alpfirstnameBorder         = @alpGetValue($alpfirstnameBorder, $firstnameBorder);
       $alpfirstnameBorderType     = @alpGetValue($alpfirstnameBorderType, $firstnameBorderType);
       $alpfirstnameRequired       = @alpGetValue($alpfirstnameRequired, $firstnameRequired);
       $alpfirstnameBgcolour       = @alpGetValue($alpfirstnameBgcolour, $firstnameBgcolour);
       $alpfirstnameFontSize       = @alpGetValue($alpfirstnameFontSize, $firstnameFontSize);
       $alpfirstnameAlignment      = @alpGetValue($alpfirstnameAlignment, $firstnameAlignment);
   
       $lastname                   = $alpContactForm['LastName'];
       $lastnameLable              = $alpContactForm['lastnameLable'];
       $lastnamePlaceholder        = $alpContactForm['lastnamePlaceholder'];
       $lastnameBorder             = $alpContactForm['lastnameBorder'];
       $lastnameBorderType         = $alpContactForm['lastnameBorderType'];
       $lastnameRequired           = $alpContactForm['lastnameRequired'];
       $lastnameBgcolour           = $alpContactForm['lastnameBgcolour'];
       $lastnameFontSize           = $alpContactForm['lastnameFontSize'];
       $lastnameAlignment          = $alpContactForm['lastnameAlignment'];
   
       $alplastname                = @alpGetValue($alplastname, $lastname);
       $alplastnameLable           = @alpGetValue($alplastnameLable, $lastnameLable);
       $alplastnamePlaceholder     = @alpGetValue($alplastnamePlaceholder, $lastnamePlaceholder);
       $alplastnameBorder          = @alpGetValue($alplastnameBorder, $lastnameBorder);
       $alplastnameBorderType      = @alpGetValue($alplastnameBorderType, $lastnameBorderType);
       $alplastnameRequired        = @alpGetValue($alplastnameRequired, $lastnameRequired);
       $alplastnameBgcolour        = @alpGetValue($alplastnameBgcolour, $lastnameBgcolour);
       $alplastnameFontSize        = @alpGetValue($alplastnameFontSize, $lastnameFontSize);
       $alplastnameAlignment       = @alpGetValue($alplastnameAlignment, $lastnameAlignment);
       
       $mobile                     = $alpContactForm['Mobile'];
       $mobileLable                = $alpContactForm['mobileLable'];
       $mobilePlaceholder          = $alpContactForm['mobilePlaceholder'];
       $mobileBorder               = $alpContactForm['mobileBorder'];
       $mobileBorderType           = $alpContactForm['mobileBorderType'];
       $mobileRequired             = $alpContactForm['mobileRequired'];
       $mobileBgcolour             = $alpContactForm['mobileBgcolour'];
       $mobileFontSize             = $alpContactForm['mobileFontSize'];
       $mobileAlignment            = $alpContactForm['mobileAlignment'];
   
       $alpmobile                  = @alpGetValue($alpmobile, $mobile);
       $alpmobileLable             = @alpGetValue($alpmobileLable, $mobileLable);
       $alpmobilePlaceholder       = @alpGetValue($alpmobilePlaceholder, $mobilePlaceholder);
       $alpmobileBorder            = @alpGetValue($alpmobileBorder, $mobileBorder);
       $alpmobileBorderType        = @alpGetValue($alpmobileBorderType, $mobileBorderType);
       $alpmobileRequired          = @alpGetValue($alpmobileRequired, $mobileRequired);
       $alpmobileBgcolour          = @alpGetValue($alpmobileBgcolour, $mobileBgcolour);
       $alpmobileFontSize          = @alpGetValue($alpmobileFontSize, $mobileFontSize);
       $alpmobileAlignment         = @alpGetValue($alpmobileAlignment, $mobileAlignment);
   
       $email                     = $alpContactForm['Email'];
       $emailLable                = $alpContactForm['emailLable'];
       $emailPlaceholder          = $alpContactForm['emailPlaceholder'];
       $emailBorder               = $alpContactForm['emailBorder'];
       $emailBorderType           = $alpContactForm['emailBorderType'];
       $emailRequired             = $alpContactForm['emailRequired'];
       $emailBgcolour             = $alpContactForm['emailBgcolour'];
       $emailFontSize             = $alpContactForm['emailFontSize'];
       $emailAlignment            = $alpContactForm['emailAlignment'];
   
       $alpemail                  = @alpGetValue($alpemail, $email);
       $alpemailLable             = @alpGetValue($alpemailLable, $emailLable);
       $alpemailPlaceholder       = @alpGetValue($alpemailPlaceholder, $emailPlaceholder);
       $alpemailBorder            = @alpGetValue($alpemailBorder, $emailBorder);
       $alpemailBorderType        = @alpGetValue($alpemailBorderType, $emailBorderType);
       $alpemailRequired          = @alpGetValue($alpemailRequired, $emailRequired);
       $alpemailBgcolour          = @alpGetValue($alpemailBgcolour, $emailBgcolour);
       $alpemailFontSize          = @alpGetValue($alpemailFontSize, $emailFontSize);
       $alpemailAlignment         = @alpGetValue($alpemailAlignment, $emailAlignment);
   
       $subject                   = $alpContactForm['Subject'];
       $subjectLable              = $alpContactForm['subjectLable'];
       $subjectPlaceholder        = $alpContactForm['subjectPlaceholder'];
       $subjectBorder             = $alpContactForm['subjectBorder'];
       $subjectBorderType         = $alpContactForm['subjectBorderType'];
       $subjectRequired           = $alpContactForm['subjectRequired'];
       $subjectBgcolour           = $alpContactForm['subjectBgcolour'];
       $subjectFontSize           = $alpContactForm['subjectFontSize'];
       $subjectAlignment          = $alpContactForm['subjectAlignment'];
   
       $alpsubject                = @alpGetValue($alpsubject, $subject);
       $alpsubjectLable           = @alpGetValue($alpsubjectLable, $subjectLable);
       $alpsubjectPlaceholder     = @alpGetValue($alpsubjectPlaceholder, $subjectPlaceholder);
       $alpsubjectBorder          = @alpGetValue($alpsubjectBorder, $subjectBorder);
       $alpsubjectBorderType      = @alpGetValue($alpsubjectBorderType, $subjectBorderType);
       $alpsubjectRequired        = @alpGetValue($alpsubjectRequired, $subjectRequired);
       $alpsubjectBgcolour        = @alpGetValue($alpsubjectBgcolour, $subjectBgcolour);
       $alpsubjectFontSize        = @alpGetValue($alpsubjectFontSize, $subjectFontSize);
       $alpsubjectAlignment       = @alpGetValue($alpsubjectAlignment, $subjectAlignment);
   
       $message                   = $alpContactForm['Message'];
       $messageLable              = $alpContactForm['messageLable'];
       $messagePlaceholder        = $alpContactForm['messagePlaceholder'];
       $messageBorder             = $alpContactForm['messageBorder'];
       $messageBorderType         = $alpContactForm['messageBorderType'];
       $messageRequired           = $alpContactForm['messageRequired'];
       $messageBgcolour           = $alpContactForm['messageBgcolour'];
       $messageFontSize           = $alpContactForm['messageFontSize'];
       $messageAlignment          = $alpContactForm['messageAlignment'];
   
       $alpmessage                = @alpGetValue($alpmessage, $message);
       $alpmessageLable           = @alpGetValue($alpmessageLable, $messageLable);
       $alpmessagePlaceholder     = @alpGetValue($alpmessagePlaceholder, $messagePlaceholder);
       $alpmessageBorder          = @alpGetValue($alpmessageBorder, $messageBorder);
       $alpmessageBorderType      = @alpGetValue($alpmessageBorderType, $messageBorderType);
       $alpmessageRequired        = @alpGetValue($alpmessageRequired, $messageRequired);
       $alpmessageBgcolour        = @alpGetValue($alpmessageBgcolour, $messageBgcolour);
       $alpmessageFontSize        = @alpGetValue($alpmessageFontSize, $messageFontSize);
       $alpmessageAlignment       = @alpGetValue($alpmessageAlignment, $messageAlignment);
   
       $address                   = $alpContactForm['Address'];
       $addressLable              = $alpContactForm['addressLable'];
       $addressPlaceholder        = $alpContactForm['addressPlaceholder'];
       $addressBorder             = $alpContactForm['addressBorder'];
       $addressBorderType         = $alpContactForm['addressBorderType'];
       $addressRequired           = $alpContactForm['addressRequired'];
       $addressBgcolour           = $alpContactForm['addressBgcolour'];
       $addressFontSize           = $alpContactForm['addressFontSize'];
       $addressAlignment          = $alpContactForm['addressAlignment'];
   
       $alpaddress                = @alpGetValue($alpaddress, $address);
       $alpaddressLable           = @alpGetValue($alpaddressLable, $addressLable);
       $alpaddressPlaceholder     = @alpGetValue($alpaddressPlaceholder, $addressPlaceholder);
       $alpaddressBorder          = @alpGetValue($alpaddressBorder, $addressBorder);
       $alpaddressBorderType      = @alpGetValue($alpaddressBorderType, $addressBorderType);
       $alpaddressRequired        = @alpGetValue($alpaddressRequired, $addressRequired);
       $alpaddressBgcolour        = @alpGetValue($alpaddressBgcolour, $addressBgcolour);
       $alpaddressFontSize        = @alpGetValue($alpaddressFontSize, $addressFontSize);
       $alpaddressAlignment       = @alpGetValue($alpaddressAlignment, $addressAlignment);
   
   
       /***********************************
         SUBSCRIBETION FORM SET AND GET VALUES
       ************************************/
   
       $alpSubscriberForm = array(
           'placeholderfiled'      => 'Enter You Mail Here.!',
           'bordersize'            => '2px',
           'requiredFiled'         => 'required',
           'fontsizefiled'         => '16px',
           'bordertype'            => 'solid',   
           'backgroundfiled'       => '#ffffff',
           'fontalignment'         => 'left',
   
           'buttonhight'           => '42px',
           'buttonwidth'           => '120px',
           'buttonlable'           => 'SUBMIT',
           'buttonbordersize'      => '2px',
           'buttonbordertype'      => 'solid',
           'buttonbackground'      => '#ffffff',
           'buttonfontsize'        => '15px',
       );
   
       $placeholderfiled           = $alpSubscriberForm['placeholderfiled'];
       $bordersize                 = $alpSubscriberForm['bordersize'];
       $requiredFiled              = $alpSubscriberForm['requiredFiled'];
       $fontsizefiled              = $alpSubscriberForm['fontsizefiled'];
       $bordertype                 = $alpSubscriberForm['bordertype'];
       $backgroundfiled            = $alpSubscriberForm['backgroundfiled'];
       $fontalignment              = $alpSubscriberForm['fontalignment'];
   
       $buttonhight                = $alpSubscriberForm['buttonhight'];
       $buttonwidth                = $alpSubscriberForm['buttonwidth'];
       $buttonlable                = $alpSubscriberForm['buttonlable'];
       $buttonbordersize           = $alpSubscriberForm['buttonbordersize'];
       $buttonbordertype           = $alpSubscriberForm['buttonbordertype'];
       $buttonbackground           = $alpSubscriberForm['buttonbackground'];
       $buttonfontsize             = $alpSubscriberForm['buttonfontsize'];
   
       $alpplaceholderfiled        = @alpGetValue($alpplaceholderfiled, $placeholderfiled);
       $alpbordersize              = @alpGetValue($alpbordersize, $bordersize);
       $alprequiredFiled           = @alpGetValue($alprequiredFiled, $requiredFiled);
       $alpfontsizefiled           = @alpGetValue($alpfontsizefiled, $fontsizefiled);
       $alpbordertype              = @alpGetValue($alpbordertype, $bordertype);
       $alpbackgroundfiled         = @alpGetValue($alpbackgroundfiled, $backgroundfiled);
       $alpfontalignment           = @alpGetValue($alpfontalignment, $fontalignment);
   
       $alpbuttonhight             = @alpGetValue($alpbuttonhight, $buttonhight);
       $alpbuttonwidth             = @alpGetValue($alpbuttonwidth, $buttonwidth);
       $alpbuttonlable             = @alpGetValue($alpbuttonlable, $buttonlable);
       $alpbuttonbordersize        = @alpGetValue($alpbuttonbordersize, $buttonbordersize);
       $alpbuttonbordertype        = @alpGetValue($alpbuttonbordertype, $buttonbordertype);
       $alpbuttonbackground        = @alpGetValue($alpbuttonbackground, $buttonbackground);
       $alpbuttonfontsize          = @alpGetValue($alpbuttonfontsize, $buttonfontsize);
   
   function alpBoolToChecked($var){
       return ($var ? 'checked' : '');
   }
   
   function alpRemoveOption($option){
       global $removeOptions;
       return isset($removeOptions[$option]);
   }
   
   function alpSetChecked($optionsParam, $defaultOption){
       if (isset($optionsParam)) {
           if ($optionsParam == '') {
               return '';
           } else {
               return 'checked';
           }
       } else {
           return $defaultOption;
       }
   }
   
   if (!empty($alpShowCustomPageID)) {
       $alpShowPageId = implode(",", @alpGetValue($alpShowCustomPageID, $ShowCustomPageID));
   } else {
       $alpShowPageId = '';
   }
   if (!empty($alpShowCustomPostID)) {
       $alpShowPostID = implode(",", @alpGetValue($alpShowCustomPostID, $ShowCustomPostID));
   } else {
       $alpShowPostId = null;
   }
   
   function alpGetValue($getedVal, $defValue)
   {
       if (!isset($getedVal)) {
           return $defValue;
       } else {
           return $getedVal;
       }
   }
   
   $radioElements = array(
       array(
           'name'              => 'shareUrlType',
           'value'             => 'activeUrl',
           'additionalHtml'    => '' . '<span>' . 'Use active URL' . '</span></span>
                                   <span class="span-width-static"></span><span class="dashicons dashicons-info scrollingImg sameImageStyle alp-active-url"></span><span class="info-active-url samefontStyle">If this option is active Share URL will be current page URL.</span>'
       ),
       array(
           'name'              => 'shareUrlType',
           'value'             => 'shareUrl',
           'additionalHtml'    => '' . '<span>' . 'Share url' . '</span></span>' . ' <input class="input-width-static alp-active-url" type="text" name="alpShareUrl" value="' . @$alpShareUrl . '">'
       )
   );
   $usersGroup    = array(
       array(
           'name'              => 'loggedin-user',
           'value'             => 'true',
           'additionalHtml'    => '<span class="countries-radio-text allow-countries leftalignment">Logged In</span>'
       ),
       array(
           'name'              => 'loggedin-user',
           'value'             => 'false',
           'additionalHtml'    => '<span class="countries-radio-text">Not Logged In</span>'
       )
   );
   
   function alpCreateRadioElements($radioElements, $checkedValue)
   {
       $content = '';
       for ($i = 0; $i < count($radioElements); $i++) {
           $checked        = '';
           $radioElement   = @$radioElements[$i];
           $name           = @$radioElement['name'];
           $label          = @$radioElement['label'];
           $value          = @$radioElement['value'];
           $additionalHtml = @$radioElement['additionalHtml'];
   
           if ($checkedValue == $value) {
               $checked = 'checked';
           }
           $content .= '<span  class="liquid-width"><input class="radio-btn-fix" type="radio" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" ' . esc_attr($checked) . '>';
           $content .= $additionalHtml . "<br>";
       }
       return $content;
   }
   
   $contentClickOptions = array(
       array(
           "title" => "Close &nbsp;&nbsp;&nbsp; :",
           "value" => "close",
           "info"  => ""
       ),
       array(
           "title" => "Redirect :",
           "value" => "redirect",
           "info"  => ""
       )
   );
   
   $ajax_Nonce       = wp_create_nonce("alpPopupCreatorPageNonce");
   $ajax_NoncePages  = wp_create_nonce("alpPopupCreatorPagesNonce");
   $pagesRadio       = array(
       array(
           "title"     => "Show On All Pages : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
           "value"     => "all",
           "id"        => "select_all_page",
           "class"     => "input_group",
           "checked"   => "checked",
           "info"      => ""
       ),
       array(
           "title"     => "Show On Selected Pages:",
           "value"     => "selected",
           "id"        => "select_custom_page",
           "class"     => "input_group",
           "info"      => ""
       )
   );
   $postsRadio       = array(
       array(
           "title"   => "Show On All Posts: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
           "value"   => "all",
           "id"      => "select_all_post",
           "class"   => "input_group",
           "info"    => ""
       ),
       array(
           "title"  => "Show On Selected Post:",
           "value"  => "selected",
           "id"     => "select_custom_post",
           "class"  => "input_group",
           "info"   => ""
       )
   );
   $customPostsRadio = array(
       array(
           "title" => "show on all custom posts:",
           "value" => "all",
           "info"  => ""
       ),
       array(
           "title" => "show on selected custom post:",
           "value" => "selected",
           "info"  => "",
           "data-attributes" => array(
               "data-name" => 'allCustomPosts',
               "data-popupid" => $dataPopupId,
               "data-loading-number" => 0,
               "data-selectbox-role" => "js-all-custom-posts"
           )
       )
   );
   $responsiveMode   = array(
       array(
           "title" => "Responsive Mode",
           "value" => "responsiveMode",
           "info"  => "",
           
           "data-attributes" => array(
               "id" => "responsiveMode",
               "class" => "js-responsive-mode offset-md-4"
           )
       ),
       array(
           "title" => "Custom Mode",
           "value" => "customMode",
           "info" => "",
           "data-attributes" => array(
               "id" => "customMode",
               "class" => "js-custom-mode"
           )
       )
   );
   function alphacreateRadiobuttons($elements, $name, $newLine, $selectedInput, $class)
   {
       $str = "";
       foreach ($elements as $key => $element) {
           $breakLine  = "";
           $infoIcon   = "";
           $title      = "";
           $value      = "";
           $infoIcon   = "";
           $checked    = "";
           $id         = "";
           $radioclass = "";
           
           if (isset($element["title"])) {
               $title = $element["title"];
           }
           if (isset($element["value"])) {
               $value = $element["value"];
           }
           if (isset($element["id"])) {
               $id = $element["id"];
           }
           if (isset($element["class"])) {
               $radioclass = $element["class"];
           }
           if ($newLine) {
               $breakLine = "<br><br>";
           }
           if (isset($element["info"])) {
               $infoIcon = $element['info'];
           }
           if ($element["value"] == $selectedInput) {
               $checked = "checked";
           }
           $attrStr = '';
           if (isset($element['data-attributes'])) {
               foreach ($element['data-attributes'] as $key => $dataValue) {
                   $attrStr .= $key . '="' . $dataValue . '" ';
               }
           }
           
           $str .= "<span class=" . $class . ">" . $element['title'] . "</span>
                   <input type=\"radio\" name=" . $name . " " . $attrStr . "  id=" . $id . " class=" . $radioclass . " value=" . $value . " $checked>" . $infoIcon . $breakLine;
       }
       echo $str;
   }
   
   $alpPopupTheme        = array(
       'theme1.css',
       'theme2.css',
       'theme3.css',
       'theme4.css',
       'theme5.css'
   );
   $alpResponsiveMeasure = array(
       'auto' => 'Auto',
       '10' => '10%',
       '20' => '20%',
       '30' => '30%',
       '40' => '40%',
       '50' => '50%',
       '60' => '60%',
       '70' => '70%',
       '80' => '80%',
       '90' => '90%',
       '100'=> '100%'
   );
   
   function alpCreateSelect($options, $name, $selecteOption){
       $selected = '';
       $str      = "";
       $checked  = "";
       if ($name == 'theme' || $name == 'restrictionAction') {
           
           $popup_style_name = 'popup_theme_name';
           $firstOption      = array_shift($options);
           $i                = 1;
           foreach ($options as $key) {
               $checked = '';               
               if ($key == $selecteOption) {
                   $checked = "checked";
               }
               $i++;
               $str .= "<input type='radio' name=\"$name\" value=\"$key\" $checked class='popup_theme_name' alpPoupNumber=" . $i . " id='theme" . $i . "'>";
               
           }
           if ($checked == '') {
               $checked = "checked";
           }
           $str = "<input type='radio' name=\"$name\" value=\"" . $firstOption . "\" $checked class='popup_theme_name' alpPoupNumber='1' id='theme1'>" . $str;
           return $str;
       } else {
           @$popup_style_name = ($popup_style_name) ? $popup_style_name : '';
           $str .= "<select name=$name class=$popup_style_name input-width-static >";
           foreach ($options as $key => $option) {
               if ($key == $selecteOption) {
                   $selected = "selected";
               } else {
                   $selected = '';
               }
               $str .= "<option value='" . $key . "' " . $selected . "  >$option</potion>";
           }           
           $str .= "</select>";
           return $str;
       }
   }
   
   if (isset($_GET['saved']) && $_GET['saved'] == 1) {
       echo '<div id="default-message" class="updated notice notice-success is-dismissible" ><p>Popup updated successfully.</p></div>';
   }
   if (isset($_GET["titleError"])):
   ?>
<div class="error notice" id="title-error-message">
   <p>Invalid Title</p>
</div>
<?php
   endif;
   ?>
<div class="container">
  <div class="row">
    <form method="POST"  class="col-md-12" action="<?php echo ALPHACONNECT_POPUP_ADMIN_URL;?>admin-post.php">
    <!-- id="formdata" -->
    <?php
        if(function_exists('wp_nonce_field')) {
            wp_nonce_field('alpPopupCreatorSave');
        }
        ?>
    <input type="hidden" name="action" value="popup_save">
    <div class="crud-wrapper">
        <div class="cereate-title-wrapper">
            <div class="alp-title-crud">
                <?php if (isset($id)): ?>
                <h4>EDIT POPUP</h4>
                <?php else: ?>
                <h4>CREATE POPUP</h4>
                <?php endif; ?>
                <?php $pageUrl = AlpConPopupGetData::acpc_getPopupPageUrl(); ?>
            </div>
            <div class="button-wrapper">
                <p class="submit">
                <input type="submit" id="alp-save-button" class="btn btn-primary btn-sm" value="<?php echo 'Save Changes'; ?>"><span></span>
                <?php if( !empty($pageUrl)): ?> 
                <?php endif; ?>
                <?php $RsaStatus = ALPHACONNECTFUNCTION::popupTablesRsaStatus(); if(!$RsaStatus) :?>
                <input class="btn btn-danger crud-to-pro btn-sm" type="button" value="Upgrade to PRO version" onclick="window.open('<?php echo ALPHACONNECT_POPUP_PRO_URL;?>')">
                <div class="clear"></div>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="clear"></div>
        <br>
        <img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/banner.png" class="bannner_img" height="200" alt="Popup Creator">
        <br><br>
        <div class="general-wrapper">
            <div id="titlediv">
                <div id="titlewrap">
                <input id="title" class=" form-control alp-js-popup-title" type="text" name="title" value="<?php echo esc_attr(@$title)?>" spellcheck="true" autocomplete="off" required = "required"  placeholder='Enter title here'>
                </div>
            </div>
                <div class="card">
                    <div class="card-body">
                        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                            <div class="postbox popupCreator_general_postbox alpSameWidthPostBox" style="display: block;">
                            <div class="handlediv generalTitle" title="Click to toggle"><br></div>
                            <h4 class="hndle ui-sortable-handle generalTitle" style="cursor: pointer"><span><b>General</b></span></h4>
                            <div class="generalContent alpSameWidthPostBox">
                                <?php 
                                $types = "alphaconnect-".lcfirst(strtolower($popupType));
                                require_once ("popup_file/".$types.".php");?>
                                <input type="hidden" name="type" value="<?php echo $popupType;?>">
                                <span class="liquid-width" id="theme-span">Popup Style Options:</span>
                                <?php echo alpCreateSelect($alpPopupTheme,'theme',esc_html(@$alpColorboxTheme));?>
                                <img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Choose popup display style" class="info">
                                <div id="theme1Model" class="modal">
                                    <div class="modal-content">
                                        <span class="close mode_close"  data-dismiss="modal">&times;</span>
                                        <p><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/theme1.png" alt="Info" title="Choose popup display style" class="Image_preview"></p>
                                    </div>
                                </div>
                                <div id="theme2Model" class="modal">
                                    <div class="modal-content">
                                        <span class="close mode_close">&times;</span>
                                        <p><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/theme2.png" alt="Info" title="Choose popup display style" class="Image_preview"></p>
                                    </div>
                                </div>
                                <div id="theme3Model" class="modal">
                                    <div class="modal-content">
                                        <span class="close mode_close">&times;</span>
                                        <p><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/theme3.png" alt="Info" title="Choose popup display style" class="Image_preview"></p>
                                    </div>
                                </div>
                                <div id="theme4Model" class="modal">
                                    <div class="modal-content">
                                        <span class="close mode_close">&times;</span>
                                        <p><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/theme4.png" alt="Info" title="Choose popup display style" class="Image_preview"></p>
                                    </div>
                                </div>
                                <div id="theme5Model" class="modal">
                                    <div class="modal-content">
                                        <span class="close mode_close">&times;</span>
                                        <p><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/theme5.png" alt="Info" title="Choose popup display style" class="Image_preview"></p>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="dimentions">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                                <div class="postbox popupCreator_dimention_postbox alpSameWidthPostBox" style="display: block;">
                                    <div class="handlediv dimentionsTitle" title="Click to toggle"><br></div>
                                    <h3 class="hndle ui-sortable-handle dimentionsTitle" style="cursor: pointer"><span><b><h4>Dimensions</h4></b></span></h3>
                                    <div class="dimensionsContent">
                                        <?php alphacreateRadiobuttons($responsiveMode, "popup_dimension_mode", true, esc_html($alpPopupDimensionMode), "liquid-width");?>
                                        <div class="js-accordion-responsiveMode js-radio-accordion alp-accordion-content">
                                            <span class="liquid-width">Responsive Size </span>
                                            <?php echo alpCreateSelect($alpResponsiveMeasure,"popup_responsive_dimension_measure",esc_html(@$alpPopupResponsiveDimensionMeasure));?>
                                        </div>
                                        <div class="js-accordion-customMode js-radio-accordion alp-accordion-content">
                                            <span class="liquid-width">Width </span>
                                            <input class="" type="text" name="width" value="<?php echo esc_attr($alpWidth); ?>"  title="It must be number  + px or %" /><br>
                                            <span class="liquid-width">Height </span>
                                            <input class="" type="text" name="height" value="<?php echo esc_attr($alpHeight);?>"  title="It must be number  + px or %" /><br>
                                        </div>
                                        <span class="liquid-width">Max Width </span>
                                        <input class="" type="text" name="maxWidth" value="<?php echo esc_attr($alpMaxWidth);?>"  title="It must be number  + px or %" /><br>
                                        <span class="liquid-width">Max Height </span>
                                        <input class="" type="text" name="maxHeight" value="<?php echo esc_attr(@$alpMaxHeight);?>"   title="It must be number  + px or %" /><br>										 
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div id="options">
                            <div id="post-body" class="metabox-holder columns-2">
                                <div id="postbox-container-2" class="postbox-container">
                                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                                       <div class="postbox popupCreator_options_postbox alpSameWidthPostBox" style="display: block;">
                                            <div class="handlediv optionsTitle" title="Click to toggle"><br></div>
                                            <h3 class="hndle ui-sortable-handle optionsTitle" style="cursor: pointer"><span><b><h4>Features</h4></b></span></h3>
                                            <br>
                                            <div class="optionsContent">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row form-group">
                                                        <span class="col-md-6">Show Close (X) Button :</span>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="close_button_delay" name="closeButton" <?php echo $alpCloseButton;?>>
                                                            <label class="custom-control-label" for="close_button_delay"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays close button (X) on the pop up." class="info"><br><br><br>
                                                        </div>               
                                                            <!-- <span class="col-md-6">Show Close (X) Button :</span><label class="switch" data-toggle="tooltip" data-placement="right"><input class="input-width-static" id="close_button_delay" type="checkbox" name="closeButton" <?php //echo $alpCloseButton;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays close button (X) on the pop up." class="info"><br><br> -->
                                                            <div class="acordion-main-div-content" id="close_button_dealy_value" class="col-md-6">
                                                                <span class="col-md-6">Close (X) Button Delay :</span>
                                                                <input class="popup-delay delay_button_value" type="number" min="0" name="buttonDelayValue" value="<?php echo esc_attr($alpCloseButtonDelay);?>" title="Displays close button (X)  after the specified time. Close button will be displayed by default."/>
                                                                <span class="span-percent">after X seconds</span>																										
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <!-- <span class="col-md-6">Show Popup Delay :</span><label class="switch" data-toggle="tooltip" data-placement="right"><input class="input-width-static" id="js-popup-delay" type="checkbox" name="intervel" <?php //echo $alpIntervelPopup; ?> /><span class="slider round"></span></label><img src="<?php // echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays Popup after certain interval." class="info"><br><br>-->
                                                            <span class="col-md-6">Show Popup Delay :</span>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="js-popup-delay" name="intervel" <?php echo $alpIntervelPopup;?>>
                                                                <label class="custom-control-label" for="js-popup-delay"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays Popup after certain interval." class="info"><br><br><br>
                                                            </div>   
                                                            <div class="acordion-main-div-content" id="popup-delay-content" class="col-md-6">
                                                                <span class="col-md-6">Popup Delay Time :</span>
                                                                <input type="number" class="popup-delay-value popup-delay" name="interveltime" title="Popup display delay time in seconds." min="1" value="<?php echo esc_attr($alpIntervelPopupTime); ?>">
                                                                <span class="span-percent">after X seconds</span>											  											
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <!-- <span class="col-md-6">Popup Repetition :</span><label class="switch" data-toggle="tooltip" data-placement="right"><input class="input-width-static " id="js-popup-only-once" type="checkbox" name="repetitivePopup" <?php //echo $alpRepetitivePopup;?> /><span class="slider round"></span></label><img src="<?php// echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Pop up will be repeated after specified interval of time." class="info"><br><br>-->
                                                            <span class="col-md-6">Popup Repetition :</span>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="js-popup-only-once" name="repetitivePopup" <?php echo $alpRepetitivePopup;?>>
                                                                <label class="custom-control-label" for="js-popup-only-once"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Pop up will be repeated after specified interval of time." class="info"><br><br><br>
                                                            </div> 
                                                            <div class="col-md-12" id="js-popup-only-once-content" class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <span class="">Show Popup in Every (secs) </span>
                                                                        <br><br>                                                                
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend btn-number" data-type="minus" data-field="repetitivePopupPeriod">
                                                                                    <span class="input-group-text">-</span>
                                                                                </div>
                                                                                    <input type="text" name="repetitivePopupPeriod" class="form-control input-number" title="Displays the Popup every specified interval." readonly value="<?php echo esc_attr($alpRepetitivePopupPeriod); ?>" min="10" max="100">
                                                                                <div class="input-group-append btn-number" data-type="plus" data-field="repetitivePopupPeriod">
                                                                                    <span class="input-group-text">+</span>
                                                                                </div>
                                                                            </div>                                                                            
                                                                        <br>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                      <span class="">Number of Times </span>
                                                                      <br><br>                                                                
                                                                        <div class="input-group col-sm-5">
                                                                            <input type="number" class="form-control numberoftimes" name="intervelshowcount"  title="Number of time a Popup is displayed during the session." min="2" value="<?php echo esc_attr($alpIntervelPopupShow); ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>                                                                        
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                          <!-- <span class="col-md-6">Enable Repositioning :</span><label class="switch" data-toggle="tooltip" data-placement="right"><input class="input-width-static" type="checkbox" name="reposition" <?php// echo $alpReposition;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Popup is re-positioned automatically when the web page is being resized." class="info"> -->
                                                          <span class="col-md-6">Enable Repositioning :</span>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="reposition" name="reposition" <?php echo $alpReposition;?> >
                                                                <label class="custom-control-label" for="reposition"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Popup is re-positioned automatically when the web page is being resized." class="info"><br><br><br>
                                                            </div> 
                                                        </div>
                                                        <div class="row form-group">
                                                        <!-- <span class="col-md-6">Enable Content Scrolling :</span><label class="switch" data-toggle="tooltip" data-placement="right"><input class="input-width-static"id="contentScrolling" type="checkbox" name="scrolling" <?php //echo $alpScrolling;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Popup will display scroll bar if the content is larger than the specified dimensions." class="info"> -->
                                                        <span class="col-md-6">Enable Content Scrolling :</span>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="contentScrolling" name="scrolling" <?php echo $alpScrolling;?> >
                                                                <label class="custom-control-label" for="contentScrolling"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Popup will display scroll bar if the content is larger than the specified dimensions." class="info"><br><br><br>
                                                            </div> 
                                                        </div>
                                                        <div class="row form-group">
                                                            <!-- <span class="col-md-6">Disable Page Scrolling :</span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static" id="DisableScrolling" type="checkbox" name="disable-page-scrolling" <?php //echo $alpDisablePageScrolling;?> /><span class="slider round"></span></label><img src="<?php // echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Web page scrolling will be disabled while the Popup is displayed." class="info"> -->
                                                            <span class="col-md-6">Disable Page Scrolling :</span>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="DisableScrolling" name="disable-page-scrolling" <?php echo $alpDisablePageScrolling;?> >
                                                                <label class="custom-control-label" for="DisableScrolling"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Web page scrolling will be disabled while the Popup is displayed." class="info"><br><br><br>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="row form-group">
                                                            <!-- <span class="col-md-8">Enable window scaling :</span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static" type="checkbox" name="scaling" <?php //echo $alpScaling;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Resize Popup automatically based on the screen size." class="info"> -->
                                                            <span class="col-md-8">Enable window scaling :</span>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="scaling" name="scaling" <?php echo $alpScaling;?>  >
                                                                <label class="custom-control-label" for="scaling"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Resize Popup automatically based on the screen size." class="info"><br><br><br>
                                                            </div> 
                                                        </div>
                                                        <div class="row form-group">
                                                            <span class="col-md-8">Popup Overlay Colour :</span><span><input  class="alpOverlayColor" id="alpOverlayColor" type="color" name="alpOverlayColor" value="<?php echo esc_attr(@$alpOverlayColor); ?>" placeholder="#fff" /></span><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Select the overlay colour for Popup." class="info" style="margin-left:8px"><br><br><br>
                                                        </div>
                                                        <div class="row form-group">
                                                            <input type="hidden" class="js-decimal" value="0.7" rel="<?php //echo esc_attr($alpOpacity);?>" name="opacity"/>
                                                            <span class="col-md-8" >Popup Background Colour :</span><span id="alpBackgroundColorSet"><input  class="alpBackgroundColor" type="color" name="alp-content-background-color" value="<?php echo esc_attr(@$alpContentBackgroundColor); ?>" /></span><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Select the background colour for Popup." class="info" style="margin-left:8px"><br><br><br>
                                                        </div>
                                                        <div class="row form-group">
                                                            <!-- <span class="col-md-8">Close Popup on Overlay Click :</span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static" type="checkbox" name="overlayClose" <?php //echo $alpOverlayClose;?>><span class="slider round"></span></label><img src="<?php // echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Closes the popup on click of overlay." class="info"> -->
                                                            <span class="col-md-8">Close Popup on Overlay Click  :</span>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="overlayClose" name="overlayClose" <?php echo $alpOverlayClose;?>  >
                                                                <label class="custom-control-label" for="overlayClose"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Closes the popup on click of overlay." class="info"><br><br><br>
                                                            </div> 
                                                        </div>
                                                        <div class="row form-group">
                                                            <!-- <span class="col-md-8">Close Popup on Content Click :</span><label class="switch" data-toggle="tooltip" data-placement="right"><input class="input-width-static js-checkbox-contnet-click" type="checkbox" name="contentClick" <?php //echo $alpContentClick;?> /><span class="slider round"></span></label><img src="<?php// echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Closes the Popup on click of content." class="info"> -->
                                                            <span class="col-md-8">Close Popup on Content Click :</span>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input js-checkbox-contnet-click" id="contentClick" name="contentClick" <?php echo $alpContentClick;?>  >
                                                                <label class="custom-control-label" for="contentClick"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Closes the Popup on click of content." class="info"><br><br><br>
                                                            </div>                                                              
                                                            <!-- <div class="alp-hide js-content-click-wrraper col-md-12">
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" class="custom-control-input" id="customRadio" name="content-click-behavior" value="close" <?php echo esc_html($alpContentClickBehavior) ?>>
                                                                    <label class="custom-control-label" for="customRadio">Custom radio 1</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" class="custom-control-input" id="customRadio2" name="content-click-behavior" value="redirect" <?php echo esc_html($alpContentClickBehavior)?>>
                                                                    <label class="custom-control-label" for="customRadio2">Custom radio 2</label>
                                                                </div> 
                                                            </div> -->

                                                        <div class="alp-hide alp-full-width acordion-main-div-content js-content-click-wrraper">
                                                            <?php echo alphacreateRadiobuttons($contentClickOptions, "content-click-behavior", true, esc_html($alpContentClickBehavior), "col-md-6"); ?>                                                            
                                                        </div>
                                                        <div class="alp-hide js-readio-buttons-acordion-content alp-full-width acordion-main-div-content"><br>
                                                            <span class="col-md-6">URL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                                                            <input class="urlvalue" type="text" name="click-redirect-to-url" value="<?php echo esc_attr(@$alpClickRedirectToUrl);?>" title="It must be number"/><br><br>
                                                            <!-- <span class="col-md-6">Redirect to New Tab : </span> &nbsp;<label class="switch"><input type="checkbox" name="redirect-to-new-tab" <?php //echo $alpRedirectToNewTab; ?> ><span class="slider round"></span></label> -->
                                                                <div class="row col-md-12">
                                                                    <span class="col-md-6">Redirect to New Tab :</span>
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox" class="custom-control-input" id="redirctnewtab" name="redirect-to-new-tab" <?php echo $alpRedirectToNewTab; ?>  >
                                                                            <label class="custom-control-label" for="redirctnewtab"></label>
                                                                        </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row form-group">
                                                            <!-- <span class="col-md-8">Dismiss on &quot;esc&quot; Key :</span><label class="switch" data-toggle="tooltip" data-placement="right" title="Close the Popup on &quot;esc&quot; key press"><input class="input-width-static" type="checkbox" name="escKey"  <?php // echo $alpEscKey;?>/><span class="slider round"></span></label><img src="<?php // echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Dismiss Popup on press of &quot;esc&quot; key." class="info"> -->
                                                            <span class="col-md-8">Dismiss on &quot;esc&quot; Key :</span>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="escKey"  name="escKey"  <?php echo $alpEscKey;?>  >
                                                                <label class="custom-control-label" for="escKey"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Dismiss Popup on press of &quot;esc&quot; key." class="info"><br><br><br>
                                                            </div> 

                                                        </div>
                                                        <div class="row form-group">
                                                            <!-- <span  class="col-md-8" id="createDescribeFixed">Popup Display Location :</span><label class="switch" data-toggle="tooltip" data-placement="right" title="Change the Popup postition"><input class="input-width-static js-checkbox-acordion" id="PopupPostion"  type="checkbox" name="popupFixed"  <?php // echo $alpPopupFixed;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Display Popup on selected location." class="info"><br><br> -->
                                                            <span class="col-md-8">Popup Display Location :</span>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input js-checkbox-acordion" id="PopupPostion" name="popupFixed"  <?php echo $alpPopupFixed;?>  >
                                                                    <label class="custom-control-label" for="PopupPostion"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Display Popup on selected location." class="info">
                                                                </div>
                                                            <div class="js-popop-fixeds" id="js-popop-fixeds">
                                                                <span class="fix-wrapper-style" >&nbsp;</span>
                                                                <div class="fixed-wrapper">
                                                                <div class="js-fixed-position-style" id="fixed-position1" data-alpvalue="1"></div>
                                                                <div class="js-fixed-position-style" id="fixed-position2" data-alpvalue="2"></div>
                                                                <div class="js-fixed-position-style" id="fixed-position3" data-alpvalue="3"></div>
                                                                <div class="js-fixed-position-style" id="fixed-position4" data-alpvalue="4"></div>
                                                                <div class="js-fixed-position-style" id="fixed-position5" data-alpvalue="5"></div>
                                                                <div class="js-fixed-position-style" id="fixed-position6" data-alpvalue="6"></div>
                                                                <div class="js-fixed-position-style" id="fixed-position7" data-alpvalue="7"></div>
                                                                <div class="js-fixed-position-style" id="fixed-position8" data-alpvalue="8"></div>
                                                                <div class="js-fixed-position-style" id="fixed-position9" data-alpvalue="9"></div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="fixedPostion" class="js-fixed-postion" value="<?php echo esc_attr(@$alpFixedPostion);?>">
                                                    </div>
                                                </div>
                                            </div>                                                
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card">
                    <div class="card-body">
                        <?php
                         $RsaStatus = ALPHACONNECTFUNCTION::popupTablesRsaStatus();
                        if(!empty($RsaStatus)) : require_once ("popup_file/alphaconnect-pro.php"); ?>
                        <?php else: ?>
                        <div class="pro-options" onclick="window.open('https://alphaconnectgroup.com/products/')"></div>
                        <?php endif; ?>	
                    </div>
                </div>


            <?php
                $isActivePopupCreator = AlpConPopupGetData::acpc_isActivePopupCreator(@$id);
                if(!@$id) $isActivePopupCreator = 'checked';
                ?>
            <input class="hide-element" name="isActivePopupStatus" data-switch-id="'. $id . '" type="checkbox" <?php echo $isActivePopupCreator; ?> >
            <input type="hidden" class="button-primary" value="<?php echo esc_attr(@$id);?>" name="hidden_popup_number" />
        </div>
    </div>
    </form>
  </div>
</div>