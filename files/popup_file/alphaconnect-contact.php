<?php 
/* ===================================
* Name         : Popup Creator
* Modified Date: 27 June 2019
* File         : alphaconnect-contact.php
* ===================================== */
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

   $contents = @$alpContactForms;
   if($contents == ''){
   $alpfirstnameBorderColor="";
   $alpfirstnameFontColor ="";
   
   $alplastnameBorderColor="";
   $alplastnameFontColor ="";
   
   $alpmobileBorderColor="";
   $alpmobileFontColor ="";
   
   $alpemailBorderColor="";
   $alpemailFontColor ="";
   
   $alpsubjectBorderColor="";
   $alpsubjectFontColor ="";
   
   $alpmessageBorderColor="";
   $alpmessageFontColor ="";
   
   $alpaddressBorderColor="";
   $alpaddressFontColor ="";
   
   }?>
<div class="alp-wp-editor-container">
   <div class="html-uploader-wrapper">
   <div class="form-group row">
      <div class="col-md-6">
         <div class="form-group row">
            <label class="col-sm-4 col-form-label">First Name :</label>
            <div class="col-sm-8">
               <label class="switch"><input class="input-width-static" type="checkbox" name="FirstName" <?php echo esc_attr($alpfirstname);?> checked="checked" onclick="return false;" /><span class="slider round" id="FirstNameHover"></span></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/setting.png" alt="Settings"  data-toggle="modal" data-target="#FirstNameSettings" title="FirstName  Filed Settings" class="info">
            </div>
         </div>
         <div class="form-group row">
            <label  class="col-sm-4 col-form-label">Last Name :</label>
            <div class="col-sm-8">
               <label class="switch"><input class="input-width-static" type="checkbox" name="LastName" <?php echo esc_attr($alplastname);?> /><span class="slider round"></span></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/setting.png" alt="Settings"  data-toggle="modal" data-target="#LastNameSettings" title="Last Name Settings" class="info">
            </div>
         </div>
         <div class="form-group row">
            <label  class="col-sm-4 col-form-label">E-Mail :</label>
            <div class="col-sm-8">
               <label class="switch"><input class="input-width-static" type="checkbox" name="Email" <?php echo esc_attr($alpemail);?> checked="checked" onclick="return false;"/><span class="slider round"></span></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/setting.png" alt="Settings"  data-toggle="modal" data-target="#EmailSettings" title="Email Filed Settings" class="info">
            </div>
         </div>
         <div class="form-group row">
            <label  class="col-sm-4 col-form-label">Telephone : </label>
            <div class="col-sm-8">
               <label class="switch"><input class="input-width-static" type="checkbox" name="Mobile"  <?php echo esc_attr($alpmobile);?> /><span class="slider round"></span></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/setting.png" alt="Settings"  data-toggle="modal" data-target="#MobileSettings" title="Email Filed Settings" class="info">
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group row">
            <label  class="col-sm-4 col-form-label">Subject : </label>
            <div class="col-sm-8">
               <label class="switch"><input class="input-width-static" type="checkbox" name="Subject" <?php echo esc_attr($alpsubject);?> /><span class="slider round"></span></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/setting.png" alt="Settings"  data-toggle="modal" data-target="#SubjectSettings" title="Email Filed Settings" class="info">
            </div>
         </div>
         <div class="form-group row">
            <label  class="col-sm-4 col-form-label">Message : </label>
            <div class="col-sm-8">
               <label class="switch"><input class="input-width-static" type="checkbox" name="Message" <?php echo esc_attr($alpmessage);?> /><span class="slider round"></span></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/setting.png" alt="Settings"  data-toggle="modal" data-target="#MessageSettings" title="Email Filed Settings" class="info">
            </div>
         </div>
         <div class="form-group row">
            <label  class="col-sm-4 col-form-label">Address : </label>
            <div class="col-sm-8">
               <label class="switch"><input class="input-width-static" type="checkbox" name="Address" <?php echo esc_attr($alpaddress);?> /><span class="slider round"></span></label><img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/setting.png" alt="Settings"  data-toggle="modal" data-target="#AddressSettings" title="Email Filed Settings" class="info">
            </div>
         </div>
      </div>
   </div> 
   </div>
