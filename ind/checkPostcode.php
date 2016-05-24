<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/19/2016
 * Time: 1:20 PM
 */
include '../inc/constants.php';
include ROOT_PATH . 'inc/connectDB.php';
$q = $_GET['q'];
try{
    $result = $dbh->query("call utem_intern.postcodeInput_proc('".$q."')")->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}catch(PDOException $e){
    echo $e->getMessage().$q;
}
