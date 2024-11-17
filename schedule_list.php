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

    // 現在の年月
    $currentMonth = date('Y-m');

    // 現在の週
    $currentWeek = date('Y-\WW');
    $currentWeek = date('Y-\WW', strtotime('Monday this week'));

    // 変更: MySQLに接続する
    $mysqli = new mysqli("localhost", "root", "root", "webReport_01");
    $mysqli->set_charset("utf8");

    if (isset($_POST["month"])) {
        $selected_month = $_POST['month'];
        $start_date = $selected_month . '-01';
        $end_date = date('Y-m-t', strtotime($start_date));
    
        $stmt = $mysqli->prepare("SELECT * FROM schedule WHERE begin >= ? AND begin <= ? ORDER BY begin ASC");
        $stmt->bind_param("ss", $start_date, $end_date);
        $stmt->execute();
    
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $schedule_list[] = $row;
        }
    } elseif (isset($_POST["week"])) {
        $selected_week = $_POST['week'];
        list($year, $week) = explode('-W', $selected_week);
    
        // 該当週の月曜日を計算
        $start_date = (new DateTime())->setISODate((int)$year, (int)$week, 1)->format('Y-m-d');
        // 該当週の日曜日を計算
        $end_date = (new DateTime($start_date))->modify('+6 days')->format('Y-m-d');
    
        // データベースクエリ（DATE() を使用して日付部分だけを比較）
        $stmt = $mysqli->prepare("
            SELECT * 
            FROM schedule 
            WHERE DATE(begin) >= ? AND DATE(begin) <= ? 
            ORDER BY begin ASC
        ");
        $stmt->bind_param("ss", $start_date, $end_date);
        $stmt->execute();
    
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $schedule_list[] = $row;
        }
    } else {
        $result = $mysqli->query("SELECT * FROM schedule ORDER BY begin DESC");
        while ($row = $result->fetch_array()) {
            $schedule_list[] = $row;
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
    $smarty->assign('currentMonth', $currentMonth);
    $smarty->assign('currentWeek', $currentWeek);

    $smarty->assign("error_message", $error_message);
    $smarty->assign("schedule_list", $schedule_list);
    $smarty->display("ScheduleList.html"); // テンプレートを表示

?>
