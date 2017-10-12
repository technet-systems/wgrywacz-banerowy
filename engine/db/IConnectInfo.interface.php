<?php

interface IConnectInfo {
    const HOST = "CHANGE_ME";
    const UNAME = "CHANGE_ME";
    const PW = "CHANGE_ME";
    const DBNAME = "CHANGE_ME";
    
    public static function doConnect();
}

?>
