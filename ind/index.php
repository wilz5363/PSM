<?php
$locations;
try {
    $getLocations = $dbh->prepare("call utem_intern.show_all_location('" . $_SESSION['user'] . "')");
    $getLocations->execute();
    $result = $getLocations->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $location) {
        $locations[] = $location;
    }

    $location_count = $getLocations->rowCount();
    $getLocations->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_id = validate($_POST['locationIdInput']);
    $location_address = validate($_POST['locationAddressInput']);
    $location_city = $_POST['citySelectionInput'];

    try {
        $stmt = $dbh->prepare("call utem_intern.insert_location_proc(?, ?, ?, ?)");
        $stmt->bindParam(1, $location_id);
        $stmt->bindParam(2, $location_address);
        $stmt->bindParam(3, $_SESSION['user']);
        $stmt->bindParam(4, $location_city);
        $stmt->execute();

        header('location:index.php');

    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            echo '<div class="alert">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            	<strong>Warning! </strong> Branch ID/ address has been used before.
            </div>';
        } else {
            echo '<div class="alert">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            	<strong>Warning! </strong>' . $e->getMessage()
                . '</div>';
        }
    }


}


?>
<ol class="breadcrumb">
	<li class="active">
		Branches
	</li>
</ol>
<div class="page-header text-center">
    <h1>Welcome</h1>
</div>

<div class="row">
    <?php
    if ($location_count == 0) {
        echo '<h3 class="text-center">No location added in profile</h3>';
    } else {
        foreach ($locations as $location) { ?>
            <div class="col-md-3 col-sm-5 col-xs-12 col-sm-offset-1 col-sm-offset-2 col">
                <div class="card card-block">
                    <h3 class="card-title"><?php echo $location['state_name']; ?> <span class="small"><?php echo strtoupper($location['location_id']); ?></span></h3>
                    <p class="card-text">Address: <?php echo $location['location_address']; ?></p>
                    <p class="card-text">Postcode: <?php echo $location['poscode_number']; ?></p>
                    <p class="card-text">City: <?php echo $location['city_name']; ?></p>
                    <p class="card-text">No. of Offer: <?php echo $location['intern_no']; ?></p>
                    <p class="card-text">No. of Interns: <?php echo $location['stud_num']; ?></p>
                    <a href="<?php echo BASE_URL . 'ind/viewOffers.php?location=' . $location['location_id']; ?>"
                       class="btn btn-primary">View Offers</a>
                    <a href="#" class="btn btn-success">Edit Address</a>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
