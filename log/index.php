<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/13/2016
 * Time: 9:50 AM
 */

$title = 'Daily Log';
$section = 'log';
$subsection = 'dailog';
include '../inc/head.php';

$weekend;
$stud_id;

try {
    $comp_id = 'testing with app2';
    $stmt = $dbh->prepare("call get_weekends(:company_id)");
    $stmt->bindParam(':company_id',$comp_id);
    $stmt->execute();

    foreach ($stmt as $s) {
        $weekend[] = $s['weekend_day'];
    }
    $stmt->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}

if($_SESSION['userType'] == 'STUDENT'){
    try {
        $logs = $dbh->prepare("call get_log_student(:stud_id)");
        $logs->bindParam(':stud_id', $_SESSION['user']);
        $logs->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
else if($_SESSION['userType'] == 'LECTURER' and isset($_GET['id'])){

    $stud_id = $_GET['id'];

    try{
        $lec_stmt = $dbh->prepare("call get_log_lecturer(:stud_id)");
        $lec_stmt->bindParam(':stud_id',$_GET['id']);
        $lec_stmt->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}else{
    echo 'smth wrong';
    exit();
}
?>
<div class="container" xmlns="http://www.w3.org/1999/html">
    <!-- Responsive calendar - START -->
    <div class="responsive-calendar">
        <div class="controls">
            <a class="pull-left" data-go="prev">
                <div class="btn btn-primary">Prev</div>
            </a>
            <h4><span data-head-year></span> <span data-head-month></span></h4>
            <a class="pull-right" data-go="next">
                <div class="btn btn-primary">Next</div>
            </a>
        </div>
        <hr/>
        <div class="day-headers">
            <div class="day header">Mon</div>
            <div class="day header">Tue</div>
            <div class="day header">Wed</div>
            <div class="day header">Thu</div>
            <div class="day header">Fri</div>
            <div class="day header">Sat</div>
            <div class="day header">Sun</div>
        </div>
        <div class="days" data-group="days">

        </div>
    </div>
    <!-- Responsive calendar - END -->
</div>

<p><div class="logged_badge"></div> Logged </p>
<?php
include ROOT_PATH . 'inc/footer.php';
?>
