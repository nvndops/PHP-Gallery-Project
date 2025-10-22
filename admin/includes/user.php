<?php


class User
{

    public $id;
    public $username;
    public $password;
    public $firstName;
    public $lastName;


    public static function findThisQuery($sql)
    {

        global $database;
        $resultSet = $database->query($sql);
        $theObjectArray = array();

        while ($row = mysqli_fetch_array($resultSet)) {
            $theObjectArray[] = self::instantiation($row);
        }

        return $theObjectArray;

    }


    public static function verify_user($username, $password)
    {
        global $database;

        $username = $database->escapeString($username);
        $password = $database->escapeString($password);

        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $resultArray = self::findThisQuery($sql);

        return !empty($resultArray) ? array_shift($resultArray) : false;
    }

    public static function findAllUsers()
    {

        return self::findThisQuery("SELECT * FROM users");
    }


    public static function findUserById($userId)
    {
        global $database;

        $resultArray = self::findThisQuery("SELECT * FROM users WHERE id=$userId LIMIT 1");

        return !empty($resultArray) ? array_shift($resultArray) : false;

        // if(!empty($resultsArray)) {
        //     $firstItem = array_shift($resultArray);

        //     return $firstItem;
        // } else {

        //     return false;
        // }

    }

    public static function instantiation($userRecords)
    {
        $theObject = new self;

        // $theObject->id = $foundUser['id'];
        // $theObject->username = $foundUser['username'];
        // $theObject->password = $foundUser['password'];
        // $theObject->firstName = $foundUser['first_name'];
        // $theObject->lastName = $foundUser['last_name'];

        foreach ($userRecords as $userRecordField => $userRecord) {

            if ($theObject->hasTheRecordField($userRecordField)) {

                $theObject->$userRecordField = $userRecord;

            }
        }




        return $theObject;
    }

    private function hasTheRecordField($userRecordField)
    {

        $objectProperties = get_object_vars($this);

        return array_key_exists($userRecordField, $objectProperties);

    }


}



?>