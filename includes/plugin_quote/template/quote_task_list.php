<?php 
/** 
  * Copyright: dtbaker 2012
  * Licence: Please check CodeCanyon.net for licence details. 
  * More licence clarification available here:  http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
  * Deploy: 10509 6566fbbc14e47c4c2873c255bd4c7a96
  * Envato: 1100806b-c9fc-484c-80fa-ee3b4b7a2080
  * Package Date: 2016-05-19 01:18:16 
  * IP Address: 1
  */

// UPDATE::: to edit the "quote task list" please go to Settings > Templates and look for the new "quote_task_list" entry.

if(!isset($quote)&&isset($quote_data))$quote = $quote_data;


ob_start();
?>
<table cellpadding="4" cellspacing="0" style="width:100%" class="table tableclass tableclass_rows">
	<thead>
		<tr class="task_header">
            <th style="width:5%; text-align:center">
				#
			</th>
			<th  style="width:47%; text-align:center">
				{l:Description}
			</th>
			<th style="width:10%; text-align:center">
                {TITLE_QTY_OR_HOURS}
			</th>
			<th style="width:14%; text-align:center">
                {TITLE_AMOUNT_OR_RATE}
			</th>
			<th style="width:14%; text-align:center">
				{l:Sub-Total}
			</th>
		</tr>
	</thead>
	<tbody>
        <tr class="{ITEM_ODD_OR_EVEN}" data-item-row="true">
            <td style="text-align:center">
                {ITEM_NUMBER}
            </td>
            <td>
                {ITEM_DESCRIPTION}
            </td>
            <td align="center">
                {ITEM_QTY_OR_HOURS}
            </td>
            <td style="text-align: right;">
                {ITEM_AMOUNT_OR_RATE}
            </td>
            <td style="text-align: right;">
                {ITEM_TOTAL}
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        {QUOTE_SUMMARY}
    </tfoot>
</table>

<?php
module_template::init_template('quote_task_list',ob_get_clean(),'Used when displaying the quote tasks.','code');

$t = false;
if(isset($quote_template_suffix) && strlen($quote_template_suffix) > 0){
	$t = module_template::get_template_by_key('quote_task_list'.$quote_template_suffix);
	if(!$t->template_id){
		$t = false;
	}
}
if(!$t){
	$t = module_template::get_template_by_key('quote_task_list');
}


$replace = array();

$quote_tasks = module_quote::get_quote_items($quote_id,$quote);

$unit_measurement = false;
if(is_callable('module_product::sanitise_product_name')) {
	$fake_task = module_product::sanitise_product_name( array(), $quote['default_task_type'] );
	$unit_measurement = $fake_task['unitname'];
	foreach($quote_tasks as $quote_task_id => $task_data){
		if(isset($task_data['unitname']) && $task_data['unitname'] != $unit_measurement){
			$unit_measurement = false;
			break; // show nothing at title of quote page.
		}
	}
}
$replace['title_qty_or_hours'] = _l($unit_measurement ? $unit_measurement : module_config::c('task_default_name','Unit'));
$replace['title_amount_or_rate'] = _l(module_config::c('quote_amount_name','Amount'));



if(preg_match('#<tr[^>]+data-item-row="true">.*</tr>#imsU',$t->content,$matches)){
    $item_row_html = $matches[0];
    $colspan = substr_count($item_row_html,'<td') - 2;
    $t->content = str_replace($item_row_html, '{ITEM_ROW_CONTENT}', $t->content);
}else{
    set_error('Please ensure a TR with data-item-row="true" is in the quote_task_list template');
    $item_row_html = '';
    $colspan = 4;
}



