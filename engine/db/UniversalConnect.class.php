<?php
include_once 'IConnectInfo.interface.php';

class UniversalConnect implements IConnectInfo {
    private static $server = IConnectInfo::HOST;
    private static $currentDB = IConnectInfo::DBNAME;
    private static $user = IConnectInfo::UNAME;
    private static $pass = IConnectInfo::PW;
    private static $hookup;
    
    public static function doConnect() {
        try {
            self::$hookup = mysqli_connect(self::$server, self::$user, self::$pass, self::$currentDB);
            
            return self::$hookup;
            
        } catch (Exception $ex) {
            print 'Something went wrong: ' . $e->getMessage();

        }
    }
}

?>