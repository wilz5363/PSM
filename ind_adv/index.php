<?php ;
$getStudent = $dbh->prepare("call show_stud_emp_proc(?)");
$getStudent->bindParam(1, $_SESSION['user']);
$getStudent->execute();
$result = $getStudent->fetchAll(PDO::FETCH_ASSOC);
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
                <?php $stud_id = $student['student_id'];?>
                <a href="<?php echo BASE_URL.'log/index.php?id='.$stud_id;?>" class="btn btn-primary">View Students</a>
            </div>
        </div>
        <?php
    } ?>
</div>