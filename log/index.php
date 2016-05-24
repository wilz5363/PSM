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

if($_SESSION['userType'] == 'STUDENT'){
    try {
        $logs = $dbh->prepare("call get_log_student(:stud_id)");
        $logs->bindParam(':stud_id', $_SESSION['user']);
        $logs->execute();
        $allLogs = $logs->fetchAll(PDO::FETCH_ASSOC);
        foreach($allLogs as $data){
            $datas[] = $data;
        }
        $logs->closeCursor();

    }catch(PDOException $e){
        echo $e->getMessage();
    }

    try{
        $getSessions = $dbh->prepare("call get_session_dates(?)");
        $getSessions->bindParam(1, $_SESSION['user']);
        $getSessions->execute();
        $sessionDates = $getSessions->fetchAll(PDO::FETCH_ASSOC);
        foreach($sessionDates as $date){
            $dates[] = $date['session_start_date'];
            $dates[] = $date['session_end_date'];
        }
        $getSessions->closeCursor();
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    try{

        $stmt = $dbh->prepare("call get_weekends(?)");
        $stmt->bindParam('1',$_GET['user']);
        $stmt->execute();

        foreach ($stmt as $s) {
            $weekend[] = $s['weekend_day'];
        }
        $stmt->closeCursor();
    }catch(PDOException $e){
        $e->getMessage();
    }

}
else if($_SESSION['userType'] == 'LECTURER' and isset($_GET['id'])){

    $stud_id = $_GET['id'];

    try{

        $stmt = $dbh->prepare("call get_weekends(?)");
        $stmt->bindParam('1',$_GET['id']);
        $stmt->execute();

        foreach ($stmt as $s) {
            $weekend[] = $s['weekend_day'];
        }
        $stmt->closeCursor();
    }catch(PDOException $e){
        $e->getMessage();
    }

    try{
        $getSessions = $dbh->prepare("call get_session_dates(?)");
        $getSessions->bindParam(1, $_GET['id']);
        $getSessions->execute();
        $sessionDates = $getSessions->fetchAll(PDO::FETCH_ASSOC);
        foreach($sessionDates as $date){
            $dates[] = $date['session_start_date'];
            $dates[] = $date['session_end_date'];
        }
        $getSessions->closeCursor();
    }catch(PDOException $e){
        echo $e->getMessage();
    }


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
    <div class="pull-right">
        <span class="logged_badge"></span> Logged
        <span class="sick_leave_badge"></span> Sick Leave
        <span class="today_badge"></span>Today
        <span class="session_range_badge"></span> Invalid Date
        <span class="weekend_badge"></span> Weekends
    </div>
</div>
<?php
include ROOT_PATH . 'inc/footer.php';
?>
