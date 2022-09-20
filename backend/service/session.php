<?php
class session {
    public function __construct() {
        session_start();
        error_reporting(0);
        ini_set('display_errors', 0);
        define('DB_CHARSET', 'utf8mb4');
        setlocale(LC_TIME, 'ro_RO');
        header("Content-type: text/html; charset=utf-8");
    }
    public function check_autenfic() {
        if((isset($_SESSION['user']))&&($_SESSION['user']!=="")&&($_SESSION['tipsubunitate']!==""))
            return TRUE;
    }
    public function check_admin() {
        if($_SESSION['user']==="admin")
            return TRUE;
    }
    public function check_sesiune() {
        if(($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) || ($_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT']))
            return TRUE;
    }
}
?>