ob_start();
/* copied from quote_admin_edit.php
todo: move this into a separate method or something so they can both share updates easier
*/
$rows = array();
// we hide quote tax if there is none
$hide_tax = true;
foreach($quote['taxes'] as $quote_tax){
    if($quote_tax['percent']>0){
        $hide_tax=false;
        break;
    }
}
if($quote['total_sub_amount_unbillable']){
    $rows[]=array(
        'label'=>_l('Sub Total:'),
        'value'=>'<span class="currency">'.dollar($quote['total_sub_amount']+$quote['total_sub_amount_unbillable'],true,$quote['currency_id']).'</span>'
    );
    $rows[]=array(
        'label'=>_l('Unbillable:'),
        'value'=>'<span class="currency">'.dollar($quote['total_sub_amount_unbillable'],true,$quote['currency_id']).'</span>'
    );
}
if(isset($quote['discount_type'])){
    if($quote['discount_type']==_DISCOUNT_TYPE_BEFORE_TAX){
        $rows[]=array(
            'label'=>_l('Sub Total:'),
            'value'=>'<span class="currency">'.dollar($quote['total_sub_amount']+$quote['discount_amount'],true,$quote['currency_id']).'</span>'
        );
        if($quote['discount_amount']>0){
            $rows[]=array(
                'label'=> htmlspecialchars(_l($quote['discount_description'])),
                'value'=> '<span class="currency">'.dollar($quote['discount_amount'],true,$quote['currency_id']).'</span>'
            );
            $rows[]=array(
                'label'=>_l('Sub Total:'),
                'value'=>'<span class="currency">'.dollar($quote['total_sub_amount'],true,$quote['currency_id']).'</span>'
            );
        }
        if(!$hide_tax){
            foreach($quote['taxes'] as $quote_tax){
                $rows[]=array(
                    'label'=>$quote_tax['name'].' '.number_out($quote_tax['percent'], module_config::c('tax_trim_decimal', 1), module_config::c('tax_decimal_places',module_config::c('currency_decimal_places',2))).'%',
                    'value'=>'<span class="currency">'.dollar($quote_tax['amount'],true,$quote['currency_id']).'</span>',
                    //'extra'=>$quote_tax['name'] . ' = '.$quote_tax['rate'].'%',
                );
            }
        }

    }else if($quote['discount_type']==_DISCOUNT_TYPE_AFTER_TAX){
        $rows[]=array(
            'label'=>_l('Sub Total:'),
            'value'=>'<span class="currency">'.dollar($quote['total_sub_amount'],true,$quote['currency_id']).'</span>'
        );
        if(!$hide_tax){
            foreach($quote['taxes'] as $quote_tax){
                $rows[]=array(
                    'label'=>$quote_tax['name'].' '.number_out($quote_tax['percent'], module_config::c('tax_trim_decimal', 1), module_config::c('tax_decimal_places',module_config::c('currency_decimal_places',2))).'%',
                    'value'=>'<span class="currency">'.dollar($quote_tax['amount'],true,$quote['currency_id']).'</span>',
                    //'extra'=>$quote_tax['name'] . ' = '.$quote_tax['percent'].'%',
                );
            }
            $rows[]=array(
                'label'=>_l('Sub Total:'),
                'value'=>'<span class="currency">'.dollar($quote['total_sub_amount']+$quote['total_tax'],true,$quote['currency_id']).'</span>',
            );
        }
        if($quote['discount_amount']>0){ //if(($discounts_allowed || $quote['discount_amount']>0) &&  (!($quote_locked && module_security::is_page_editable()) || $quote['discount_amount']>0)){
            $rows[]=array(
                'label'=> htmlspecialchars(_l($quote['discount_description'])),
                'value'=> '<span class="currency">'.dollar($quote['discount_amount'],true,$quote['currency_id']).'</span>'
            );
        }
    }
}else{
    if(!$hide_tax){
        $rows[]=array(
            'label'=>_l('Sub Total:'),
            'value'=>'<span class="currency">'.dollar($quote['total_sub_amount'],true,$quote['currency_id']).'</span>',
        );
        foreach($quote['taxes'] as $quote_tax){
            $rows[]=array(
                'label'=>$quote_tax['name'].' '.$quote_tax['percent'].'%',
                'value'=>'<span class="currency">'.dollar($quote_tax['amount'],true,$quote['currency_id']).'</span>',
                'extra'=>$quote_tax['name'] . ' = '.$quote_tax['percent'].'%',
            );
        }
    }
}

