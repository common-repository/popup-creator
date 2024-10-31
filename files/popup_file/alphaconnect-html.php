<?php 
/* ===================================
* Name         : Popup Creator
* Modified Date: 27 June 2019
* File         : alphaconnect-html.php
* ====================================== */
?>
<div class="alp-wp-editor-container">
<?php
 if ( ! defined( 'ABSPATH' ) ) exit; 
	 $contents = @$alpPopupDataHtml;
	 $editor_id = 'alp_popup_html';
	 $settingsdata = array(
		'wpautop' => false,
		'tinymce' => array(
			'width' => '100%'
		),
		'textarea_rows' => '6',
		'media_buttons' => true
	);

	wp_editor($contents, $editor_id, $settingsdata);
?>
</div>