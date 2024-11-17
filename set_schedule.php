<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    if (!isset($_SESSION["user_name"])) {
        // 未ログイン状態
        header('Location: login.php');
        exit();
    } else {
        echo "loginUser: " . $_SESSION["user_name"] . 
        '<form method="post" action="login.php">
            <button type="submit" name="registration" value="registration">ログアウト</button>
        </form>';
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
            $error_message[] = "本文を入力してください．";
        }

        // エラーメッセージがない場合のみデータベースに登録
        if (!count($error_message)) {
            // SQL準備：`id` カラムは指定しない
            $stmt = $mysqli->prepare("INSERT INTO schedule (begin, end, place, content) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $_POST["begin"], $_POST["end"], $_POST["place"], $_POST["content"]);

            // クエリの実行結果を確認
            if ($stmt->execute()) {
                // 成功時の処理
                $success_message = "投稿が正常に登録されました.";
            } else {
                // 失敗時の処理
                $error_message[] = "データベースエラー: 投稿の登録に失敗しました.";
            }
        }

        // 成功メッセージまたはエラーメッセージを表示
        if (isset($success_message)) {
            $alert = "<script type='text/javascript'>confirm('$success_message');</script>";
            echo $alert;
            //echo "<p class='success'>$success_message</p>";
        }
        if (count($error_message)) {
            foreach ($error_message as $msg) {
                $alert = "<script type='text/javascript'>alert('$msg');</script>";
                echo $alert;
                //echo "<p class='error'>$msg</p>";
            }
        }
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
    $smarty->assign("schedule_list", $schedule_list);
    $smarty->display("setSchedule.html"); // テンプレートを表示

?>
