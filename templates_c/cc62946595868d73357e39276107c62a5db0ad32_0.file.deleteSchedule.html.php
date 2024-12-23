<?php
/* Smarty version 4.5.4, created on 2024-11-21 10:12:22
  from '/Applications/MAMP/htdocs/report_01/templates/deleteSchedule.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_673e88f6cab7b5_67106379',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc62946595868d73357e39276107c62a5db0ad32' => 
    array (
      0 => '/Applications/MAMP/htdocs/report_01/templates/deleteSchedule.html',
      1 => 1731837045,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_673e88f6cab7b5_67106379 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Applications/MAMP/htdocs/report_01/smarty/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スケジュール管理</title>
</head>
<body>
<h1>スケジュール削除</h1>

<?php if ($_smarty_tpl->tpl_vars['data_list']->value) {?>
    <h2><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data_list']->value['place'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
    <p><?php echo htmlspecialchars((string)smarty_modifier_date_format($_smarty_tpl->tpl_vars['data_list']->value['begin'],"%Y年%m月%d日 %H:%M"), ENT_QUOTES, 'UTF-8', true);?>
 ~ <?php echo htmlspecialchars((string)smarty_modifier_date_format($_smarty_tpl->tpl_vars['data_list']->value['end'],"%Y年%m月%d日 %H:%M"), ENT_QUOTES, 'UTF-8', true);?>
</p>
    <p><?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->tpl_vars['data_list']->value['content'], ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
</p>
    <hr>
    <form method="post" action="delete_schedule.php?id=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data_list']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
">
        <button type="submit" name="delete" value="delete">削除する</button>
    </form>
<?php } else { ?>
    <p>データが存在しません．</p>
<?php }?>

</body>
</html>
<?php }
}
