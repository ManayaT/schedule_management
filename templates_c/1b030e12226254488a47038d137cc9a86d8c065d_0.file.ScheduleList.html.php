<?php
/* Smarty version 4.5.4, created on 2024-11-15 17:01:09
  from '/Applications/MAMP/htdocs/report_01/templates/ScheduleList.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_6736ffc505d242_54264145',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b030e12226254488a47038d137cc9a86d8c065d' => 
    array (
      0 => '/Applications/MAMP/htdocs/report_01/templates/ScheduleList.html',
      1 => 1731657665,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6736ffc505d242_54264145 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Applications/MAMP/htdocs/report_01/smarty/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スケジュール管理</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
<h1>スケジュール一覧</h1>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['schedule_list']->value, 'schedule');
$_smarty_tpl->tpl_vars['schedule']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['schedule']->value) {
$_smarty_tpl->tpl_vars['schedule']->do_else = false;
?>
<h2><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['schedule']->value['place'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
<p><?php echo htmlspecialchars((string)smarty_modifier_date_format($_smarty_tpl->tpl_vars['schedule']->value['begin'],"%Y年%m月%d日 %H:%M"), ENT_QUOTES, 'UTF-8', true);?>
 / 投稿者：<strong><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['schedule']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
</strong></p>
<p><?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->tpl_vars['schedule']->value['content'], ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
</p>
<button onclick="location.href='adjust_schedule.php?id=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['schedule']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
'">更新</button>
<button onclick="location.href='delete_schedule.php?id=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['schedule']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
'">削除</button>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

</body>
</html>
<?php }
}