<?php
/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File          : alphaconnect-contactdetails.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once (ALPHACONNECT_POPUP_CLASS.'/DataTable/alphaconnect-contacttable.php');
	$pagenum = isset($_GET['pn']) ? (int) $_GET['pn'] : 1;
	$limit = ALPHACONNECT_POPUP_TABLE_LIMIT;
	$offset = ($pagenum - 1) * $limit;
	$table_total = ALPHACONNECTPOPUPCREATOR::acpc_getTotalRowCount();
	$total = esc_html( $table_total );
	$num_of_pages = ceil(esc_html($total) / $limit);
	if ($pagenum>$num_of_pages || $pagenum < 1) {
		$offset = 0;
		$pagenum = 1;
	}
	$orderBy = 'id DESC';
	$entries = ALPHACONNECTPOPUPCREATOR::findAll($orderBy,$limit,$offset);
    ?>
    <div class="wrap">
	<div class="headers-wrapper">
    <h4>CONTACT DEATILS</h4>	
	</div>
	<img src="<?php echo ALPHACONNECT_POPUP_IMG ?>/banner.png" class="bannner_img" height="200" alt="Popup Creator">
	<br><br>
	<br>
	<?php
		$table = new ALPHACONNECTCONTACT();
		echo $table;

	$pageLinks = paginate_links(array(
		'base' => add_query_arg('pn', '%#%'),
		'format' => '',
		'prev_text' => __('&laquo;', 'aag'),
		'next_text' => __('&raquo;', 'aag'),
		'total' => $num_of_pages,
		'current' => $pagenum
	));
	if ($pageLinks) {
		echo '<div class="tablenav"><div class="tablenav-pages">' . $pageLinks . '</div></div>';
	}