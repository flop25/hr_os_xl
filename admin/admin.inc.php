<?php

load_language('theme.lang', PHPWG_THEMES_PATH.'hr_os_xl/');

$options = array(
  'home',
  'categories',
  'picture',
  'other',
);

if (isset($_POST['submit']))
{
  foreach ($options as $option)
  {
    $_POST['foo'][$option] = empty($_POST['foo'][$option]) ? false : true;
  }

  $query = '
UPDATE '.CONFIG_TABLE.'
SET value = "'.pwg_db_real_escape_string(serialize($_POST['foo'])).'"
WHERE param = "hr_os_xl"
;';
  pwg_query($query);

  array_push($page['infos'], l10n('Information data registered in database'));

  load_conf_from_db();
}

$template->set_filenames(array(
    'theme_admin_content' => dirname(__FILE__) . '/admin.tpl'));

$template->assign('foo', unserialize($conf['hr_os_xl']));

$template->assign_var_from_handle('ADMIN_CONTENT', 'theme_admin_content');


?>