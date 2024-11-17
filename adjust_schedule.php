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

    // URLパラメータ 'id' の取得
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // echo "取得したID: " . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
    } else {
        echo "IDが指定されていません。";
    }  

    if (isset($_POST["adjust"])) {
        $error_message = array();
        
        // 入力チェック
        if (!strlen($_POST["content"])) {
            $error_message[] = "本文を入力してください。";
        }
    
        if (!count($error_message)) {
            // UPDATE文の準備
            $stmt = $mysqli->prepare("UPDATE schedule SET begin = ?, end = ?, place = ?, content = ? WHERE id = ?");
            if (!$stmt) {
                $error_message[] = "SQL準備エラー: " . $mysqli->error;
            } else {
                $stmt->bind_param(
                    "ssssi",
                    $_POST["begin"],
                    $_POST["end"],
                    $_POST["place"],
                    $_POST["content"],
                    $id
                );
    
                // クエリの実行
                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        $success_message = "データが更新されました。";
                    } else {
                        $success_message = "データに変更はありませんでした。";
                    }
                } else {
                    $error_message[] = "データ更新に失敗しました: " . $stmt->error;
                }                
            }
        }
    
        // メッセージ表示
        if (isset($success_message)) {
            echo "
            <script type='text/javascript'>
            confirm('$success_message');
            window.location.href = 'schedule_list.php';
            </script>";
            exit();
        }
    
        if (count($error_message)) {
            foreach ($error_message as $msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
        }
    } else {
        // タスクidでデータベース内を検索する準備
        $data_list = array();
        $stmt = $mysqli->prepare("SELECT * FROM schedule WHERE id = ? LIMIT 1");
        if ($stmt) {
            // プレースホルダに $id をバインド
            $stmt->bind_param("i", $id);
            // クエリの実行
            $stmt->execute();
            // 結果を取得して確認
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // 取得した情報を連想配列に変換
                $data_list = $result->fetch_assoc();
            } else {
                echo                 
                "<script type='text/javascript'>
                confirm('データが存在しません．');
                window.location.href = 'schedule_list.php';
                </script>";
                exit();
            }
        } else {
            echo "クエリの準備に失敗しました: " . $mysqli->error;
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
    $smarty->assign("data_list", $data_list);

    $smarty->assign("error_message", $error_message);
    $smarty->assign("schedule_list", $schedule_list);
    $smarty->display("adjustSchedule.html"); // テンプレートを表示

?>
