<?php
/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: alphaconnect-table.php
*  =================================== */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once (dirname(__FILE__).'/alphaconnect-tablelist.php');

class ALPHACONNECTTABLE extends ALPHACONNECTABLElIST
{
	protected $id = '';
	protected $columns = array();
	protected $displayColumns = array();
	protected $sortableColumns = array();
	protected $tablename = '';
	protected $rowsPerPage = 10;
    protected $initialOrder = array();

	public function __construct($id)
	{
		$this->id = $id;
		parent::__construct(array(
			'singular'=> 'wp_'.$id, 
			'plural' => 'wp_'.$id.'s',
			'ajax' => false
		));
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function acpcsetRowsPerPage($rowsPerPage)
	{
		$this->rowsPerPage = $rowsPerPage;
	}

	public function acpcsetColumns($columns)
	{
		$this->columns = $columns;
	}

	public function acpcgetColumns()
	{
		return $this->columns;
	}

	public function acpcsetDisplayColumns($displayColumns)
	{
		$this->displayColumns = $displayColumns;
	}

	public function acpcsetSortableColumns($sortableColumns)
	{
		$this->sortableColumns = $sortableColumns;
	}

	public function acpcsetTablename($tablename)
	{
		$this->tablename = $tablename;
	}

    public function setInitialSort($orderableColumns)
    {
        $this->initialOrder = $orderableColumns;
    }

	public function get_columns()
	{
		return $this->displayColumns;
	}

	public function prepare_items()
	{
		global $wpdb;
		$table = $this->tablename;

		$query = "SELECT ".implode(', ', $this->columns)." FROM ".$table;
		$this->customizeQuery($query);

		$totalItems = count($wpdb->get_results($query)); //return the total number of affected rows

		$perPage = $this->rowsPerPage;

		$totalPages = ceil($totalItems/$perPage);

		$orderby = isset($_GET["orderby"]) ? sanitize_text_field($_GET["orderby"]) : 'ASC';
		$order = isset($_GET["order"]) ? sanitize_text_field($_GET["order"]) : '';

        if(isset($this->initialOrder) && empty($order)){
            foreach($this->initialOrder as $key=>$val){
                $order = $val;
                $orderby = $key;
            }
        }

		if (!empty($orderby) && !empty($order)) {
            if($orderby != 'id' && $orderby != 'title') {
                    $orderby = 'id';
            }
            if($order != 'asc' && $order != 'desc') {
                    $order = 'desc';
            }
            $query .= ' ORDER BY '.$orderby.' '.$order;
        }

		$paged = isset($_GET["paged"]) ? (int)$_GET["paged"] : '';

		if (empty($paged) || !is_numeric($paged) || $paged<=0) {
			$paged = 1;
		}

		//adjust the query to take pagination into account
		if(!empty($paged) && !empty($perPage)) {
			$offset = ($paged-1) * $perPage;
			$query .= ' LIMIT '.(int)$offset.','.(int)$perPage;
		}

		$this->set_pagination_args(array(
			"total_items" => $totalItems,
			"total_pages" => $totalPages,
			"per_page" => $perPage,
		));

		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns_values();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$items = $wpdb->get_results($query, ARRAY_N);
		$this->acpccustomizeRowsDatas($items);

		$this->items = $items;
	}

	public function acpccustomizeRowsDatas(&$items) {

	}

	public function get_sortable_columns_values() {
		return $this->sortableColumns;
	}

	public function display_rows()
	{
		$records = $this->items;

		list($columns, $hidden) = $this->get_column_info();

		if (!empty($records)) {
			foreach($records as $rec) {
				echo '<tr>';

				$this->acpccustomizeRow($rec);
				for ($i = 0; $i<count($rec); $i++) {
					echo '<td>'.stripslashes($rec[$i]).'</td>';
				}

				echo '</tr>';
			}
		}
	}

	public function acpccustomizeRow(&$row)
	{

	}

	public function customizeQuery(&$query)
	{

	}

	public function __toString()
	{
		$this->prepare_items(); ?>

		<?php
		$this->display();
		return '';
	}
}