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

    // 「投稿する」ボタンを押したときの処理
    if (isset($_POST["save"])) {
        $error_message = array();
        if (!strlen($_POST["content"])) {
            $error_message[] = "本文を入力してください。";
        }

        // エラーメッセージがない場合のみデータベースに登録
        if (!count($error_message)) {
            // SQL準備：`id` カラムは指定しない
            $stmt = $mysqli->prepare("INSERT INTO schedule (begin, end, place, content) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $_POST["begin"], $_POST["end"], $_POST["place"], $_POST["content"]);

            // クエリの実行結果を確認
            if ($stmt->execute()) {
                // 成功時の処理
                $success_message = "投稿が正常に登録されました。";
            } else {
                // 失敗時の処理
                $error_message[] = "データベースエラー: 投稿の登録に失敗しました。";
            }
        }

        // 成功メッセージまたはエラーメッセージを表示
        if (isset($success_message)) {
            echo "<p class='success'>$success_message</p>";
        }
        if (count($error_message)) {
            foreach ($error_message as $msg) {
                echo "<p class='error'>$msg</p>";
            }
        }
    }

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
    $smarty->display("setSchedule.html"); // テンプレートを表示

?>
