<?php  
/* ===================================
* Name         : Popup Creator
* Modified Date: 27 June 2019
* File         : alphaconnect-pro.php
* =====================================*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div id="features">
   <div id="post-body" class="metabox-holder columns-2">
      <div id="postbox-container-2 col-md-12" class="postbox-container">
         <div id="normal-sortables" class="meta-box-sortables ui-sortable">
            <div class="postbox popupCreator_features_postbox alpSameWidthPostBox" style="display: block;">
               <div class="handlediv featuresTitle" title="Click to toggle"><br></div>
               <h3 class="hndle ui-sortable-handle featuresTitle" style="cursor: pointer,"><span><b><h4>Pro Features</h4></b></span></h3>
               <div class="featuresContent">
                  <div class="row">
                     <div class="col-md-6">

                     <div class="row form-group">
                  <!-- <span class="col-md-7">Show Popup In Date Range : </span><label class="switch" data-toggle="tooltip" data-placement="right"><input class="input-width-static js-checkbox-acordion js-daterange" type="checkbox" id="Date_Range_Change" name="DateRange" <?php // echo $alpDateRange;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays the Popup between the selected dates." class="info"><br><br> -->
                  <span class="col-md-7">Show Popup In Date Range :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input js-checkbox-acordion js-daterange" id="Date_Range_Change" name="DateRange" <?php echo $DateRange;?>>
                           <label class="custom-control-label" for="Date_Range_Change"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays the Popup between the selected dates." class="info"><br><br><br>
                     </div>   
                  <div class="container acordion-main-div-content js-daterange-wrraper">
                        <!-- <div for="" class=" lineheight">Select Date</div> -->
                        <div class="row form-group" id="popup_date_filed">
                        <div class='col-md-5'>
                           <div class="">
                              <div class='input-group date' id='start_date'>	
                                 <span class="input-group-addon">
                                 <!-- <span class="dashicons dashicons-calendar"></span> -->
                                 </span>	
                                 <input type='text' class="form-control" placeholder="Start Date" id="From_date" name="DaterangeFromDate" value="<?php echo $alpFromDate;?>" /> 
                              </div>
                           </div>
                        </div>
                      <div for=""class="col-md-1 lineheight">to</div>
                        <div class='col-md-5'>
                           <div class="">
                              <div class='input-group date' id='end_date'>	
                                 <span class="input-group-addon">
                                 <!-- <span class="dashicons dashicons-calendar"></span> -->
                                 </span>	
                                 <input type='text' class="form-control" placeholder="End Date" id="To_date" name="DaterangeToDate" value="<?php echo $alpToDate;?>" />        
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  </div>
                  <div class="row form-group">
                     <!-- <span class="col-md-7">Schedule Popup : </span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static js-checkbox-acordion js-schedule" type="checkbox" id="Schedule_PopUp" name="SchedulePopUp" <?php //echo $alpSchedulePopUp;?>  /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Display Popup only on the selected date." class="info"> -->
                     <span class="col-md-7">Schedule Popup :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input js-checkbox-acordion js-schedule" id="Schedule_PopUp" name="SchedulePopUp" <?php echo $alpSchedulePopUp;?>>
                           <label class="custom-control-label" for="Schedule_PopUp"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Display Popup only on the selected date." class="info"><br><br><br>
                     </div> 
                  </div>
                  <div class="container acordion-main-div-content js-schedule-wrraper">
                     <div class="row" id="popup_schedule_date">
                        <div for="" class="col-sm-4 lineheight">Selecte Date :</div>
                        <div class='col-sm-5'>
                           <div class="form-group">
                              <div class='input-group date' id='selectdate'>	
                                 <span class="input-group-addon">
                                 <!-- <span class="dashicons dashicons-calendar-alt"></span> -->
                                 </span>	
                                 <input type='text' class="form-control" placeholder="Select Date" id="select_date" name="SchedulePopUpDate" value="<?php echo $alpScheduleDate; ?>"/>        
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row form-group">
                     <!-- <span class="col-md-7">Disable On Mobile Devices : </span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static" type="checkbox" id="Disable_toggle" name="MobileDisable" <?php //echo $alpMobileDisable;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Do not display Popup on a Mobile device." class="info"> -->
                     <span class="col-md-7">Disable On Mobile Devices :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="Disable_toggle" name="MobileDisable" <?php echo $alpMobileDisable;?>>
                           <label class="custom-control-label" for="Disable_toggle"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Do not display Popup on a Mobile device." class="info"><br><br><br>
                     </div> 
                  </div>
                  <div class="row form-group">
                     <!-- <span class="col-md-7">Show Only on Mobile Devices : </span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static" type="checkbox" id="Enable_toggle" name="MobileOnly" <?php //echo $alpMobileOnly;?> /><span class="slider round"></span></label><img src="<?php // echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Show Popup only on a Mobile device." class="info">		 -->
                     <span class="col-md-7">Show Only On Mobile Devices :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="Enable_toggle" name="MobileOnly" <?php echo $alpMobileOnly;?>>
                           <label class="custom-control-label" for="Enable_toggle"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Show Popup only on a Mobile device." class="info"><br><br><br>
                     </div> 
                  </div>
                  <div class="row form-group">
                     <!-- <span class="col-md-7">Show After Inactivity : </span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static js-checkbox-acordion" type="checkbox" id="inactive" name="Inactivity" <?php// echo $alpInactivity;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Display Popup while user is inactive for specified period." class="info"> -->
                     <span class="col-md-7">Show After Inactivity :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input js-checkbox-acordion" id="inactive" name="Inactivity" <?php echo $alpInactivity;?>>
                           <label class="custom-control-label" for="inactive"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Display Popup while user is inactive for specified period." class="info"><br><br><br>
                     </div> 
                     <div class="js-inactivity acordion-main-div-content">											
                     <span class="col-md-7" >Popup Inactivity Time :</span><input class="popup-inactivity-value improveOptionsstyle popup-delay" id="popup_inactivity" type="number" min="1" name="Inactivitytime" value="<?php echo esc_attr(@$alpInactivitytime);?>"><span class="scroll-percent"> after X seconds</span><br><br>
                  </div>
                  </div>
                  
                  <div class="row form-group">
                      <!-- <span class="col-md-7">Show While Scrolling : </span><label class="switch" data-toggle="tooltip" data-placement="right"><input class="input-width-static js-checkbox-acordion" id="WhileSrolling" type="checkbox" name="WhileScrolling" <?php //echo $alpWhileScrolling;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays Popup while the page is scrolled." class="info"> -->
                      <span class="col-md-7">Show While Scrolling :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input js-checkbox-acordion" id="WhileSrolling" name="WhileScrolling" <?php echo $alpWhileScrolling;?>>
                           <label class="custom-control-label" for="WhileSrolling"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays Popup while the page is scrolled." class="info"><br><br><br>
                     </div> 
                  </div>
               </div>
               <div class="col-md-6">
               <div class="row form-group">
                  <!-- <span class="col-md-7">Show on Selected Pages : </span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static js-on-all-pages" id="SelectePages" type="checkbox" name="SelectePages" <?php// echo @$alpSelectePages;?> /><span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays Popup on all or selected web page's." class="info"><br> -->
                     <span class="col-md-7">Show on Selected Pages :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input js-on-all-pages" id="SelectePages" name="SelectePages" <?php echo $alpSelectePages;?>>
                           <label class="custom-control-label" for="SelectePages"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays Popup on all or selected web page's." class="info"><br><br><br>
                     </div> 
                  <div class="js-all-pages-content acordion-main-div-content col-md-12">
                     <input type="hidden" value="<?php $args = array(														             
                        'post_type' => 'page',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        );
                        	$query = new WP_Query($args);
                        	while ($query->have_posts()) {
                        		$query->the_post();
                        		$alpCustomPostId = get_the_ID();	
                        		$alpPostId = explode(",",$alpCustomPostId);	
                        			foreach ($alpPostId as $key => $value) {
                        			echo "PageId_".$value.",";
                        			} }																									
                        ?>" name="ShowAllPageID">
                     <?php echo alphacreateRadiobuttons($pagesRadio, "OptionsPages", true, esc_html($alpOptionsPages), "radiobuttons"); ?>
                     <div class="row">
                        <div class="alp-hide js-pages-selectbox-content alp-full-width acordion-main-div-content" id="popup_select_page">
                           <!-- <div for="" class="col-md-6">Selected Page</div><br> -->
                           <div class='col-md-6'>
                           <!-- <select  id="multi-select-page" multiple> -->

                              <select id="multi-select-page"  multiple="multiple" value="<?php echo $alpShowPageId;?>" >
                                 <?php																								 	
                                    $args = array(
                                    	'post_type' => 'page',
                                    	'post_status' => 'publish',
                                    	'posts_per_page' => -1,
                                    		);
                                    		$query = new WP_Query($args);
                                    		
                                    		while ($query->have_posts()) {
                                    			$query->the_post();
                                    			$alpCustomPostTitle = the_title ('','',false);
                                    			$alpCustomPostId = get_the_ID();
                                    			$alpPostId = explode(",",$alpCustomPostId);	
                                    			foreach ($alpPostId as $key => $value) {	
                                    			$idvalue = "PageId_".$value;	
                                    	  ?>
                                 <option value="<?php echo $idvalue; ?>"><?php echo $alpCustomPostTitle; ?></option>
                                 <?php
                                    }	
                                      	}																									
                                    ?>		
                              </select>
                              <input type="hidden" id="showcustoid" name="ShowCustomPageID" value="<?php echo $alpShowPageId;?>">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>


               <div class="row form-group">
                  <!-- <span class="col-md-7">Show on Selected Posts : </span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static js-on-all-posts" id="SelectePosts" type="checkbox" name="SelectePosts" <?php // echo $alpSelectePosts;?> /><span class="slider round"></span></label><img src="<?php // echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays Popup on all or selected user post's." class="info"><br> -->
                  <span class="col-md-7">Show on Selected Posts :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input js-on-all-posts" id="SelectePosts" name="SelectePosts" <?php echo $alpSelectePosts;?>>
                           <label class="custom-control-label" for="SelectePosts"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Displays Popup on all or selected user post's." class="info"><br><br><br>
                     </div> 
                  <div class="alp-hide js-all-posts-content acordion-main-div-content col-md-12">
                     <?php echo alphacreateRadiobuttons($postsRadio, "OptionsPosts", true, esc_html($alpOptionsPosts), "radiobuttons"); ?>
                     <input type="hidden" value="				
                        <?php $args = array(
                           'post_type' => 'post',
                           'post_status' => 'publish',
                           'posts_per_page' => -1,
                           );
                           	$query = new WP_Query($args);
                           		while ($query->have_posts()) {
                           			$query->the_post();
                           			$alpCustomPostId = get_the_ID();	
                           		 	$alpPostId = explode(",",$alpCustomPostId);	
                           			foreach ($alpPostId as $key => $value) {
                           			echo "PostId_".$value.",";
                           			}}																																																		
                           			?>" name="ShowAllPostID">
                     <!-- <div class="container"> -->
                        <div class="row" >
                        <div id="popup_select_post" class="alp-hide js-all-custompost-content alp-full-width acordion-main-div-content">
                           <!-- <div for="" class="col-md-6">Selected On Custom Post:</div> -->
                           <div class='col-md-6'>
                           <select  id="multi-select-post" multiple>
                              <!-- <select id="multi-select-post"  multiple="multiple"  value="<?php //echo $alpShowPostID;?>"> -->
                                 <?php																								 	
                                    $args = array(
                                    	'post_type' => 'post',
                                    	'post_status' => 'publish',
                                    	'posts_per_page' => -1,
                                        );
                                    	 $query = new WP_Query($args);
                                    		while ($query->have_posts()) {
                                    			$query->the_post();
                                    			$alpCustomPostTitle = get_the_title	 ('','',false);
                                    			$alpCustomPostId = get_the_ID();
                                    			$alpPostId = explode(",",$alpCustomPostId);	
                                    			foreach ($alpPostId as $key => $value) {	
                                    			$postidvalue = "PostId_".$value;																		
                                    		?>																
                                 <option value="<?php echo $postidvalue; ?>"><?php echo $alpCustomPostTitle; ?></option>
                                 <?php
                                    } }																									
                                    ?>	
                                    
                              </select>
                              <input type="hidden" id="showcustpostid" name="ShowCustomPostID" value="<?php echo $alpShowPostID;?>">															
                           </div>
                        </div>
                     </div>
                  </div>
                  </div>
                  <!--  -->
                  <div class="row form-group">
                     <!-- <span class="col-md-7">Auto Close Popup:</span><label class="switch" data-toggle="tooltip" data-placement="right" ><input id="js-auto-close"  class="input-width-static js-checkbox-acordion" type="checkbox" name="AutoClosePopup" <?php// echo $alpautoClosePopup;?>><span class="slider round"></span></label><img src="<?php// echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Close Popup after the specified period." class="info"> -->
                     <span class="col-md-7">Auto Close Popup :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input js-checkbox-acordion" id="js-auto-close" name="AutoClosePopup" <?php echo $alpautoClosePopup;?>>
                           <label class="custom-control-label" for="js-auto-close"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Close Popup after the specified period." class="info"><br><br><br>
                     </div> 
                     <div class="js-auto-close-content acordion-main-div-content">
                     <!--  -->
                     <span class="col-md-7" >Popup Close</span><input class="popupTimer improveOptionsstyle popup-delay" id="popup_close_time" type="number" min="1" name="PopupClosingTimer" value="<?php echo esc_attr(@$alpPopupClosingTimer);?>"><span class="scroll-percent"> after X seconds</span>
                  </div>
                  </div>
                  
                  <div class="row form-group">
                     <!-- <span class="col-md-7">Disable Popup Overlay : </span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static" type="checkbox" name="DisableOverlay" <?php //echo $alpDisableOverlay;?> /> <span class="slider round"></span></label><img src="<?php //echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Do not display overlay for this Popup." class="info"> -->
                     <span class="col-md-7">Disable Popup Overlay :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="DisableOverlay" name="DisableOverlay" <?php echo $alpDisableOverlay;?>>
                           <label class="custom-control-label" for="DisableOverlay"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Do not display overlay for this Popup." class="info"><br><br><br>
                     </div> 
                  </div>

                  <div class="row form-group">
                     <!-- <span class="col-md-7">Show Popup by User Status : </span><label class="switch" data-toggle="tooltip" data-placement="right" ><input class="input-width-static js-checkbox-acordion js-user-seperator" type="checkbox" name="UserStatus" <?php //echo $alpUserStatus;?> ><span class="slider round"></span></label><img src="<?php// echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Display Popup by user logged in status." class="info"> -->
                     <span class="col-md-7">Show Popup by User Status :</span>
                     <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input js-checkbox-acordion js-user-seperator" id="UserStatus" name="UserStatus" <?php echo $alpUserStatus;?>>
                           <label class="custom-control-label" for="UserStatus"></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/info.png" alt="Info" title="Display Popup by user logged in status." class="info"><br><br><br>
                     </div> 
                  </div>
                  <div class="row form-group">

                     <div class="acordion-main-div-content js-user-seperator-content col-md-7">
                        <?php echo ALPHACONNECTFUNCTION::alpCreateRadioElements($usersGroup, @$alpLogedUser);?>
                     </div>
                  </div>
                     </div>
                  </div>
				
            
               </div>
               <br>
            </div>
         </div>
      </div>
   </div>
</div>