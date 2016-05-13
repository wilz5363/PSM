<?php
$title = 'Daily Log';
$section = 'dailylog';
include '../inc/head.php';
$selectedDate;
if (!isset($_GET['date']) || trim($_GET['date'] === '')) {
    header("Location:" . ROOT_PATH . "log/");
} else {
    $selectedDate = $_GET['date'];
    if ($_SESSION['userType'] == 'STUDENT') {
        try {
            $logRecord = $dbh->query("call get_dailylog_stud('" . $_SESSION['user'] . "','" . $selectedDate . "')")->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else if ($_SESSION['userType'] == 'LECTURER' AND isset($_GET['id'])) {
        try {
            $logRecord = $dbh->query("call get_dailylog_lec('" . $_GET['id'] . "','" . $selectedDate . "')")->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        if ($_SESSION['userType'] == 'STUDENT') {
            $title = $_POST['titleInput'];
            $desc = $_POST['descInput'];

            try {
                $stmt = $dbh->prepare('INSERT INTO dailylog (student_id, dailylog_date, dailylog_title, dailylog_content) VALUES (?,?,?,?)');
                $stmt->bindParam(1, $_SESSION['user']);
                $stmt->bindParam(2, $selectedDate);
                $stmt->bindParam(3, $title);
                $stmt->bindParam(4, $desc);
                $stmt->execute();

                header('location:daily.php?date=' . $selectedDate);

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } elseif ($_SESSION['userType'] == 'LECTURER') {
            $stud_id = $_GET['id'];
            $lecturer_comment = $_POST['lec_comment_input'];

            try {
                $stmt = $dbh->prepare("update dailylog set dailylog_lecturer_comment = ?where student_id = ? and dailylog_date = ?");
                $stmt->bindParam(1, $lecturer_comment);
                $stmt->bindParam(2, $stud_id);
                $stmt->bindParam(3, $selectedDate);
                $stmt->execute();

                header('location:index.php?id=' . $stud_id);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    } else if (isset($_POST['cancel'])) {
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
            <?php if (!isset($logRecord['dailylog_title']) and $_SESSION['userType'] != 'STUDENT') { ?>
                <h1 style="color: red">Student Hasn't Log This Date</h1>
                <a class="btn btn-danger" href="index.php?id=<?php echo $_GET['id']; ?>">Back</a>
                <?php
            } else { ?>
                <form class="form-horizontal dropzone" method="post" action="">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="titleInput" id="title" placeholder="Title"
                                <?php
                                if (isset($logRecord['dailylog_title'])) {
                                    echo 'value="' . htmlspecialchars($logRecord['dailylog_title']) . '" readonly';
                                } else {
                                    echo 'required';
                                }
                                ?>
                            >
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

                    <?php
                    if (isset($logRecord['dailylog_lecturer_comment'])) {
                    ?>
                    <div class="form-group">
                        <label for="lec_comment" class="col-sm-2 control-label">Lecturer Comment</label>
                        <div class="col-sm-10">
                       <textarea class="form-control" rows="5" name="lec_comment_input"
                                 id="lec_comment"<?php if ($_SESSION['userType'] == 'STUDENT' || $logRecord['dailylog_lecturer_comment'] != 'NOT_COMMENTED') {
                           echo 'readonly';
                       } ?>><?php if ($logRecord['dailylog_lecturer_comment'] != 'NOT_COMMENTED') {
                               echo htmlspecialchars($logRecord['dailylog_lecturer_comment']);
                           } ?>
                       </textarea>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php
                        }
                        ?>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default"
                                    name="submit"
                                <?php if ($_SESSION['userType'] == 'STUDENT' AND isset($logRecord['dailylog_status'])) {
                                    echo 'disabled';
                                } elseif
                                ($_SESSION['userType'] == 'LECTURER' AND $logRecord['dailylog_lecturer_comment'] != 'NOT_COMMENTED'
                                ) {
                                    echo 'disabled';
                                }
                                ?>>Submit
                            </button>
                            <a class="btn btn-danger" name="cancel"
                                <?php if ($_SESSION['userType'] == 'STUDENT')
                                    echo ' href="index.php"';
                                elseif ($_SESSION['userType'] == 'LECTURER') {
                                    echo 'href="index.php?id=' . $_GET['id'] . '"';
                                }
                                ?>>Cancel</a>
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
include ROOT_PATH . 'inc/footer.php';
?>
