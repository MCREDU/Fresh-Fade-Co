<?php
    $dsn = 'mysql:host=localhost;port=3307;dbname=barbershop;charset=utf8';
    $user = 'root';
    $pass = '';  // if root has no password in XAMPP

    $options = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    try {
        $con = new PDO($dsn, $user, $pass, $options);
        echo "✅ Connection successful!";
    } catch (PDOException $ex) {
        echo "❌ Failed to connect with database! " . $ex->getMessage();
        die();
    }
?>
