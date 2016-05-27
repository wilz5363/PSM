<?php include '../inc/constants.php';
include '../inc/connectDB.php';

$date=$_GET['d'];
$matric = $_GET['m'];
try{
    $getImage = $dbh->prepare('select dailylog_img from dailylog where student_id = ? and dailylog_date = ?');
    $getImage->bindParam(1, $matric);
    $getImage->bindParam(2,$date);
    $getImage->execute();
    $imageResult = $getImage->fetch(PDO::PARAM_LOB);
    header("Content-type: image/jpg");
    echo $imageResult['dailylog_img'];
}catch(PDOException $e){
    echo $e->getMessage();
}