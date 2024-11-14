<?php
error_reporting(E_ALL);
ini_set("display_errors", "Off");
$error_message = array();

// 変更: MySQLに接続する
$mysqli = new mysqli("localhost", "root", "root", "bbs");
$mysqli->set_charset("utf8");

// 「投稿する」ボタンを押したときの処理
if (isset($_POST["save"])) {
    $error_message = array();
    if (!strlen($_POST["body"])) {
        $error_message[] = "本文を入力してください。";
    }
    if (count($error_message)) {
        $stmt = $mysqli->prepare("INSERT INTO post (date, title, name, body) VALUES (?, ?, ?, ?)"); // 変更
        $stmt->bind_param("ssss", date("Y-m-d H:i:s"), $_POST["title"], $_POST["name"], $_POST["body"]); // 変更
        $stmt->execute(); // 変更
    }
}

// データを検索し、$bbs_list配列にセットする
$result = $mysqli->query("SELECT * FROM post ORDER BY date DESC"); // 変更
$bbs_list = array();
while ($bbs = $result->fetch_array()) {
    $bbs_list[] = $bbs;
}

// Smartyライブラリを読み込む
require_once("smarty/Smarty.class.php");
$smarty = new Smarty();
// テンプレートを作る

// プロパティを通じたSmartyの設定
$smarty->template_dir = "templates";
$smarty->compile_dir = "templates_c"; // コンパイルディレクトリの指定
// テンプレートディレクトリの指定

// テンプレート変数をアサインして、テンプレートを表示する
$smarty->assign("error_message", $error_message);
$smarty->assign("bbs_list", $bbs_list);
$smarty->display("bbs.html"); // テンプレートを表示
?>
