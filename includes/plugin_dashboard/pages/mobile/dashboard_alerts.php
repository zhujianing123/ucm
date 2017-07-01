<?php 
/** 
  * Copyright: dtbaker 2012
  * Licence: Please check CodeCanyon.net for licence details. 
  * More licence clarification available here:  http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
  * Deploy: 10509 6566fbbc14e47c4c2873c255bd4c7a96
  * Envato: 1100806b-c9fc-484c-80fa-ee3b4b7a2080
  * Package Date: 2016-04-14 02:55:25 
  * IP Address: 1
  */ foreach($dashboard_alerts as $key=>$alerts){ ?>

            <?php print_heading(array('title'=>$key.' ('.count($alerts).')','type'=>'h3'));?>
            <mobile>
            <table class="tableclass tableclass_rows tableclass_full tbl_fixed">
                <tbody>
                <?php
                if (count($alerts)) {
                    $y = 0;
                    foreach ($alerts as $alert) {
                        ?>
                        <tr class="<?php echo ($y++ % 2) ? 'even' : 'odd'; ?>">
                            <td class="row_action">
                                <a href="<?php echo $alert['link']; ?>"><?php echo htmlspecialchars($alert['item']); ?></a>
                            </td>
                            <td width="16%">
                                <?php echo ($alert['warning']) ? '<span class="important">' : ''; ?>
                                <?php echo print_date($alert['date']); ?>
                                <?php echo ($alert['warning']) ? '</span>' : ''; ?>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td class="odd" colspan="4"><?php _e('Yay! No alerts!');?></td>
                    </tr>
                <?php  } ?>
                </tbody>
            </table>
        </mobile>
        <?php
        } ?>