<?php
    if(session_status() ===  PHP_SESSION_ACTIVE){
        return;
    } else {
        // セッション開始
        session_start();
    }

    error_reporting(E_ALL);
    ini_set("display_errors", "Off");
    $error_message = array();

    // 変更: MySQLに接続する
    $mysqli = new mysqli("localhost", "root", "root", "webReport_01");
    $mysqli->set_charset("utf8");

    // // データをbeginカラムで降順取得、$schedule_list配列にセットする
    // $result = $mysqli->query("SELECT * FROM schedule ORDER BY begin DESC"); // 変更
    // $schedule_list = array();
    // while ($schedule = $result->fetch_array()) {
    //     $schedule_list[] = $schedule;
    // }

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
    $smarty->assign("schedule_list", $schedule_list);
    $smarty->display("ScheduleList.html"); // テンプレートを表示

?>
