<?php
/* ===================================
* Name         : Popup Creator
* Modified Date: 27 June 2019
* File         : alphaconnect-subscriber.php
* =====================================*/

 if ( ! defined( 'ABSPATH' ) ) exit;

   $contents = @$alpSubscriberForms;
   
   if($contents == ''){
      $alpsubscribermessage = "";
      $alpbordercolor = "";		
      $alpfontcolor = "";
      $alpbuttonbordercolor = "";		
      $alpbuttonfontcolor = "";
      $alpmyprefix_image_id = "";
   }
   ?>
<div class="alp-wp-editor-container">
   <div class="html-uploader-wrapper">
      <div class="form-group row">
         <label for="staticEmail" class="col-sm-4 col-form-label">Email Text Box</label>
         <div class="col-sm-8">
            <label class="switch"><input class="input-width-static" type="checkbox" id="subscriber" name="subscriberemail" value="on" checked="checked" onclick="return false;" /><span class="slider round" id="FirstNameHover"></span></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/setting.png" alt="Settings"  data-toggle="modal" data-target="#EmailSettings" title="Email Filed Settings" class="info">
         </div>
      </div>
      <div class="form-group row">
         <label for="submitbutton" class="col-sm-4 col-form-label">Submit Button</label>
         <div class="col-sm-8">
            <label class="switch"><input class="input-width-static" type="checkbox" id="subscribersubmit" name="subscribersubmitbutton" value="on" checked="checked" onclick="return false;" /><span class="slider round"></span></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/setting.png" alt="Settings"  data-toggle="modal" data-target="#SubmitButtonSettings" title="Email Filed Settings" class="info">
         </div>
      </div>
  
      <div class="form-group row">
      <div class="col-sm-3">
         <input type='button' class="button-primary" value="<?php esc_attr_e( 'Select Image', 'mytextdomain' ); ?>" id="myprefix_media_manager"/>
         <input type="hidden" name="myprefix_image_id" id="myprefix_image_id" value="<?php echo esc_attr( $myprefix_image_id ); ?>" class="regular-text" />
           <?php echo $image; ?>
           </div>
           <div class="col-sm-9">
           <?php 
           $image_id = get_option( 'myprefix_image_id' );
         if( intval( $image_id ) > 0 ) {
                $image = wp_get_attachment_image( $image_id, 'thumbnail', false, array( 'id' => 'myprefix-preview-image' ) );
            } else {
               $popupidvalue = wp_get_attachment_image_url( $alpmyprefix_image_id, 'thumbnail', false, array( 'id' => 'myprefix-preview-image' ) );
               if ($popupidvalue == ''){

                  $image ?> <img id="myprefix-preview-image" src="<?php echo ALPHACONNECT_POPUP_IMG ?>/wordpress.jpeg"  width="250" height="250" /><?php
                 }else{

              $image ?> <img id="myprefix-preview-image" src="<?php echo $popupidvalue ?>"  width="250" height="250" /><?php
             }
         }
      ?>
         </div>
      </div>

      <div class="form-group row">
         <label for="contenttext" class="col-sm-3 col-form-label">Content Text</label>
         <div class="col-sm-9">
            <textarea class="form-control" id="subscribermessage" name="subscribermessage" placeholder="Enter Message"><?php echo $alpsubscribermessage ?></textarea>
         </div>
      </div>
   </div>
