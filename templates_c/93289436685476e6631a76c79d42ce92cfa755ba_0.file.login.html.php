<?php
/* Smarty version 4.5.4, created on 2024-11-17 18:48:47
  from '/Applications/MAMP/htdocs/report_01/templates/login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_6739bbff142863_38497043',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93289436685476e6631a76c79d42ce92cfa755ba' => 
    array (
      0 => '/Applications/MAMP/htdocs/report_01/templates/login.html',
      1 => 1731836926,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6739bbff142863_38497043 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スケジュール管理</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
<h1>ログイン</h1>
<hr>

<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>
">
    <table>
    <tr>
        <th>ユーザ名</th>
        <td><input type="text" name="username" size="30"></td>
    </tr>
    <tr>
        <th>パスワード</th>
        <td><input type="text" name="password" size="30"></td>
    </tr>
    </table>
    <input name="login" type="submit" value="ログイン">
</form>
</body>
</html>
<?php }
}