$rows[]=array(
    'label'=>_l('Total:'),
    'value'=>'<span class="currency" style="text-decoration: underline; font-weight: bold;">'.dollar($quote['total_amount'],true,$quote['currency_id']).'</span>',
);
for ($row_id= 0;$row_id< count($rows); $row_id++){
    if($row_id == 0)
    {
        $rows[$row_id]['words'] = "Expected Completion Time:Flat panel needs 10 days.Raised panel and MD need 14 days.";
    }else if($row_id == 1)
    {
        $rows[$row_id]['words'] = "Please verify and sign below to provide us ";
    }else if($row_id == 2)
    {
        $rows[$row_id]['words'] = "your consent to proceed with the production.";
    }
}
foreach($rows as $row){ ?>
<tr>
    <td style="font-size:10" colspan="<?php echo $colspan;?>">
        <?php echo $row['words'];?>
    </td>
    <td>
        <?php echo $row['label'];?>
    </td>
    <td style="text-align: right;">
        <?php echo $row['value'];?>
    </td>
</tr>
<?php }

$replace['quote_summary'] = ob_get_clean();


/* START QUOTE LINE ITEMS */

$task_decimal_places = module_config::c('task_amount_decimal_places',-1);
if($task_decimal_places < 0){
    $task_decimal_places = false; // use default currency dec places.
}
$task_decimal_places_trim = module_config::c('task_amount_decimal_places_trim',0);


