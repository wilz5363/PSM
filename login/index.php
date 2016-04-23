<?php
$err_msg;
$title = 'Log In';
$section = 'login';
include '../inc/head.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include ROOT_PATH . 'inc/validateInput.php';

    $userId = validate($_POST['inputMatricNo']);
    $password = validate($_POST['inputPassword']);
    try {
        $stmt = $dbh->prepare("call utem_intern.user_login(?, ?, @usertype, @session_time);");
        $stmt->bindValue(1, $userId);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        $stmt->closeCursor();

        $result = $dbh->query("select @usertype, @session_time")->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $_SESSION['user'] = $userId;
            $_SESSION['userType'] = $result['@usertype'];
        }
        header("location:" . BASE_URL);
    } catch (PDOException $e) {
        if ($e->errorInfo[0] = '45000') {
            $err_msg = 'Username or Password is incorrect.';
        }
    }
}

?>


<?php
if (isset($err_msg)) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert"
         style="margin-top: 0;margin-bottom: 0; padding-bottom: 0 ">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <strong>Warning! </strong> <?php echo $err_msg; ?>.
    </div>
<?php } ?>

<div class="container">
    <div class="text-center">
        <h1>Log In Page...</h1>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Sign In</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label for="inputMatricNo" class="col-sm-2 control-label">Matric No.</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputMatricNo" name="inputMatricNo"
                                   placeholder="Matric No.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword"
                                   placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <button type="submit" class="btn btn-primary btn-block" name="signInBtn">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include ROOT_PATH . 'inc/footer.php'; ?>



