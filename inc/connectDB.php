<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2016
 * Time: 3:43 PM
 */
ini_set('display_errors', 'On');

$dsn = 'mysql:host=localhost;port=3306;dbname=utem_intern';
$username = 'root';
$password = '';

try {

    $dbh = new PDO($dsn, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exp) {
    echo 'Connection to database is not successful.' . $exp->getMessage();
    die();
}
