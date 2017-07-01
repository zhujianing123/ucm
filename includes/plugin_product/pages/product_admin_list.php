<?php 
/** 
  * Copyright: dtbaker 2012
  * Licence: Please check CodeCanyon.net for licence details. 
  * More licence clarification available here:  http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
  * Deploy: 10509 6566fbbc14e47c4c2873c255bd4c7a96
  * Envato: 1100806b-c9fc-484c-80fa-ee3b4b7a2080
  * Package Date: 2016-05-19 01:18:12 
  * IP Address: 1
  */


if(!$module->can_i('view','Products') || !$module->can_i('edit','Products')){
    redirect_browser(_BASE_HREF);
}

// hack to add a "group" option to the pagination results.
if(class_exists('module_group',false) && module_product::can_i('edit','Products')){
    module_group::enable_pagination_hook(
        // what fields do we pass to the group module from this customers?
        array(
            'bulk_actions'=>array(
                'delete'=>array(
                    'label'=>'Delete selected products',
                    'type'=>'delete',
                    'callback'=>'module_product::bulk_handle_delete',
                ),
            ),
        )
    );
}

$search = isset($_REQUEST['search']) ? $_REQUEST['search'] : array();
$products = module_product::get_products($search);


$heading = array(
    'title' => 'Products',
    'type' => 'h2',
    'main' => true,
    'button' => array(),
);
if(module_product::can_i('create','Products')) {
    if(class_exists('module_import_export',false)) {
        $link = module_import_export::import_link(
            array(
                'callback'   => 'module_product::handle_import',
                'name'       => 'Products',
                'return_url' => $_SERVER['REQUEST_URI'],
                'fields'     => array(
                    'Product ID'       => 'product_id',
                    'Product Name'     => 'name',
                    'Product Category' => 'category_name',
                    'Hours/Qty'        => 'quantity',
                    'Amount'           => 'amount',
                    'Description'      => 'description',
                    'Enable Inventory'      => 'inventory_control',
                    'Current Inventory'      => 'inventory_level',
                    'Cost Price'      => 'purchase_price',
                ),
            )
        );
        $heading['button'][] = array(
            'title' => "Import Products",
            'type' => 'add',
            'url' => $link,
        );
    }
    $heading['button'][] = array(
        'title' => "Create New Product",
        'type'  => 'add',
        'url'   => module_product::link_open( 'new' ),
    );
}
print_heading($heading);
?>


<form action="" method="post">

<?php

/** START TABLE LAYOUT **/
$table_manager = module_theme::new_table_manager();
$columns = array();
$columns['product_name'] = array(
        'title' => _l('Product Name'),
        'callback' => function($product){
            echo module_product::link_open($product['product_id'],true,$product);
        },
        'cell_class' => 'row_action',
    );
$columns['product_category_name'] = array(
        'title' => _l('Category Name'),
    );
$columns['quantity'] = array(
        'title' => _l('Hours/Quantity'),
    );
$columns['amount'] = array(
        'title' => _l('Amount'),
        'callback' => function($product){
            echo dollar($product['amount']);
        }
    );
$columns['inventory'] = array(
        'title' => _l('Inventory'),
        'callback' => function($product){
            if(!empty($product['inventory_control'])){
	            _e('%s remain',$product['inventory_level_current']);
            }else{
	            _e('N/A');
            }
        }
    );
if(module_product::can_i('edit','Products')) {
    $columns['bulk_action'] = array(
        'title'    => ' ',
        'callback' => function ( $product ) {
            echo '<input type="checkbox" name="bulk_operation[' . $product['product_id'] . ']" value="yes">';
        }
    );
}
if(class_exists('module_extra',false)){
	// do extra before "table sorting" so that it can hook in with the table sort call
	$table_manager->display_extra('product',function($product){
		module_extra::print_table_data('product',$product['product_id']);
	},'product_id');
}
$table_manager->set_id('product_list');
$table_manager->set_columns($columns);
$table_manager->set_rows($products);
$table_manager->pagination = true;
$table_manager->print_table();
/** END TABLE LAYOUT **/

?>
</form>