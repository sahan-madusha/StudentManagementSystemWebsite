<?php

class Database{

    public static $connection;
    public static function setConnection(){

        if(!isset(Database::$connection)){
            Database::$connection = new mysqli("localhost","root","sHn@2744MDuSA@sql.com","studentdb","3308");
        }
    }

    //iud
    public static function iud($q){
        Database::setConnection();
        $rs = Database::$connection->query($q);
        return $rs;
    }

    //search
    public static function search($q){
        Database::setConnection();
        $rset = Database::$connection->query($q);
        return $rset;
    }

}

?>