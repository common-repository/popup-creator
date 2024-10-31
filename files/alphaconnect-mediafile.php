<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-mediafile.php
*  =================================== */
 if ( ! defined( 'ABSPATH' ) ) exit;

 /************** Add Shortcode Wordpress old version **************/

function AlpConPopupMediaButton() {
	global $pagenow, $typenows;
	$showCurrentUser = ALPHACONNECTFUNCTION::ShowMenuForCurrentUser();
	if(!$showCurrentUser) {return;}
	$buttonTitle = 'Add Popup';
	$output = '';
	$pages = array(
		'post.php',
		'page.php',
		'post-new.php',
		'post-edit.php',
		'widgets.php'
	);

	$RsaStatus = ALPHACONNECTFUNCTION::popupTablesRsaStatus();
	if($RsaStatus) {
	array_push($pages, "admin.php");
	}
	$checkPage_values = in_array(
		$pagenow,
		$pages
	);
	
	if ($checkPage_values && $typenows != 'download') {
		wp_enqueue_script('jquery-ui-dialog');
		wp_register_style('alp_jQuery_ui', ALPHACONNECT_POPUP_STYLE . "/alphaconnect-customui.css");
		wp_enqueue_style('alp_jQuery_ui');
		wp_register_style('Alp_Con_Bootsrap', ALPHACONNECT_POPUP_STYLE . "/alphaconnect-customstyle.css");
		wp_enqueue_style('Alp_Con_Bootsrap');	
		$img = '<span class="dashicons dashicons-images-alt" id="alp-popup-media-button" style="padding: 3px 2px 0px 0px"></span>';
		$output = '<a href="javascript:void(0);" onclick="jQuery(\'#alpcon-thickbox\').dialog({ width: 450, modal: true, title: \'Insert the shortcode in page\', dialogClass: \'alp-popup-creator\' });"  class="button" title="'.$buttonTitle.'" style="padding-left: .4em;">'. $img.$buttonTitle.'</a>';
	}
	// echo $output;
}
add_action('media_buttons', 'AlpConPopupMediaButton', 11);

