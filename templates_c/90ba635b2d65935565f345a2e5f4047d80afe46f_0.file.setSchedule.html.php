<?php
/* Smarty version 4.5.4, created on 2024-11-17 17:18:08
  from '/Applications/MAMP/htdocs/report_01/templates/setSchedule.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_6739a6c0baf099_27172287',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90ba635b2d65935565f345a2e5f4047d80afe46f' => 
    array (
      0 => '/Applications/MAMP/htdocs/report_01/templates/setSchedule.html',
      1 => 1731661923,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6739a6c0baf099_27172287 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スケジュール管理</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
<h1>スケジュール登録</h1>

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
        <td><input type="datetime-local" name="begin" size="50"></td>
    </tr>
    <tr>
        <th>終了日時</th>
        <td><input type="datetime-local" name="end" size="50"></td>
    </tr>
    <tr>
        <th>場所</th>
        <td><input type="text" name="place" size="50"></td>
    </tr>
    <tr>
        <th>内容</th>
        <td colspan="2"><textarea name="content" cols="50" rows="5"></textarea></td>
    </tr>
    </table>
    <hr>
    <input name="save" type="submit" value="登録する">
</form>

</body>
</html>
<?php }
}
