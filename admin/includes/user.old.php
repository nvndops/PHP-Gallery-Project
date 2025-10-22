<?php


class User {
     public static function findAllUsers() {

        global $database;

        $resultSet = $database->query("SELECT * FROM users");

        return $resultSet;
    } 
    



    public static function findUserById($userId) {
        global $database;

        $resultSet = $database->query("SELECT * FROM users WHERE id=$userId LIMIT 1");

        $foundUser = mysqli_fetch_array($resultSet);

        return $foundUser;
    }


    public static function findThisQuery($sql) {

        global $database;

        $resultSet = $database->query($sql);

        return $resultSet;

    }



}



?>