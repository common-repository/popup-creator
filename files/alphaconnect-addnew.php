<?php 
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File          : alphaconnect-addnew.php
*  =================================== */

   /***************************
    * Show The Type Of Popups
    ***************************/
?>
<!-- <div class="loader"></div> -->
<h4>ADD NEW POPUP</h4>
<div class="container">
<img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/banner.png" class="bannner_img" height="200" alt="Popup Creator">
<br><br>
<div class="row">
   <div class ="col-md-3 ">
      <a class="create-popup-link" href="<?php echo ALPHACONNECT_POPUP_ADMIN_URL ?>admin.php?page=popup_edit&type=html">
         <div class ="img_container">
            <img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/html.png"  class="image img-responsive center-block">
            <div class="overlay">
               <div class="image_text">HTML POPUP</div>
            </div>
         </div>
      </a>
   </div>
   <div class ="col-md-3 ">
      <a class="create-popup-link" href="<?php echo ALPHACONNECT_POPUP_ADMIN_URL?>admin.php?page=popup_edit&type=contact">
         <div class ="img_container">
            <img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/contact.png"  class="image img-responsive center-block">
            <div class="overlay">
               <div class="image_text">CONTACT POPUP</div>
            </div>
         </div>
      </a>
   </div>
   <div class ="col-md-3">
      <a class="create-popup-link" href="<?php echo ALPHACONNECT_POPUP_ADMIN_URL?>admin.php?page=popup_edit&type=subscriber">
         <div class ="img_container">
            <img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/sub.png"  class="image img-responsive center-block">
            <div class="overlay">
               <div class="image_text">SUBSCRIPTION POPUP</div>
            </div>
         </div>
      </a>
   </div>

   <div class ="col-md-3">
      <!-- <a class="create-popup-link" href="https://alphaconnectgroup.com/" target="_blank"> -->
         <div class ="img_container">
            <img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/pro.png"  class="image img-responsive center-block">
            <div class="overlay">
               <div class="image_text">PRO FEATURES</div>
            </div>
         </div>
      </a>
   </div>
</div>
<br>