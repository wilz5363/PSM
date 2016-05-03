<?php
$locations = $dbh->prepare("call utem_intern.show_all_location('" . $_SESSION['user'] . "');");
$locations->setFetchMode(PDO::FETCH_ASSOC);
$locations->execute();
?>

<div class="page-header text-center">
    <h1>Industry Adviser</h1>
</div>

<div class="row">
    <?php
    foreach ($locations as $location) { ?>
        <div class="col-md-4 col-sm-6">
            <div class="card card-block">
                <h3 class="card-title"><?php echo $location['state_name']; ?></h3>
                <p class="card-text">Address: <?php echo $location['location_address'];?></p>
                <p class="card-text">Postcode: <?php echo $location['poscode_number'];?></p>
                <p class="card-text">City: <?php echo $location['city_name'];?></p>
                <a href="<?php echo BASE_URL.'viewinterns.php?location='.$location['location_id'];?>" class="btn btn-primary">View Interns</a>
                <a href="#" class="btn btn-success">Edit Address</a>
            </div>
        </div>
        <?php
    }
    ?>
</div>
