<?php



class Db_object
{

    protected static $db_table = "users";

    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');

    public static function findAll()
    {

        return static::findByQuery("SELECT * FROM " . static::$db_table . " ");
    }


    public static function findById($userId)
    {
        global $database;

        $resultArray = static::findByQuery("SELECT * FROM " . static::$db_table . " WHERE id=$userId LIMIT 1");

        return !empty($resultArray) ? array_shift($resultArray) : false;

        // if(!empty($resultsArray)) {
        //     $firstItem = array_shift($resultArray);

        //     return $firstItem;
        // } else {

        //     return false;
        // }

    }

    public static function findByQuery($sql)
    {

        global $database;
        $resultSet = $database->query($sql);
        $theObjectArray = array();

        while ($row = mysqli_fetch_array($resultSet)) {
            $theObjectArray[] = static::instantiation($row);
        }

        return $theObjectArray;

    }

    public static function instantiation($userRecords)
    {

        $calling_class = get_called_class();

        $theObject = new $calling_class;



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

        foreach (static::$db_table_fields as $db_field) {

            if (property_exists($this, $db_field)) {

                $properties[$db_field] = $this->$db_field;

            }

        }

        return $properties;
    }

    protected function clean_properties()
    {
        global $database;
        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
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

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
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

        $sql = "UPDATE " . static::$db_table . " SET "
            . implode(", ", $properties_pair) .
            " WHERE id=" . $database->escapeString($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }

    public function delete()
    {

        global $database;

        $sql = "DELETE FROM " . static::$db_table . " WHERE id=" . $database->escapeString($this->id) . " LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }



}





?>