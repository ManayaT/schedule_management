<?php
/* Smarty version 4.5.4, created on 2024-11-15 17:06:20
  from '/Applications/MAMP/htdocs/report_01/templates/adjustSchedule.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_673700fc37e038_10010797',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e566b72ee24e66875a7acc8f20cf9bc22593bec8' => 
    array (
      0 => '/Applications/MAMP/htdocs/report_01/templates/adjustSchedule.html',
      1 => 1731657718,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_673700fc37e038_10010797 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スケジュール管理</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
<h1>スケジュール管理</h1>

<?php if ($_smarty_tpl->tpl_vars['error_message']->value) {?>
    <ul class="error-message">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['error_message']->value, 'message');
$_smarty_tpl->tpl_vars['message']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->do_else = false;
?>
    <li><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value, ENT_QUOTES, 'UTF-8', true);?>
</li>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
<?php }?>

<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>
">
    <table>
    <tr>
        <th>開始日時</th>
        <td><input type="datetime-local" name="begin" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['begin'], ENT_QUOTES, 'UTF-8', true);?>
" size="50"></td>
    </tr>
    <tr>
        <th>終了日時</th>
        <td><input type="datetime-local" name="end" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['end'], ENT_QUOTES, 'UTF-8', true);?>
" size="50"></td>
    </tr>
    <tr>
        <th>場所</th>
        <td><input type="text" name="place" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['place'], ENT_QUOTES, 'UTF-8', true);?>
" size="50"></td>
    </tr> 
    <tr>
        <th>内容</th>
        <td colspan="2"><textarea name="content" cols="50" rows="5"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['content'], ENT_QUOTES, 'UTF-8', true);?>
</textarea></td>
    </tr>
    </table>
    <input name="save" type="submit" value="更新する">
</form>
<hr>

</body>
</html>
<?php }
}
