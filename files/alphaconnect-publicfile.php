<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-publicfile.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; 

        /************************************    
           Load Frontend Script And Styles 
         ************************************/
function AlphaConnectMyScript(){

    // wp_register_style('alphaconnect_animate', ALPHACONNECT_POPUP_URL . '/assets/style/alphaconnect-animate.css', array(), ALPHACONNECT_POPUP_VERSION);
    // wp_enqueue_style('alphaconnect_animate');  
    wp_register_script('alphaconnect_frontend', ALPHACONNECT_POPUP_URL . '/assets/javascript/alphaconnect-frontend.js', array('jquery'), ALPHACONNECT_POPUP_VERSION);
    wp_enqueue_script('alphaconnect_frontend');
    wp_localize_script('alphaconnect_frontend', 'ALPBParams', AlphaconnectPopupCreatorConfig::getPopupCreatorFrontendScriptLocalizedStoredData());
    wp_enqueue_script('jquery');
    wp_register_script('alphaconnect_colorbox', ALPHACONNECT_POPUP_URL . '/assets/javascript/alphaconnect-colorbox.js', array('jquery'), ALPHACONNECT_POPUP_VERSION);
    wp_enqueue_script('alphaconnect_colorbox');

    /* For ajax case */
    if (defined('DOING_AJAX') && DOING_AJAX && !is_admin()) {
        wp_print_scripts('alphaconnect_frontend');
        wp_print_scripts('alphaconnect_colorbox');
       // wp_print_scripts('alphaconnect_animate');
    }
}
add_action('wp_enqueue_scripts', 'AlphaConnectMyScript');



/************************** Theme Script  ***************************/

function alpRenderPopupScript($id){
    wp_register_style('alphaconnect_popuptheme1', ALPHACONNECT_POPUP_URL . "/assets/style/alpcolorbox/theme1.css", array(), ALPHACONNECT_POPUP_VERSION);
    wp_register_style('alphaconnect_popuptheme2', ALPHACONNECT_POPUP_URL . "/assets/style/alpcolorbox/theme2.css", array(), ALPHACONNECT_POPUP_VERSION);
    wp_register_style('alphaconnect_popuptheme3', ALPHACONNECT_POPUP_URL . "/assets/style/alpcolorbox/theme3.css", array(), ALPHACONNECT_POPUP_VERSION);
    wp_register_style('alphaconnect_popuptheme4', ALPHACONNECT_POPUP_URL . "/assets/style/alpcolorbox/theme4.css", array(), ALPHACONNECT_POPUP_VERSION);
    wp_register_style('alphaconnect_popuptheme5', ALPHACONNECT_POPUP_URL . "/assets/style/alpcolorbox/theme5.css", array(), ALPHACONNECT_POPUP_VERSION);
    wp_enqueue_style('alphaconnect_popuptheme1');
    wp_enqueue_style('alphaconnect_popuptheme2');
    wp_enqueue_style('alphaconnect_popuptheme3');
    wp_enqueue_style('alphaconnect_popuptheme4');
    wp_enqueue_style('alphaconnect_popuptheme5');
    alpFindPopupData($id);
}

/************* Get popup data *****************/

function alpFindPopupData($id){
    $obj = ALPHACONNECTPOPUPCREATOR::acpc_findById($id);
    if (!empty($obj)) {
        $content = $obj->acpc_render();
    }
    echo '<script>';
    echo @$content;
    echo '</script>';
}



if (!is_admin()) {

    /****************** auto load function ***********************/
    function alpAutoloadPopup($atts){
        $a = shortcode_atts( array(
            'id' => 'default',
            'event' => 'default',
            'postid' => 'default',
            'value' => 'default',
        ), $atts );
        return alpRenderPopupOpen("{$a['id']};{$a['event']};{$a['postid']};{$a['value']}");
    }
    add_shortCode('popup_creator', 'alpAutoloadPopup');
    
    /****************  Id based on script load in function themes **************************/
    function alpRenderPopupOpen($getpopupid){
        global $post;
        $thePostID        = $post->ID;
        $PopupByComma     = explode(';', $getpopupid, 4);
        $Popup_Id         = $PopupByComma[0];
        $PopUpEvents      = $PopupByComma[1];
        $PopUpPostId      = $PopupByComma[2];
        $PopUpEventValues = $PopupByComma[3];

        if ($PopUpEvents == 'onload' && $thePostID == $PopUpPostId) {

            /*********** Onload Events ************/ 
            echo "<script type=\"text/javascript\">
            alpAddEvent(window, 'load',function() {
            var alpPoupFrontendObj = new ALPHACONNECTPOPUPCREATOR();
            alpPoupFrontendObj.AlpConnectPopupOpenID($Popup_Id)
        });
        </script>";
        } elseif ($PopUpEvents == 'onclick' && $thePostID == $PopUpPostId) {

             /*********** Onclick Events ************/ 
            echo "<script type=\"text/javascript\">
        jQuery(document).on('click', '$PopUpEventValues', function () {
        var alpPoupFrontendObj = new ALPHACONNECTPOPUPCREATOR();
            alpPoupFrontendObj.AlpConnectPopupOpenID($Popup_Id)
        });
        </script>";
        } elseif ($PopUpEvents == 'onhover' && $thePostID == $PopUpPostId) {

            /*********** Onhover Events ************/ 
            echo "<script type=\"text/javascript\">
        jQuery(document).on('mouseenter','$PopUpEventValues',function() {
        var alpPoupFrontendObj = new ALPHACONNECTPOPUPCREATOR();
            alpPoupFrontendObj.AlpConnectPopupOpenID($Popup_Id)
        });
        </script>";
        }
        alpRenderPopupScript($Popup_Id);
    }
    add_action('wp_enqueue_scripts', 'alpRenderPopupOpen');
}

/*************** onload popup function ****************************/

function alpOnloadPopup()
{
    $page     = get_queried_object_id();
    $postType = get_post_type();
    echo AlphaconnectPopupCreatorConfig::popupJsDataInitValues();
    $popup            = "alp_promotional_popup";
    $Popup_Id          = ALPHACONNECTPOPUPCREATOR::acpc_getPagePopupID($page, $popup);    
        if ($Popup_Id != 0) {
        showPopupInallpages($Popup_Id);
    }
    
    if (!empty($popupsIdByClass)) {
        foreach ($popupsIdByClass as $Popup_Id) {
            alpRenderPopupScript($Popup_Id);
        }
    }
    if ($PopupIDInPageUrl) {
        showPopupInallpages($PopupIDInPageUrl);
    }
    return false;
}

add_action('wp_head', 'alpOnloadPopup');