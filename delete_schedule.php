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

    // 「削除する」ボタンを押したときの処理
    if (isset($_POST["delete"])){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // DELETE文の準備
            $stmt = $mysqli->prepare("DELETE FROM schedule WHERE id = ?");
            $stmt->bind_param("i", $id);

            // クエリの実行と成功確認
            if ($stmt->execute()) {
                $success_message =  "データが削除されました．";
            } else {
                $error_message[] = "データ削除に失敗しました: " . $mysqli->error;
            }

            // 成功メッセージまたはエラーメッセージを表示
            if (isset($success_message)) {
                echo 
                "<script type='text/javascript'>
                confirm('$success_message');
                window.location.href = 'schedule_list.php';
                </script>";
                exit();
            }
            if (count($error_message)) {
                foreach ($error_message as $msg) {
                    $alert = "<script type='text/javascript'>alert('$msg');</script>";
                    echo $alert;
                }
            }
        }
    }

    // URLパラメータ 'id' の取得
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // タスクidでデータベース内を検索する準備
        $data_list = array();
        $stmt = $mysqli->prepare("SELECT * FROM schedule WHERE id = ? LIMIT 1");

        if ($stmt) {
            // プレースホルダに $id をバインド
            $stmt->bind_param("s", $id);
            // クエリの実行
            $stmt->execute();
            // 結果を取得して確認
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // 取得した情報を連想配列に変換
                $data_list = $result->fetch_assoc();
            } else {
                header('Location: schedule_list.php');
                exit();
            }
        } else {
            echo "クエリの準備に失敗しました: " . $mysqli->error;
        }   
    } else {
        echo 
        "<script type='text/javascript'>
        confirm('IDが指定されていません．');
        window.location.href = 'schedule_list.php';
        </script>";
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
    $smarty->assign("data_list", $data_list);

    $smarty->assign("error_message", $error_message);
    $smarty->assign("schedule_list", $schedule_list);
    $smarty->display("deleteSchedule.html"); // テンプレートを表示

?>
