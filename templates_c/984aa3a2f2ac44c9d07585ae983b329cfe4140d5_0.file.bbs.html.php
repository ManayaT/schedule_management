<?php
/* Smarty version 4.5.4, created on 2024-10-24 03:53:23
  from '/Applications/MAMP/htdocs/04/BBS-DB/templates/bbs.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_6719c4b3436f70_62949165',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '984aa3a2f2ac44c9d07585ae983b329cfe4140d5' => 
    array (
      0 => '/Applications/MAMP/htdocs/04/BBS-DB/templates/bbs.html',
      1 => 1729741930,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6719c4b3436f70_62949165 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Applications/MAMP/htdocs/04/BBS-DB/smarty/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>サックと掲示板(DB版)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>サクッと掲示板(DB版)</h1>

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
        <th>投稿者</th>
        <td><input type="text" name="name" size="30"></td>
    </tr>
    <tr>
    <th>タイトル</th>
        <td><input type="text" name="title" size="50"></td>
        </tr>
    <tr>
        <td colspan="2"><textarea name="body" cols="50" rows="5"></textarea></td>
    </tr>
    </table>
    <input name="save" type="submit" value="投稿する">
</form>
<hr>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bbs_list']->value, 'bbs');
$_smarty_tpl->tpl_vars['bbs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bbs']->value) {
$_smarty_tpl->tpl_vars['bbs']->do_else = false;
?>
<h2><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['bbs']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
<p><?php echo htmlspecialchars((string)smarty_modifier_date_format($_smarty_tpl->tpl_vars['bbs']->value['date'],"%Y年%m月%d日 %H:%M:%S"), ENT_QUOTES, 'UTF-8', true);?>
 / 投稿者：<strong>
<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['bbs']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</strong></p>
<p><?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->tpl_vars['bbs']->value['body'], ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
</p>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

</body>
</html>
<?php }
}