</div>
<!-- Contact Firstname Settings -->
<div class="modal" id="FirstNameSettings" role="dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="btn btn-primary" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">First Name  Settings</h4>
      </div>
      <div class="modal-body">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Lable : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="firstnameLable"  value="<?php echo esc_attr($alpfirstnameLable);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Placeholder : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="firstnamePlaceholder" placeholder="Enter placeholder details" value="<?php echo esc_attr($alpfirstnamePlaceholder);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Border : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="firstnameBorder" placeholder="1px" value="<?php echo esc_attr($alpfirstnameBorder);?>">
            </div>
            <div class="col-sm-3">
               <select class="form-control" name="firstnameBorderType">
                  <option value="<?php echo esc_attr($alpfirstnameBorderType);?>"><?php echo esc_attr($alpfirstnameBorderType);?></option>
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
               <input class="form-check-input" type="color" name="firstnameBorderColor" value="<?php echo esc_attr($alpfirstnameBorderColor);?>">
            </div>
         </div>
         <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Required : </label>
            <div class="col-sm-3">
               <input class="form-check-input" type="radio" name="firstnameRequired" value=required <?php if($alpfirstnameRequired =="required") echo "checked"?>> Yes 
               <input class="form-check-input" type="radio" name="firstnameRequired" value=no <?php if($alpfirstnameRequired =="no") echo "checked"?>> No 
            </div>
            <label for="inputEmail3" class="col-form-label">Background Color : </label>				
            <div class="col-sm-2 offset-sm-1">
               <input class="form-check-input" type="color" name="firstnameBgcolour" value="<?php echo esc_attr($alpfirstnameBgcolour);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Font Size : </label>
            <div class="col-sm-4">
               <input class="form-control" name="firstnameFontSize" value="<?php echo esc_attr($alpfirstnameFontSize);?>">							
            </div>
            <label for="inputEmail3" class="col-form-label">Font Color : </label>
            <div class="col-sm-2 offset-sm-1">
               <input class="form-check-input" type="color" name="firstnameFontColor" value="<?php echo esc_attr($alpfirstnameFontColor);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Text Alignment:</label>
            <div class="col-sm-9">
               <select class="form-control" name="firstnameAlignment">
                  <option value="<?php echo esc_attr($alpfirstnameAlignment);?>" ><?php echo esc_attr($alpfirstnameAlignment);?></option>
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
<!-- Contact Lastname Settings -->
<div class="modal" id="LastNameSettings" role="dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="btn btn-primary" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Last Name Settings</h4>
      </div>
      <div class="modal-body">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Lable : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="lastnameLable"  value="<?php echo esc_attr($alplastnameLable);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Placeholder : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="lastnamePlaceholder" placeholder="Enter placeholder details" value="<?php echo esc_attr($alplastnamePlaceholder);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Border : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="lastnameBorder" placeholder="1px" value="<?php echo esc_attr($alplastnameBorder);?>">
            </div>
            <div class="col-sm-3">
               <select class="form-control" name="lastnameBorderType">
                  <option value="<?php echo esc_attr($alplastnameBorderType);?>"><?php echo esc_attr($alplastnameBorderType);?></option>
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
               <input class="form-check-input" type="color" name="lastnameBorderColor" value="<?php echo esc_attr($alplastnameBorderColor);?>">
            </div>
         </div>
         <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Required : </label>
            <div class="col-sm-3">
               <input class="form-check-input" type="radio" name="lastnameRequired" value=required <?php if($alplastnameRequired =="required") echo "checked"?>> Yes 
               <input class="form-check-input" type="radio" name="lastnameRequired" value=no <?php if($alplastnameRequired =="no") echo "checked"?>> No 
            </div>
            <label for="inputEmail3" class="col-form-label">Background Color : </label>				
            <div class="col-sm-2 offset-sm-1">
               <input class="form-check-input" type="color" name="lastnameBgcolour" value="<?php echo esc_attr($alplastnameBgcolour);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Font Size : </label>
            <div class="col-sm-4">
               <input class="form-control" name="lastnameFontSize" value="<?php echo esc_attr($alplastnameFontSize);?>">							
            </div>
            <label for="inputEmail3" class="col-form-label">Font Color : </label>
            <div class="col-sm-2 offset-sm-1">
               <input class="form-check-input" type="color" name="lastnameFontColor" value="<?php echo esc_attr($alplastnameFontColor);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Text Alignment:</label>
            <div class="col-sm-9">
               <select class="form-control" name="lastnameAlignment">
                  <option value="<?php echo esc_attr($alplastnameAlignment);?>" ><?php echo esc_attr($alplastnameAlignment);?></option>
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
<!-- Contact Mobile Settings -->
<div class="modal" id="MobileSettings" role="dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="btn btn-primary" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Telephone Settings</h4>
      </div>
      <div class="modal-body">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Lable : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="mobileLable"  value="<?php echo esc_attr($alpmobileLable);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Placeholder : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="mobilePlaceholder" placeholder="Enter placeholder details" value="<?php echo esc_attr($alpmobilePlaceholder);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Border : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="mobileBorder" placeholder="1px" value="<?php echo esc_attr($alpmobileBorder);?>">
            </div>
            <div class="col-sm-3">
               <select class="form-control" name="mobileBorderType">
                  <option value="<?php echo esc_attr($alpmobileBorderType);?>"><?php echo esc_attr($alpmobileBorderType);?></option>
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
               <input class="form-check-input" type="color" name="mobileBorderColor" value="<?php echo esc_attr($alpmobileBorderColor);?>">
            </div>
         </div>
         <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Required : </label>
            <div class="col-sm-3">
               <input class="form-check-input" type="radio" name="mobileRequired" value=required <?php if($alpmobileRequired =="required") echo "checked"?>> Yes 
               <input class="form-check-input" type="radio" name="mobileRequired" value=no <?php if($alpmobileRequired =="no") echo "checked"?>> No 
            </div>
            <label for="inputEmail3" class="col-form-label">Background Color : </label>
            <div class="col-sm-2 offset-sm-1">
               <input class="form-check-input" type="color" name="mobileBgcolour" value="<?php echo esc_attr($alpmobileBgcolour);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Font Size : </label>
            <div class="col-sm-4">
               <input class="form-control" name="mobileFontSize" value="<?php echo esc_attr($alpmobileFontSize);?>">							
            </div>
            <label for="inputEmail3" class="col-form-label">Font Color : </label>
            <div class="col-sm-1 offset-sm-1">
               <input class="form-check-input" type="color" name="mobileFontColor" value="<?php echo esc_attr($alpmobileFontColor);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Text Alignment:</label>
            <div class="col-sm-9">
               <select class="form-control" name="mobileAlignment">
                  <option value="<?php echo esc_attr($alpmobileAlignment);?>" ><?php echo esc_attr($alpmobileAlignment);?></option>
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
<!-- Contact Email Settings -->
<div class="modal" id="EmailSettings" role="dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="btn btn-primary" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Email Settings</h4>
      </div>
      <div class="modal-body">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Lable : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="emailLable"  value="<?php echo esc_attr($alpemailLable);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Placeholder : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="emailPlaceholder" placeholder="Enter placeholder details" value="<?php echo esc_attr($alpemailPlaceholder);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Border : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="emailBorder" placeholder="1px" value="<?php echo esc_attr($alpemailBorder);?>">
            </div>
            <div class="col-sm-3">
               <select class="form-control" name="emailBorderType">
                  <option value="<?php echo esc_attr($alpemailBorderType);?>"><?php echo esc_attr($alpemailBorderType);?></option>
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
               <input class="form-check-input" type="color" name="emailBorderColor" value="<?php echo esc_attr($alpemailBorderColor);?>">
            </div>
         </div>
         <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Required : </label>
            <div class="col-sm-3">
               <input class="form-check-input" type="radio" name="emailRequired" value=required <?php if($alpemailRequired =="required") echo "checked"?>> Yes 
               <input class="form-check-input" type="radio" name="emailRequired" value=no <?php if($alpemailRequired =="no") echo "checked"?>> No 
            </div>
            <label for="inputEmail3" class="col-form-label">Background Color : </label>				
            <div class="col-sm-1 offset-sm-1">
               <input class="form-check-input" type="color" name="emailBgcolour" value="<?php echo esc_attr($alpemailBgcolour);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Font Size : </label>
            <div class="col-sm-4">
               <input class="form-control" name="emailFontSize" value="<?php echo esc_attr($alpemailFontSize);?>">							
            </div>
            <label for="inputEmail3" class="col-form-label">Font Color : </label>
            <div class="col-sm-1 offset-sm-1">
               <input class="form-check-input" type="color" name="emailFontColor" value="<?php echo esc_attr($alpemailFontColor);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Text Alignment:</label>
            <div class="col-sm-9">
               <select class="form-control" name="emailAlignment">
                  <option value="<?php echo esc_attr($alpemailAlignment);?>" ><?php echo esc_attr($alpemailAlignment);?></option>
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
<!-- Contact Subject Settings -->
<div class="modal" id="SubjectSettings" role="dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="btn btn-primary" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Subject Settings</h4>
      </div>
      <div class="modal-body">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Lable : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="subjectLable"  value="<?php echo esc_attr($alpsubjectLable);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Placeholder : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="subjectPlaceholder" placeholder="Enter placeholder details" value="<?php echo esc_attr($alpsubjectPlaceholder);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Border : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="subjectBorder" placeholder="1px" value="<?php echo esc_attr($alpsubjectBorder);?>">
            </div>
            <div class="col-sm-3">
               <select class="form-control" name="subjectBorderType">
                  <option value="<?php echo esc_attr($alpsubjectBorderType);?>"><?php echo esc_attr($alpsubjectBorderType);?></option>
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
               <input class="form-check-input" type="color" name="subjectBorderColor" value="<?php echo esc_attr($alpsubjectBorderColor);?>">
            </div>
         </div>
         <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Required : </label>
            <div class="col-sm-3">
               <input class="form-check-input" type="radio" name="subjectRequired" value=required <?php if($alpsubjectRequired =="required") echo "checked"?>> Yes 
               <input class="form-check-input" type="radio" name="subjectRequired" value=no <?php if($alpsubjectRequired =="no") echo "checked"?>> No 
            </div>
            <label for="inputEmail3" class="col-form-label">Background Color : </label>				
            <div class="col-sm-2 offset-sm-1">
               <input class="form-check-input" type="color" name="subjectBgcolour" value="<?php echo esc_attr($alpsubjectBgcolour);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Font Size : </label>
            <div class="col-sm-4">
               <input class="form-control" name="subjectFontSize" value="<?php echo esc_attr($alpsubjectFontSize);?>">							
            </div>
            <label for="inputEmail3" class="col-form-label">Font Color : </label>
            <div class="col-sm-1 offset-1">
               <input class="form-check-input" type="color" name="subjectFontColor" value="<?php echo esc_attr($alpsubjectFontColor);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Text Alignment:</label>
            <div class="col-sm-9">
               <select class="form-control" name="subjectAlignment">
                  <option value="<?php echo esc_attr($alpsubjectAlignment);?>" ><?php echo esc_attr($alpsubjectAlignment);?></option>
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
<!-- Contact Message Settings -->
<div class="modal" id="MessageSettings" role="dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="btn btn-primary" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Message  Settings</h4>
      </div>
      <div class="modal-body">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Lable : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="messageLable"  value="<?php echo esc_attr($alpmessageLable);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Placeholder : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="messagePlaceholder" placeholder="Enter placeholder details" value="<?php echo esc_attr($alpmessagePlaceholder);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Border : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="messageBorder" placeholder="1px" value="<?php echo esc_attr($alpmessageBorder);?>">
            </div>
            <div class="col-sm-3">
               <select class="form-control" name="messageBorderType">
                  <option value="<?php echo esc_attr($alpmessageBorderType);?>"><?php echo esc_attr($alpmessageBorderType);?></option>
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
               <input class="form-check-input" type="color" name="messageBorderColor" value="<?php echo esc_attr($alpmessageBorderColor);?>">
            </div>
         </div>
         <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Required : </label>
            <div class="col-sm-3">
               <input class="form-check-input" type="radio" name="messageRequired" value=required <?php if($alpmessageRequired =="required") echo "checked"?>> Yes 
               <input class="form-check-input" type="radio" name="messageRequired" value=no <?php if($alpmessageRequired =="no") echo "checked"?>> No 
            </div>
            <label for="inputEmail3" class="col-form-label">Background Color : </label>				
            <div class="col-sm-1 offset-sm-1">
               <input class="form-check-input" type="color" name="messageBgcolour" value="<?php echo esc_attr($alpmessageBgcolour);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Font Size : </label>
            <div class="col-sm-4">
               <input class="form-control" name="messageFontSize" value="<?php echo esc_attr($alpmessageFontSize);?>">							
            </div>
            <label for="inputEmail3" class="col-form-label">Font Color : </label>
            <div class="col-sm-1 offset-sm-1">
               <input class="form-check-input" type="color" name="messageFontColor" value="<?php echo esc_attr($alpmessageFontColor);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Text Alignment:</label>
            <div class="col-sm-9">
               <select class="form-control" name="messageAlignment">
                  <option value="<?php echo esc_attr($alpmessageAlignment);?>" ><?php echo esc_attr($alpmessageAlignment);?></option>
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
<!-- Contact Address Settings -->
<div class="modal" id="AddressSettings" role="dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="btn btn-primary" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Address Settings</h4>
      </div>
      <div class="modal-body">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Lable : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="addressLable"  value="<?php echo esc_attr($alpaddressLable);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Placeholder : </label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="addressPlaceholder" placeholder="Enter placeholder details" value="<?php echo esc_attr($alpaddressPlaceholder);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Border : </label>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="addressBorder" placeholder="1px" value="<?php echo esc_attr($alpaddressBorder);?>">
            </div>
            <div class="col-sm-3">
               <select class="form-control" name="addressBorderType">
                  <option value="<?php echo esc_attr($alpaddressBorderType);?>"><?php echo esc_attr($alpaddressBorderType);?></option>
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
               <input class="form-check-input" type="color" name="addressBorderColor" value="<?php echo esc_attr($alpaddressBorderColor);?>">
            </div>
         </div>
         <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Required : </label>
            <div class="col-sm-3">
               <input class="form-check-input" type="radio" name="addressRequired" value=required <?php if($alpaddressRequired =="required") echo "checked"?>> Yes 
               <input class="form-check-input" type="radio" name="addressRequired" value=no <?php if($alpaddressRequired =="no") echo "checked"?>> No 
            </div>
            <label for="inputEmail3" class="col-form-label">Background Color : </label>				
            <div class="col-sm-1 offset-sm-1">
               <input class="form-check-input" type="color" name="addressBgcolour" value="<?php echo esc_attr($alpaddressBgcolour);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Font Size : </label>
            <div class="col-sm-4">
               <input class="form-control" name="addressFontSize" value="<?php echo esc_attr($alpaddressFontSize);?>">							
            </div>
            <label for="inputEmail3" class="col-form-label">Font Color : </label>
            <div class="col-sm-1 offset-sm-1">
               <input class="form-check-input" type="color" name="addressFontColor" value="<?php echo esc_attr($alpaddressFontColor);?>">
            </div>
         </div>
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Text Alignment:</label>
            <div class="col-sm-9">
               <select class="form-control" name="addressAlignment">
                  <option value="<?php echo esc_attr($alpaddressAlignment);?>" ><?php echo esc_attr($alpaddressAlignment);?></option>
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