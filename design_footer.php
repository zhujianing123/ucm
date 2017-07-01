<?php 
/** 
  * Copyright: dtbaker 2012
  * Licence: Please check CodeCanyon.net for licence details. 
  * More licence clarification available here:  http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
  * Deploy: 10509 6566fbbc14e47c4c2873c255bd4c7a96
  * Envato: 1100806b-c9fc-484c-80fa-ee3b4b7a2080
  * Package Date: 2016-05-19 01:18:34 
  * IP Address: 1
  */
switch($display_mode){
    case 'iframe':
        ?>
         </div>
        </body>
        </html>
        <?php
        module_debug::push_to_parent();
        break;
    case 'ajax':

        break;
    case 'mobile':
        if(class_exists('module_mobile',false)){
            module_mobile::render_stop($page_title,$page);
        }
        break;
    case 'normal':
    default:

	if(function_exists('hook_handle_callback')){
		hook_handle_callback('content_footer');
	}
	?>

        </div>
          </div>
          <div id="footer">
              &copy; <?php echo module_config::s('admin_system_name','Ultimate Client Manager'); ?>
              - <?php echo date("Y"); ?>
              - Version: <?php echo module_config::current_version(); ?>
              - Time: <?php echo round(microtime(true)-$start_time,5);?>
              <?php if(class_exists('module_mobile',false) && module_config::c('mobile_link_in_footer',1)){ ?>
            - <a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); echo strpos($_SERVER['REQUEST_URI'],'?')===false ? '?' : '&'; ?>display_mode=mobile"><?php _e('Switch to Mobile Site');?></a>
            <?php } ?>
          </div>
        </div>
        </body>
        </html>
        <?php
        break;
}