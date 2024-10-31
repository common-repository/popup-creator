<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			 : alphaconnect-settings.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

   $defaultVaules = AlpConPopupGetData::acpc_getDefaultValues();
   $tableDeleteValue = AlpConPopupGetData::acpc_getValue('tables-delete-status','settings');
   $usrsSelectedRoles = AlpConPopupGetData::acpc_getValue('plugin_users_role', 'settings');
   $alpSelectedTimeZone = AlpConPopupGetData::acpc_getValue('alp-popup-time-zone','settings');
   $tableDeleteSatatus =  AlpConPopupGetData::alpSetChecked($tableDeleteValue);
   
   if (isset($_GET['saved']) && $_GET['saved']==1) {
   	echo '<div id="default-message" class="updated notice notice-success is-dismissible" ><p>Popup updated.</p></div>';
   }

   ?>
<div class="loader"></div>
<h4>POPUP SETTINGS</h4>
<div class="container">
<img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/banner.png" class="bannner_img" height="200" alt="Popup Creator">
  <div class="card">
    <div class="card-header">
      <span>General Settings</span>
    </div>
    <div class="card-body">    
      <form method="POST" action="<?php echo ALPHACONNECT_POPUP_ADMIN_URL;?>admin.php?page=settings_popup" id="alp-settings-form">
         <?php
            if(function_exists('wp_nonce_field')) {
               wp_nonce_field('alpPopupCreatorSettings');
            }?>
         <div class="row">
            <div class="col-md-6">
               <span class="liquid-width"><h5>Delete popup data:</h5></span>
            </div>
            <div class="col-md-6">
               <label class="switch" data-toggle="tooltip" data-placement="right"><input class="input-width-static" id="js-popup-delay" type="checkbox" name="tables-delete-status" <?php echo $tableDeleteSatatus;?> /><span class="slider round"></span></label>
            </div>
            <div class="col-md-6">
                  <span class="liquid-width alp-aligin-with-multiselect"><h5>User role who can use plugin:</h5></span>
            </div>
            <div class="col-md-6">
               <?php echo ALPHACONNECTFUNCTION::createSelectBox($defaultVaules['usersRoleList'], @$usrsSelectedRoles, array("name"=>"plugin_users_role[]","multiple"=>"multiple","class"=>"form-control")); ?>
            </div>
         </div>
         <div class="setting-submit-wrraper">
            <input type="submit" class="btn btn-primary" value="<?php echo 'Save Changes'; ?>">
         </div>
      </form>
    </div> 
  </div>

   <form method="POST" action="<?php echo ALPHACONNECT_POPUP_MAIL ?>" id="alp-settings-form">
      <div class="card" style="width: 18rem;">
         <div class="card-body">
            <h5 class="card-title">Pro Features</h5>
            <p class="card-text">If you buying pro features please enter access key.</p>
            <div class="row">
               <div class="col-md-10">
                  <input type="text" class="form-control" name="encription" placeholder="Please Enter Access Code">
               </div>
               <div class="col-md-2">
                  <input type="submit" class="btn btn-primary" value="Submit">
               </div>
            </div>
         </div>
      </div>
   </form>
   
</div>  