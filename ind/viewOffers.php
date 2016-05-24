<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/23/2016
 * Time: 12:37 AM
 */
$location_id = $_GET['location'];
$title = 'Offers';
$section = 'index';
include '../inc/head.php';

$viewOffersStmt = $dbh->prepare('call utem_intern.show_all_inter_offer(?)');
$viewOffersStmt->bindParam(1, $location_id);
$viewOffersStmt->execute();
$offerResult = $viewOffersStmt->fetchAll(PDO::FETCH_ASSOC);
$offerResultCount = $viewOffersStmt->rowCount();
?>

<div class="container">
    <h1 class="page-header text-center">Offers</h1>
    <div class="row">
        <?php
        if ($offerResultCount == 0) {
            echo '<h3 class="text-center">No location added in profile</h3>';
        } else {
            foreach ($offerResult as $location) { ?>
                <div class="col-md-3 col-sm-5 col-xs-12 col-sm-offset-1 col-sm-offset-2 col">
                    <div class="card card-block">
                        <h3 class="card-title">Title: <?php echo $location['internship_title'];?></h3>
                        <p class="card-text">Description: <?php echo $location['internship_desc'];?></p>
                        <p class="card-text">No of Interns: <?php echo $location['stud_amount'];?></p>
                        <a href="<?php echo BASE_URL . 'ind/viewInterns.php?id=' . $location['internship_id']; ?>"
                           class="btn btn-primary">View Students</a>
                        <a href="#" class="btn btn-success">Edit Address</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>



<?php include ROOT_PATH.'inc/footer.php';?>
