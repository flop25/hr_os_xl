<?php
/*
Theme Name: hr_os_xl
Version: 1.0.0
Description: A theme with an horizontal menu everywhere and a simple modern design
Theme URI: http://fr.piwigo.org/ext/extension_view.php?eid=504
Author: flop25
Author URI: http://www.planete-flop.fr
*/
$themeconf = array(
  'name'					=> 'hr_os_xl',
  'parent'        => 'default',
  'icon_dir'      => 'themes/hr_os_xl/icon',
  'mime_icon_dir' => 'themes/hr_os_xl/icon/mimetypes/',
  'local_head'		=> 'local_head.tpl',
  'activable'			=> true,
	'add_menu_on_public_pages'			=> true,	# activation
	'Exclude'				=> array('theNBMPage','thePopuphelpPage',),	# Excluded pages
);
@include('themeconf_local.inc.php');

// thx to Vdigital and his plugin spreadmenus
if ( !function_exists( 'add_menu_on_public_pages' ) ) {
	if ( defined('IN_ADMIN') and IN_ADMIN ) return false;
	add_event_handler('loc_after_page_header', 'add_menu_on_public_pages', 20);

	function  add_menu_on_public_pages() {
	  if ( function_exists( 'initialize_menu') ) return false; # The current page has already the menu 
	  if ( !get_themeconf('add_menu_on_public_pages') ) return false; # The current page has already the menu 
	  global $template, $page, $conf;
	  if ( isset($page['body_id']) and in_array($page['body_id'], get_themeconf('Exclude')) ) return false;

	  $template->set_filenames(array(
		'add_menu_on_public_pages' => dirname(__FILE__) . '/template/add_menu_on_public_pages.tpl',
	  ));
	  include_once(PHPWG_ROOT_PATH.'include/menubar.inc.php');
	  $template->parse('add_menu_on_public_pages');
	  
	  if (is_admin())
		{
	  $template->assign(
        'U_ADMIN', get_root_url().'admin.php?page=picture_modify'
      .'&amp;cat_id='.(isset($page['category']) ? $page['category']['id'] : '')
      .( isset($page['image_id']) ? '&amp;image_id='.$page['image_id'] : '')
      );
		}
	  
	}
}
?>
