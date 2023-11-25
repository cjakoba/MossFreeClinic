<?php

class Dbh 
{

    protected function connect() {
        try {
            $host = "localhost";
            $username = "homebasedb";
            $password = "homebasedb";
            $dbname = "homebasedb";
            $dsn = "mysql:host=$host;dbname=$dbname";
            return new PDO($dsn, $username, $password, [PDO::ATTR_EMULATE_PREPARES=>false]);

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
