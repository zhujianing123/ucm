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

if(!module_config::can_i('view','Settings')){
    redirect_browser(_BASE_HREF);
}

if(isset($_REQUEST['group_id'])){
    include('group_edit.php');
}else{

    $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : array();
    $groups = $module->get_groups($search);
    ?>


    <h2>
        <!--<span class="button">
            <?php /*echo create_link("Add New","add",module_group::link_open('new')); */?>
        </span>-->
        <?php echo _l('Groups'); ?>
    </h2>


    <form action="" method="post">

    <table width="100%" border="0" cellspacing="0" cellpadding="2" class="tableclass tableclass_rows">
        <thead>
        <tr class="title">
            <th><?php echo _l('Group Name'); ?></th>
            <th><?php echo _l('Available to'); ?></th>
            <th><?php echo _l('Group Members'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $c=0;
        foreach($groups as $group){ ?>
            <tr class="<?php echo ($c++%2)?"odd":"even"; ?>">
                <td class="row_action">
                    <?php echo module_group::link_open($group['group_id'],true);?>
                </td>
                <td>
                    <?php echo $group['owner_table'];?>
                </td>
                <td>
                    <?php echo $group['count']; ?>
                </td>
            </tr>
        <?php } ?>
      </tbody>
    </table>
    </form>
<?php } ?>