</div>
<!-- subscriber Textbox Settings -->
<div class="modal" id="EmailSettings" role="dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Email Settings</h4>
      </div>
      <div class="modal-body">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Placeholder : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="placeholderfiled" placeholder="Enter placeholder details" value="<?php echo esc_attr($alpplaceholderfiled);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Border : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="bordersize" placeholder="1px" value="<?php echo esc_attr($alpbordersize);?>">
            </div>
            <div class="col-sm-3">
               <select class="form-control" name="bordertype">
                  <option value="<?php echo esc_attr($alpbordertype);?>"><?php echo esc_attr($alpbordertype);?></option>
                  <option value="solid">solid</option>
                  <option value="dotted">dotted</option>
                  <option value="dashed">dashed</option>
                  <option value="groove">groove</option>
                  <option value="ridge">ridge</option>
                  <option value="inset">inset</option>
                  <option value="outset">outset</option>
                  <option value="none">none</option>
                  <option value="hidden">hidden</option>
               </select>
            </div>
            <div class="col-sm-2">
               <input class="form-check-input" type="color" name="bordercolor" value="<?php echo esc_attr($alpbordercolor);?>">
            </div>
         </div>
         <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Required : </label>
            <div class="col-sm-4">
               <input class="form-check-input" type="radio" name="requiredFiled" value=required <?php if($alprequiredFiled =="required") echo "checked"?>> Yes 
               <input class="form-check-input" type="radio" name="requiredFiled" value=no <?php if($alprequiredFiled =="no") echo "checked"?>> No 
            </div>
            <div class="col-sm-5">
               <label for="inputEmail3" class="col-form-label">Background Color : </label>				
               <input class="form-check-input" type="color" name="backgroundfiled" value="<?php echo esc_attr($alpbackgroundfiled);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Font Size : </label>
            <div class="col-sm-4">
               <input class="form-control" name="fontsizefiled" value="<?php echo esc_attr($alpfontsizefiled);?>">							
            </div>
            <div class="col-sm-5">
               <label for="inputEmail3" class="col-form-label">Font Color : </label>
               <input class="form-check-input" type="color" name="fontcolor" value="<?php echo esc_attr($alpfontcolor);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Text Alignment:</label>
            <div class="col-sm-9">
               <select class="form-control" name="fontalignment">
                  <option value="<?php echo esc_attr($alpfontalignment);?>" ><?php echo esc_attr($alpfontalignment);?></option>
                  <option value="left">Left</option>
                  <option value="center">Center</option>
                  <option value="right">Right</option>
               </select>
            </div>
         </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
      </div>
   </div>
</div>
<!-- subscriber submit button  Settings -->
<div class="modal" id="SubmitButtonSettings" role="dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Submit Button Settings</h4>
      </div>
      <div class="modal-body">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Height: </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="buttonhight" placeholder="Enter Your Button Hight" value="<?php echo esc_attr($alpbuttonhight);?>">
            </div>
            <label for="inputEmail3" class="col-sm-3 col-form-label">Width : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="buttonwidth" placeholder="Enter Your Button Width" value="<?php echo esc_attr($alpbuttonwidth);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Button Label : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="buttonlable" placeholder="Enter Your Button Lable" value="<?php echo esc_attr($alpbuttonlable);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Border : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="buttonbordersize" value="<?php echo esc_attr($alpbuttonbordersize);?>">
            </div>
            <div class="col-sm-3">
               <select class="form-control" name="buttonbordertype">
                  <option value="<?php echo esc_attr($alpbuttonbordertype);?>"><?php echo esc_attr($alpbuttonbordertype);?></option>
                  <option value="solid"> solid</option>
                  <option value="dotted">dotted</option>
                  <option value="dashed">dashed</option>
                  <option value="groove">groove</option>
                  <option value="ridge"> ridge</option>
                  <option value="inset"> inset</option>
                  <option value="outset">outset</option>
                  <option value="none">  none</option>
                  <option value="hidden">hidden</option>
               </select>
            </div>
            <div class="col-sm-2">
               <input class="form-check-input" type="color" name="buttonbordercolor" value="<?php echo esc_attr($alpbuttonbordercolor);?>">
            </div>
         </div>
         <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-4 col-form-label">Background Color : </label>									
            <div class="col-sm-5">
               <input class="form-check-input" type="color" name="buttonbackground" value="<?php echo esc_attr($alpbuttonbackground);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Font Size : </label>
            <div class="col-sm-4">
               <input class="form-control" name="buttonfontsize" value="<?php echo esc_attr($alpbuttonfontsize);?>">							
            </div>
            <div class="col-sm-5">
               <label for="inputEmail3" class="col-form-label">Font Color : </label>
               <input class="form-check-input" type="color" name="buttonfontcolor" value="<?php echo esc_attr($alpbuttonfontcolor);?>">
            </div>
         </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
      </div>
   </div>
</div>