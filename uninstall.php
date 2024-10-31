<?php
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

require_once (dirname(__FILE__)."/alphaconnect-config.php");
require_once (ALPHACONNECT_POPUP_CLASS .'/alphaconnect-install.php'); //cretae tables
require_once (ALPHACONNECT_POPUP_FILES .'/alphaconnect-function.php');

$deleteStatus = ALPHACONNECTFUNCTION::popupTablesDeleteSatus();

if($deleteStatus) {
    ALPHACONNECT_INSTALL::acpcuninstall();
}