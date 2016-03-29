<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/13/2016
 * Time: 9:50 AM
 */
require_once '../inc/constants.php';
$title = 'Daily Log';
$section = 'log';
include ROOT_PATH . 'inc/header.php';
echo '<link rel="stylesheet" href="../libs/css/responsive-calendar.css">';
include ROOT_PATH . 'inc/navigation.php';
?>
<div class="container">
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




<?php
include ROOT_PATH . 'inc/footer.php';
?>
