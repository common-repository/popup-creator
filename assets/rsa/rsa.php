<?php
if (!defined('ABSPATH')) { exit(); }

add_action('init', 'acpc_rsa', 9);

function  acpc_rsa(){
  
  global $wpdb;

  if(isset($_REQUEST['encription'])){
    $encrypted_sanitized = $_REQUEST['encription'];
    $encrypted = sanitize_text_field($encrypted_sanitized );
  }
    
$fopen_public = fopen(ALPHACONNECT_POPUP_RSA."/public_key.pem","r");
$public_key = fread($fopen_public,8192);
fclose($fopen_public);

$pkey_public = openssl_pkey_get_public($public_key);

if($encrypted){

  //Decrypt with public key
  openssl_public_decrypt(base64_decode($encrypted), $decrypted, $pkey_public);
  $table_name = $wpdb->prefix . "acpc_settings";
     $wpdb->update( $table_name, array(    
              'accesskey' => md5($decrypted),
              'time'=> current_time('mysql'),
          ), array( 'id' =>1 ));
   }
   if($table_name){
    wp_redirect(ALPHACONNECT_POPUP_ADMIN_URL."admin.php?page=settings_popup&saved=1");
   }
}
?>