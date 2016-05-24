<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/24/2016
 * Time: 2:22 AM
 */
$internId = $_GET['id'];
$title = 'Interns';
$section = 'index';
include '../inc/head.php';
$row;
try {
    $stmt = $dbh->prepare("select student.* from student , student_internship where "
        . "student_internship.student_id = student.student_id and "
        . "student_internship.internship_id ='$internId'");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $row = $stmt->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
    <div class="container">

        <h1 class="page-header text-center">List of Students in <?php echo $internId; ?></h1>
        <?php if ($row == 0) { ?>
            <h1 class="text-center">No Students in this Offer</h1>
        <?php } else { ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>NRIC</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($results as $result) {
                    echo '<tr>'
                        . '<td>' . $result['student_id'] . '</td>'
                        . '<td>' . $result['student_name'] . '</td>'
                        . '<td>' . $result['student_nric'] . '</td>'
                        . '</tr>';
                }
                ?>
                </tbody>
            </table>
        <?php } ?>

    </div>

<?php include ROOT_PATH . 'inc/footer.php'; ?>