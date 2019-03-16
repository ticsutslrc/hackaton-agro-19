<?php
/**
 * Created by PhpStorm.
 * User: Xerardoo
 * Date: 3/15/2019
 * Time: 10:05 PM
 */

class Connection
{
    static function get()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "hackaton19";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
        if (!$conn) throw new Exception("Connection failed");
        return $conn;
    }
}