<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/31/2016
 * Time: 7:22 PM
 */
$title = $_GET['location'];
$section = 'index';
$title = "Edit Location";
include '../inc/head.php';
$location_id = $_GET['location'];
try {
    $getLocation = $dbh->prepare("call get_one_location_detail(?,?)");
    $getLocation->bindParam(1, $location_id);
    $getLocation->bindParam(2, $_SESSION['user']);
    $getLocation->execute();
    $locationResults = $getLocation->fetch(PDO::FETCH_ASSOC);
    $resultCount = $getLocation->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
                <?php
                if ($resultCount > 0) {
                    ?>
                    <form action="" method="post" role="form">
                        <legend>Edit Location</legend>

                        <div class="form-group">
                            <label for="locationId">Location ID: </label>
                            <input type="text" class="form-control" name="locationIdInput" id="locationId"
                                   value="<?php echo htmlspecialchars($locationResults['location_id']) ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="address">Address: </label>
                            <input type="text" class="form-control" name="addressInput" id="address"
                                   value="<?php echo htmlspecialchars($locationResults['location_address']) ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="locationPostcode">Poscode</label>
                            <input type="number" class="form-control" name="postcodeInput" id="locationPostcode"
                                   value="<?php echo htmlspecialchars($locationResults['poscode_number']) ?>"
                                   onblur="searchPostcode()" required><span class="text-warning"
                                                                            id="location_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="citySelection">City: </label>
                            <select name="cityInput" id="citySelection" class="form-control" readonly disabled required>
                                <option
                                    value="<?php echo htmlspecialchars($locationResults['city_id']) ?>"><?php echo htmlspecialchars($locationResults['city_name']) ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="state">State: </label>
                            <input type="text" class="form-control" name="stateInput" id="locationState"
                                   value="<?php echo htmlspecialchars($locationResults['state_name']) ?>" readonly>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <a href="<?php echo BASE_URL;?>" class="btn btn-danger btn-block">Back</a>
                        </div>
                    </form>
                    <?php
                } else {
                    echo '<h1 class="text-danger text-center page-header">This company has no such location</h1>';
                }
                ?>
            </div>
        </div>
    </div>
<?php
include ROOT_PATH . 'inc/footer.php'; ?>