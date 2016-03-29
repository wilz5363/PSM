<?php
require_once '../inc/constants.php';
$title = 'Daily Log';
$section = 'log';

if (!isset($_GET['date']) || trim($_GET['date'] === '')) {
    header("Location:" . ROOT_PATH . "log/");
} else {

    $selectedDate = $_GET['date'];

}
if (isset($_POST['submit'])) {

} else if (isset($_POST['cancel'])) {
    header('Location:' . BASE_URL . 'log');
}


include ROOT_PATH . 'inc/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center">Daily Log</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" method="post" action="daily.php">
                <div class="form-group">
                    <label for="inputTitle" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputTitle" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="showDate" class="col-sm-2 control-label">Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="showDate" value="<?php echo $selectedDate; ?>"
                               readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="inputDescription"
                                  placeholder="Description..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="submit">Submit</button>
                        <button class="btn btn-danger" name="cancel">Cancel</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<?php
include ROOT_PATH . 'inc/footer.php';
?>
