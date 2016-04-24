<?php
$title = 'Daily Log';
$section = 'dailylog';
include '../inc/head.php';
$selectedDate;
if (!isset($_GET['date']) || trim($_GET['date'] === '')) {
    header("Location:" . ROOT_PATH . "log/");
} else {
    $selectedDate = $_GET['date'];
    try {
        $logRecord = $dbh->query("select * from dailylog where dailylog_date ='" . $selectedDate . "' and student_id = '" . $_SESSION['user'] . "'")->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        $title = $_POST['titleInput'];
        $desc = $_POST['descInput'];

        try {
            $stmt = $dbh->prepare('INSERT INTO dailylog (student_id, dailylog_date, dailylog_title, dailylog_content) VALUES (?,?,?,?)');
            $stmt->bindParam(1, $_SESSION['user']);
            $stmt->bindParam(2, $selectedDate);
            $stmt->bindParam(3, $title);
            $stmt->bindParam(4, $desc);
            $stmt->execute();

            header('location:daily.php?date='.$selectedDate);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    else if (isset($_POST['cancel'])) {
        header('Location:' . BASE_URL . 'log');
    }


}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center">Daily Log</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" method="post" action="">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="titleInput" id="title" placeholder="Title"
                               value="<?php echo htmlspecialchars($logRecord['dailylog_title']); ?>" <?php if (isset($logRecord['dailylog_title'])) {
                            echo 'readonly';
                        } ?> required>
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
                    <label for="desc" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" name="descInput" id="desc"
                                  placeholder="Description..." <?php if (isset($logRecord['dailylog_content'])) {
                            echo 'readonly';
                        } ?> required><?php echo htmlspecialchars($logRecord['dailylog_content']); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default"
                                name="submit" <?php if (isset($logRecord['dailylog_status'])) {
                            echo 'disabled';
                        } ?>>Submit
                        </button>
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
