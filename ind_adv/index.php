<?php ;
$getStudent = $dbh->prepare("call show_stud_emp_proc(?)");
$getStudent->bindParam(1, $_SESSION['user']);
$getStudent->execute();
$result = $getStudent->fetchAll(PDO::FETCH_ASSOC);
$getStudent->closeCursor();
$students="";
foreach($result as $data){
    $students[] = $data;
}
?>

<div class="page-header">
    <h1>Industry Adviser</h1>
</div>

<div class="row">
    <?php foreach ($students as $student) { ?>
        <div class="col-md-6 col-sm-6">
            <div class="card card-block">
                <h3 class="card-title">Student Name: <?php echo $student['student_name'];?></h3>
                <p class="card-text"><b>Matric No:</b> <?php echo $student['student_id'];?></p>
                <p class="card-title"><b>NRIC:</b> <?php echo $student['student_nric'];?></p>
                <p class="card-text"><b>Contact No:</b> <?php echo $student['contact_no'];?></p>
                <p class="card-text"><b>Faculty Advisor:</b> <?php echo $student['lecturer_name'];?></p>
                <p class="card-text"><b>Faculty Advisor H/P No.:</b> <?php echo $student['phone_no'];?></p>
                <?php $stud_id = $student['student_id'];?>
                <?php
                $getDateDiff = $dbh->prepare('select utem_intern.cal_diff_date_func(?) as date_diff');
                $getDateDiff->bindParam(1, $student['student_id']);
                $getDateDiff->execute();
                $dateDiff = $getDateDiff->fetch(PDO::FETCH_ASSOC);
                $getDateDiff->closeCursor();
                ?>
                <p class="card-text text-danger"><b>Day of No Log: </b> <?php echo $dateDiff['date_diff'] ?> day(s)
                </p>
                <?php
                $get_late_log_count = $dbh->prepare('CALL cal_late_log_proc(?,@late_count)');
                $get_late_log_count->bindParam(1, $student['student_id']);
                $get_late_log_count->execute();
                $get_late_log_count->closeCursor();

                $result_count = $dbh->query('SELECT @late_count')->fetch(PDO::FETCH_ASSOC);
                ?>
                <p class="text-danger card-text"><b>No. Late Log(s):</b> <?php echo $result_count['@late_count']; ?>
                    day(s)</p>
                <a href="<?php echo BASE_URL.'log/index.php?id='.$stud_id;?>" class="btn btn-primary">View Log Records</a>
                <a href="<?php echo BASE_URL.'student/stat.php?id='.$stud_id?>" class="btn btn-default">View Overall Status</a>
            </div>
        </div>
        <?php
    } ?>
</div>