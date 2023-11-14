<?php

class Dbh 
{

    protected function connect() {
        try {
            $username = "homebasedb";
            $password = "homebasedb";
            $dbh = new PDO('mysql:host=localhost;dbname=homebasedb', $username, $password);
            return $dbh;

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
