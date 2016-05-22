<?php
try{
    $locations = $dbh->prepare("call utem_intern.show_all_location('" . $_SESSION['user'] . "');");
    $locations->setFetchMode(PDO::FETCH_ASSOC);
    $locations->execute();
    $location_count = $locations->rowCount();
}catch(PDOException $e){
    echo $e->getMessage();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $location_id = validate($_POST['locationIdInput']);
    $location_address= validate($_POST['locationAddressInput']);
    $location_postcode = validate($_POST['locationPostcodeInput']);

    try{
        $stmt = $dbh->query("insert into company_location VALUES ('testing2', 'testing1', 'MP1', 'RC002')");
    }catch(PDOException $e){
        if($e->getCode() == '23000'){
            echo '<div class="alert">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            	<strong>Warning! </strong> Branch ID/ address has been used before.
            </div>';
        }
    }


}










?>

<div class="page-header text-center">
    <h1>Industry Adviser</h1>
</div>

<div class="row">
    <?php
    if ($location_count == 0) {
        echo '<h3 class="text-center">No location added in profile</h3>';
    } else {
        foreach ($locations as $location) { ?>
            <div class="col-md-4 col-sm-6">
                <div class="card card-block">
                    <h3 class="card-title"><?php echo $location['state_name']; ?></h3>
                    <p class="card-text">Address: <?php echo $location['location_address']; ?></p>
                    <p class="card-text">Postcode: <?php echo $location['poscode_number']; ?></p>
                    <p class="card-text">City: <?php echo $location['city_name']; ?></p>
                    <a href="<?php echo BASE_URL . 'viewinterns.php?location=' . $location['location_id']; ?>"
                       class="btn btn-primary">View Interns</a>
                    <a href="#" class="btn btn-success">Edit Address</a>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>


<a class="btn btn-primary" data-toggle="modal" href="#modal-id"
   style="bottom:5%; right: 5%;position: fixed; border-radius: 50%; font-size: 45px; width:70px;height:70px;text-align: center;line-height:60px">+</a>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="" method="post"  role="form">
                    <legend>Insert New Location</legend>
                    <div class="form-group">
                        <label for="locationId">Branch ID: </label>
                        <input type="text" class="form-control" name="locationIdInput" id="locationId" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="locationAddress">Address: </label>
                        <input type="text" class="form-control" name="locationAddressInput" id="locationAddress" required>
                    </div>
                    <div class="form-group">
                        <label for="locationPostcode">Postcode: </label><span id="location_error"></span>
                        <input type="number" class="form-control" name="locationPostcodeInput" id="locationPostcode" onblur="searchPostcode()" required>
                    </div>
                    <div class="form-group">
                        <label for="locationCity">City: </label>
                        <input type="text" class="form-control" name="locationCityInput" id="locationCity" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="locationState">State: </label>
                        <input type="text" class="form-control" name="locationStateInput" id="locationState" readonly required>
                    </div>
                	<button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
