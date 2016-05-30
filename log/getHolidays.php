<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/26/2016
 * Time: 10:15 PM
 */
require_once "../inc/connectDB.php";
$holidays;
$query = $dbh->query("select d,m,y,holidayDescr  from calendar_table where calendar_table.holidayDescr like '%Day'")->fetchAll(PDO::FETCH_ASSOC);
foreach($query as $data){
    $holidays[] = $data;
}

