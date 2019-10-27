<?php
echo ".....\n".PHP_EOL;
$host="mysql"; 
echo "host= " .$host.PHP_EOL;

$root="root"; 
$root_password="123456"; 



    try {
        $dbh = new PDO("mysql:host={$host};dbname=BOOKS;port=3306", $root, $root_password);

        $dbh->exec("select * from `book`;") 
        or die(print_r($dbh->errorInfo(), true));

    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }