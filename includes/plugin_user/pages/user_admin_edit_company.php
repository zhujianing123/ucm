<?php 
/** 
  * Copyright: dtbaker 2012
  * Licence: Please check CodeCanyon.net for licence details. 
  * More licence clarification available here:  http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
  * Deploy: 10509 6566fbbc14e47c4c2873c255bd4c7a96
  * Envato: 1100806b-c9fc-484c-80fa-ee3b4b7a2080
  * Package Date: 2016-04-14 02:55:25 
  * IP Address: 1
  */

if(class_exists('module_company',false) && module_company::can_i('view','Company') && module_company::is_enabled() && module_user::can_i('edit','User')){
    $heading = array(
        'type' => 'h3',
        'title' => 'Assigned Company',
    );
    if(module_company::can_i('edit','Company')){
        $help_text = addcslashes(_l("Here you can select which Company this Staff belongs to. This is handy if you are running multiple companies through this system and you would like to separate customers between different companies. Staff can be restricted to assigned companies from the User Role"),"'");
        $heading['button'] =  array(
          'url' => '#',
          'onclick' => "alert('$help_text'); return false;",
          'title' => 'help',
      );
    }
    ob_start();
    ?>
        <table class="tableclass tableclass_form tableclass_full">
        <tbody>
            <tr>
                <th class="width1">
                    <?php echo _l('Company'); ?>
                </th>
                <td>
                    <?php
                    $companys = module_company::get_companys();
                    foreach($companys as $company){ ?>
                        <?php if(module_company::can_i('edit','Company')){ ?>
                        <input type="hidden" name="available_user_company[<?php echo $company['company_id'];?>]" value="1">
                        <input type="checkbox" name="user_company[<?php echo $company['company_id'];?>]" id="customer_company_<?php echo $company['company_id'];?>" value="<?php echo $company['company_id'];?>" <?php echo isset($user['company_ids']) && isset($user['company_ids'][$company['company_id']]) ? ' checked="checked" ':'';?>>
                        <?php } ?>
                        <label for="customer_company_<?php echo $company['company_id'];?>"><?php echo htmlspecialchars($company['name']);?></label>
                    <?php } ?>
                </td>
            </tr>
        </tbody>
        </table>

    <?php

    $fieldset_data = array(
        'heading' => $heading,
        'elements_before' => ob_get_clean(),
    );

    echo module_form::generate_fieldset($fieldset_data);
    unset($fieldset_data);

}