$all_item_row_html = '';
$item_count = 0;// changed from 1
$total_qty = 0;
$total_area = 0;
$total_amount = 0;
foreach($quote_tasks as $quote_item_id => $quote_item_data){

    $row_replace = array(
        'item_odd_or_even' => $item_count++%2 ? 'odd' : 'even',
        'item_number' => '',
        'item_description' => '',
        //'item_date' => '',
        'item_tax' => 0,
        'item_tax_rate' => '',
        'item_width' => 0,
        'item_height' => 0,
        'item_lite' => 0,
        'item_area' => 0,
        'item_price/sf' => 0,
        'item_unit_price' => 0,
        'item_sub_total' => 0,
        'item_lite_price' => 0,
        'item_area_inch' => 0,


    );

    if(isset($quote_item_data['task_order']) && $quote_item_data['task_order']>0){
        $row_replace['item_number'] = $quote_item_data['task_order'];
    }else{
        $row_replace['item_number'] = $item_count;
    }
    if(isset($quote_item_data['width']) && $quote_item_data['width']>0){
        $value_width = 0;
        $arraylist = explode(" ",$quote_item_data['width']);
        if(count($arraylist) >1)
        {
            $tmp_array = explode("/",$arraylist[1]);
            $value_width = intval($arraylist[0]) + number_format(intval($tmp_array[0])/intval($tmp_array[1]), 3, '.', '');
        }else{
            $value_width = number_format($quote_item_data['width'], 3, '.', '');
        }
        $row_replace['item_width'] = $value_width;
        $row_replace['item_area_inch'] = ceil($value_width);
    }
    if(isset($quote_item_data['lite']) && $quote_item_data['lite']){
        $row_replace['item_lite'] = $quote_item_data['lite'];
        $row_replace['item_lite_price'] = $row_replace['item_lite'] * 8.86;

    }
    if(isset($quote_item_data['height']) && $quote_item_data['height']>0){
        $value_height = 0;
        $arraylist2 = explode(" ",$quote_item_data['height']);
        if(count($arraylist2) >1)
        {
            $tmp_array2 = explode("/",$arraylist[1]);
            $value_height = intval($arraylist2[0]) + number_format(intval($tmp_array2[0])/intval($tmp_array2[1]), 3, '.', '');
        }else{
            $value_height = number_format($quote_item_data['height'], 3, '.', '');
        }
        $row_replace['item_height'] = $value_height;
        $row_replace['item_area_inch'] = $row_replace['item_area_inch'] * ceil($value_height);
        $row_replace['item_area_inch'] = $row_replace['item_area_inch'] / 144 < 1 ? 1 : $row_replace['item_area_inch'] / 144;
    }

    $row_replace['item_description'] .= htmlspecialchars($quote_item_data['description']);
    if(module_config::c('quote_show_long_desc',1)){
        $long_description =$quote_item_data['long_description'];
        if($long_description!=''){
            $row_replace['item_description'] .= '<br/><em>'.forum_text($long_description).'</em>';
        }
    }



    /*if(isset($quote_item_data['date_done']) && $quote_item_data['date_done'] != '0000-00-00'){
        $row_replace['item_date'] .= print_date($quote_item_data['date_done']);
    }else{
        // check if this is linked to a task.
        if($quote_item_data['quote_task_id']){
            $task = get_single('quote_task','quote_task_id',$quote_item_data['quote_task_id']);
            if($task && isset($task['date_done']) && $task['date_done'] != '0000-00-00'){
                $row_replace['item_date'] .= print_date($task['date_done']);
            }else{
                // check if quote has a date.
                if(isset($quote['date_create']) && $quote['date_create'] != '0000-00-00'){
                    $row_replace['item_date'] .= print_date($quote['date_create']);
                }
            }
        }
    }*/
    if($quote_item_data['manual_task_type']==_TASK_TYPE_AMOUNT_ONLY){
        $row_replace['item_qty_or_hours'] = $quote_item_data['hours'] ? $quote_item_data['hours'] : '-';
    }else{
	    if($quote_item_data['manual_task_type'] == _TASK_TYPE_HOURS_AMOUNT && function_exists('decimal_time_out')){
            $hours_value = decimal_time_out($quote_item_data['hours']);
        }else {
            $hours_value = number_out( $quote_item_data['hours'], true );
        }
        $row_replace['item_qty_or_hours'] = $hours_value ? $hours_value . ($quote_item_data['unitname_show'] ? ' ' .$quote_item_data['unitname'] : '') : '-';
        $row_replace['item_area'] = number_format($row_replace['item_area'] * $row_replace['item_qty_or_hours'],2);
    }
    if($quote_item_data['task_hourly_rate']!=0){
        $row_replace['item_price/sf'] = $quote_item_data['task_hourly_rate'];

    }else{
        $row_replace['item_price/sf'] = '-';
    }

    $row_replace['item_area'] = number_format($row_replace['item_area_inch'] * $row_replace['item_qty_or_hours'],2,'.','');

    $row_replace['item_unit_price'] = number_format($row_replace['item_area_inch'] * $row_replace['item_price/sf'] + $row_replace['item_lite_price'], 2,'.','');

    $row_replace['item_sub_total'] = number_format($row_replace['item_unit_price'] * $row_replace['item_qty_or_hours'],2,'.','');

    $total_qty += $quote_item_data['hours'];
    $total_area += $row_replace['item_area'];
    $total_amount += $row_replace['item_sub_total'];
    // taxes per item
    if(isset($quote_item_data['taxes']) && is_array($quote_item_data['taxes']) && $quote_item_data['taxable'] && class_exists('module_finance',false)){
        // this passes off the tax calculation to the 'finance' class, which modifies 'amount' to match the amount of tax applied here.
        $this_taxes = module_finance::sanatise_taxes($quote_item_data['taxes'],$quote_item_data['quote_item_amount']);
        $this_taxes_amounts = array();
        $this_taxes_rates = array();
        if(!count($this_taxes)){
            $this_taxes = array(
                'amount' => 0,
                'percent' => 0,
            );
        }
        foreach($this_taxes as $this_tax){
            $this_taxes_amounts[] = dollar($this_tax['amount'],true,$quote['currency_id']);
            $this_taxes_rates[] = $this_tax['percent'].'%';
        }
        $row_replace['item_tax'] = implode(', ',$this_taxes_amounts);
        $row_replace['item_tax_rate'] = implode(', ',$this_taxes_rates);
    }

    $this_item_row_html = $item_row_html;
    $this_item_row_html = str_replace(' data-item-row="true"','',$this_item_row_html);
	// we pass this through the template system so we can make use of things like arithmatic.
	$temp_template = new module_template();
	$temp_template->assign_values($row_replace);
	$temp_template->content = $this_item_row_html;
	$this_item_row_html = $temp_template->replace_content();

    /*foreach($row_replace as $key=>$val){
        $this_item_row_html = str_replace('{'.strtoupper($key).'}', $val, $this_item_row_html);
    }*/
    $all_item_row_html .= $this_item_row_html;
}

$replace['ITEM_QTY_TOTAL'] = $total_qty;
$replace['ITEM_TOTAL_AREA'] = $total_area;
$replace['ITEM_ALL_TOTAL'] = $total_amount;
$replace['ITEM_ROW_CONTENT'] = $all_item_row_html;
$t->assign_values($replace);
echo $t->render();

if(isset($row_replace) && count($row_replace)){
    module_template::add_tags('quote_task_list',$row_replace);
}