function AlpConPopupMediaButtonThickboxs(){
	global $pagenow, $typenows;
	require_once (ABSPATH .'wp-admin/includes/screen.php');
	$currentScreen = get_current_screen();
	$currentPageParams = get_object_vars($currentScreen);

	$showCurrentUser = ALPHACONNECTFUNCTION::ShowMenuForCurrentUser();
	if(!$showCurrentUser) {return;}

	$pages = array(
		'post.php',
		'page.php',
		'post-new.php',
		'post-edit.php',
		'widgets.php'
	);

	$RsaStatus = ALPHACONNECTFUNCTION::popupTablesRsaStatus();
	if($RsaStatus) {
		array_push($pages, "admin.php");
	}
	$checkPage_values = in_array(
		$pagenow,
		$pages );
	if ($checkPage_values && $typenows != 'download') :
		$orderBy = 'id DESC';
	    $allPopups = ALPHACONNECTPOPUPCREATOR::findAll($orderBy);
		?>


		<script type="text/javascript">	
			jQuery(document).ready(function ($) {				
				$('#alp-ptp-popup-insert').on('click', function () {
					var id = $('#alp-insert-popup-id').val();
					if ('' === id) {
						alert('Select your popup');
						return;
					}					
					var appearEvent = jQuery("#selectEvents").val();
					var insertpopupid = jQuery("#alp-insert-popup-id").val();
					var insertelement = jQuery("#elementid").val();
					var insertidvalue = jQuery("#uservalue").val();
						
					var insertpostid = jQuery("#eventpostid").val();
					window.send_to_editor('<span  contenteditable="false"> [alp_con_popup id=' + id + ', events='+appearEvent+';'+insertpostid+'; '+insertelement+';'+insertidvalue+']</span>');
				 
				jQuery('#alpcon-thickbox').dialog( "close" );
				});							
	
			   $("#elementid").on('change click load', function(event){				
				var insertelement = jQuery("#elementid").val();
					if(insertelement == 'selectedByid'){
						jQuery("#id_items").css('display', 'block');					
						jQuery("#classitems").css('display', 'none');
						$ids = new Array();
						jQuery('[id]').each(function() { 
						$ids.push(jQuery(this).attr("id"));						
					   });	
						var option = '<option>Select Id</option>';
						for (var i=0;i<$ids.length;i++){
						option += '<option value="'+ $ids[i] + '"> #'+ $ids[i] + '</option>';
					   }
					  $('#id_items').append(option);					
					  }else if(insertelement == 'selectedByClass'){
						jQuery("#classitems").css('display', 'block');					
						jQuery("#id_items").css('display', 'none');
						$ids = new Array();
						jQuery('[class]').each(function() {
					     	$ids.push(jQuery(this).attr("class")); 						
						 });
						var option = '<option>Select Class</option>';
						for (var i=0;i<$ids.length;i++){
						option += '<option value="'+ $ids[i] + '"> .'+ $ids[i] + '</option>';
					    }
					    $('#classitems').append(option);									
					   }					  
				   });
				});
			</script>
   <div class="row">	
    <div id="alpcon-thickbox" style="display: none;">
		 <div class="alp-hide">
	      <div id="alp-hidden-media-popup" class="alp-wrapper">
		  <form id="myForm" method="post">
		  <?php 
		  if(function_exists('wp_nonce_field')) {
			     wp_nonce_field('alpPopupCreatorUpdate');
				}
				global $post;
				$thePostID = $post->ID;
				?>					      
				 <div class="alp-select-popup form-group">

					<div class="col-sm-4">
					    <h5><strong>Select Popup</strong></h5>
					</div>
					<div class="col-sm-8">
					
					<input type="hidden" id="eventpostid" value="<?php echo $thePostID; ?>">
				
						<select id="alp-insert-popup-id"  class="form-control" name="selectpopupid" style="margin-bottom: 5px;">
							<option value="">Please select...</option>
							<?php foreach ($allPopups as $popup) :								
									if(empty($popup)) {
										continue;
									}
									$popupId = (int)$popup->getId();
									$popupType = $popup->getType();
									$popupTitle = $popup->getTitle();				
									/*Inside popup*/
									if((isset($_GET['id']) && $popupId == (int)@$_GET['id'] || $popupType == 'exitIntent') && $currentPageParams['id'] == 'popup-up-creator_page_popup-edit') {
										continue;
									} ?>						
									<option value="<?php echo $popupId; ?>"><?php echo $popupTitle;?><?php echo " - ".$popupType;?></option>;
								<?php endforeach; ?>
						</select>
					</div>
				 </div>
					<br><br><br>
					<?php 
					   		if($pagenow !== 'admin.php'): ?>
					<div class="alp-select-popup form-group">
						<div class="col-sm-4">
							<h5><strong>Choose Event</strong></h5>
						</div>
						<div class="col-sm-8">
						<select id="selectEvents" name="selectevent"  class="form-control">
							<option value="onload">On load</option>
							<option value="onclick" id="onclick">On Click</option>
							<option value="onhover" id="mousehover">On Hover</option>
						</select>
					  </div>
					</div>
					<br><br>
					<div class="alp-select-popup form-group" id="events">
						<div class="col-sm-4">
						<select class="form-control" id="elementid">
								<option value="">Options</option>
								<option value="selectedByid" >ID</option>
								<option value="selectedByClass">Class</option>
							</select>
						</div>																
						<div class="col-sm-8 " >
							<input type="text" id="uservalue" class="form-control" Placeholder="#YourId or .ClassName or Href">
						</div>
					  <br><br>
					</div>
						<script type="text/javascript">
							jQuery('#selectEvents').on('change', function() {
							var eventValue = this.value;
							if(eventValue == 'onclick' || eventValue == 'onhover'){
								jQuery('#events').css('display', 'inline-block');
							} else {
								jQuery('#events').css('display', 'none');
							}
							});
						</script>
			        	<?php endif;?>
			        	<br>
						<div class="alp-static-padding-top col-sm-offset-3">
							<div class="col-sm-5">
							<a name="submit" href="#" id="alp-ptp-popup-insert" class="btn btn-sm btn-primary alp-insert-popup-js alp-insert-popup-btns">Insert</a>
							</div>
							<div class="col-sm-5">
								<input type="button" id="alp_con_popup_cancel" onclick="jQuery('#alpcon-thickbox').dialog( 'close' )" class="btn btn-sm btn-default alp-close-media-popup-js alp-insert-popup-btns" value="Cancel">
							</div>
						</div>
					 	</div>
					</div>
				</form>
			</div>
		</div>
	</div>
 </div>
	<?php endif;
}
