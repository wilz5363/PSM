<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/13/2016
 * Time: 9:50 AM
 */

$title = 'Daily Log';
$section = 'log';
include '../inc/head.php';
try {
    $logs = $dbh->query("select dailylog_date, dailylog_status from dailylog where student_id = 'B031310166'")->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo $e->getMessage();
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
