<?php


class User
{

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


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

    protected function properties()
    {


        // return get_object_vars($this);

        $properties = array();

        foreach (self::$db_table_fields as $db_field) {

            if (property_exists($this, $db_field)) {

                $properties[$db_field] = $this->$db_field;

            }

        }

        return $properties;
    }

    protected function clean_properties() {
        global $database;
        $clean_properties = array();

        foreach($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escapeString($value);
        }

        return $clean_properties;
    }


    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }


    public function create()
    {
        global $database;

        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . self::$db_table . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

        if ($database->query($sql)) {

            $this->id = $database->insert_id();
            return true;

        } else {

            return false;
        }

    }

    public function update()
    {
        global $database;

        $properties = $this->clean_properties();
        $properties_pair = array();

        foreach ($properties as $key => $value) {

            $properties_pair[] = "{$key}='{$value}'";

        }

        $sql = "UPDATE " . self::$db_table . " SET "
            . implode(", ", $properties_pair) .
            " WHERE id=" . $database->escapeString($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }

    public function delete()
    {

        global $database;

        $sql = "DELETE FROM " . self::$db_table . " WHERE id=" . $database->escapeString($this->id) . " LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }


}



?>