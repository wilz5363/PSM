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

$viewOffersStmt = $dbh->prepare('');


?>

<div class="container">
    <h1 class="page-header text-center">Offers</h1>
    <div class="row">
<!--        --><?php
//        if ($location_count == 0) {
//            echo '<h3 class="text-center">No location added in profile</h3>';
//        } else {
//            foreach ($locations as $location) { ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card card-block">
                        <h3 class="card-title">Title</h3>
                        <p class="card-text">Description</p>
                        <a href="<?php echo BASE_URL . 'ind_adv/viewOffers.php?location=' . $location['location_id']; ?>"
                           class="btn btn-primary">View Offers</a>
                        <a href="#" class="btn btn-success">Edit Address</a>
                    </div>
                </div>
<!--                --><?php
//            }
//        }
//        ?>
    </div>
</div>



<?php include ROOT_PATH.'inc/footer.php';?>
