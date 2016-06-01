<?php ;


try {


    $getStudent = $dbh->prepare("call get_list_students(?)");
    $getStudent->bindParam(1, $_SESSION['user']);
    $getStudent->execute();
    $results = $getStudent->fetchAll(PDO::FETCH_ASSOC);
    $result_count = $getStudent->rowCount();
    $students = "";
    foreach ($results as $data) {
        $students[] = $data;
    }
} catch (PDOException $e) {
    echo 'smth wrong.' . $e->getMessage();
}

?>

<div class="page-header">
    <h1>Faculty Adviser</h1>
</div>

<div class="row">
    <?php if ($result_count > 0) { ?>
        <?php foreach ($students as $student) { ?>
            <div class="col-md-6 col-sm-6">
                <div class="card card-block">
                    <h3 class="card-title">
                        Name: <?php echo $student['student_name']; ?> <?php if (isset($student['session_id'])){ ?><span
                            class="small">Session (<?php echo $student['session_id']; ?>)</span></h3>
                    <p class="card-text"><b>Matric No: </b><?php echo $student['student_id']; ?></p>
                    <p class="card-text"><b>Company Name: </b> <?php echo $student['company_name']; ?></p>
                    <p class="card-text"><b>Location: </b> <?php echo $student['location_address']; ?></p>
                    <p class="card-text"><b>Internship Title: </b> <?php echo $student['internship_title']; ?></p>
                    <?php $stud_id = $student['student_id']; ?>
                    <a href="<?php echo BASE_URL . 'log/index.php?id=' . $stud_id; ?>" class="btn btn-primary">View
                        Students</a><?php
                    } else {
                        echo '<h3 class="text-center text-danger">Student has not been offered yet.</h3>';
                    } ?>

                </div>
            </div>
            <?php
        }
    } else {
        echo '<h1 class="text-danger page-header text-center">No Current Active Students</h1>';
    }
    $getStudent->closeCursor(); ?>
</div>