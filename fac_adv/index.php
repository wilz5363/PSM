<?php ;
$getStudent = $dbh->query("select student.student_name, student.student_id from student where lecturer_in_charge = 'L031310166'")->fetchAll(PDO::FETCH_ASSOC);
$students="";
foreach($getStudent as $data){
    $students[] = $data;
}
?>

<div class="page-header">
    <h1>Faculty Adviser</h1>
</div>

<div class="row">
    <?php foreach ($students as $student) { ?>
        <div class="col-md-6 col-sm-6">
            <div class="card card-block">
                <h3 class="card-title">Student Name: <?php echo $student['student_name'];?></h3>
                <p class="card-text">Matric No: <?php echo $student['student_id'];?></p>
                <p class="card-text">Company Name: </p>
                <p class="card-text">State: </p>
                <a href="<?php echo BASE_URL.'log/index.php?id=B031310166';?>" class="btn btn-primary">View Students</a>
            </div>
        </div>
        <?php
    } ?>
</div>