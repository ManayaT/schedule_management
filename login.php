<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
        // $_SESSIONのデータを削除
        $_SESSION = array();
    }

    error_reporting(E_ALL);
    ini_set("display_errors", "Off");
    $error_message = array();

    // 変更: MySQLに接続する
    $mysqli = new mysqli("localhost", "root", "root", "webReport_01");
    $mysqli->set_charset("utf8");

    // ログインボタンを押したときの処理
    if (isset($_POST["login"])) {
        $error_message = array();
        $password = $_POST["password"];
        $username = $_POST["username"];

        if (!strlen($_POST["username"])) {
            $error_message[] = "ユーザ名を入力してください．";
        } else if (!strlen($_POST["password"])) {
            $error_message[] = "パスワードを入力してください．";
        }

        // エラーメッセージがない場合のみデータベースに登録
        if (!count($error_message)) {
            $hashed_pass = hash('sha256', $password);
            // ユーザー名とパスワードでデータベース内を検索する準備
            $stmt = $mysqli->prepare("SELECT * FROM user WHERE username = ? AND password = ? LIMIT 1");

            if ($stmt) {
                // ユーザー名とパスワードのバインド
                $stmt->bind_param("ss", $username, $hashed_pass);
                // クエリの実行
                $stmt->execute();
                // 結果を取得して確認
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $_SESSION["user_name"] = $username;
                    header('Location: schedule_list.php');
                    exit();
                } else {
                    $alert = "<script type='text/javascript'>alert('パスワードまたはユーザ名が違います．');</script>";
                    echo $alert;
                }
            } else {
                echo "クエリの準備に失敗しました: " . $mysqli->error;
            }
        }
    }

    // Smartyライブラリを読み込む
    require_once("smarty/Smarty.class.php");
    $smarty = new Smarty();

    // プロパティを通じたSmartyの設定
    $smarty->template_dir = "templates";
    $smarty->compile_dir = "templates_c"; // コンパイルディレクトリの指定
    // テンプレートディレクトリの指定

    // テンプレート変数をアサインして、テンプレートを表示する
    $smarty->assign("error_message", $error_message);
    $smarty->assign("schedule_list", $schedule_list);
    $smarty->display("login.html"); // テンプレートを表示
?>
