<?php
require_once '../inc/constants.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once ROOT_PATH . 'inc/connectDB.php';
    include ROOT_PATH . 'inc/validateInput.php';

    $userId = validate($_POST['inputMatricNo']);
    $password = validate($_POST['inputPassword']);
    try {
        $stmt = $dbh->prepare("call utem_intern.userLogin(?,?, @nric, @userName, @userType, @userSession);");
        $stmt->bindValue(1, $userId);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        $stmt->closeCursor();

        $result = $dbh->query("select @nric, @userName, @userType, @userSession")
            ->fetch(PDO::FETCH_ASSOC);
        $data = [];
//        echo $result['@nric'];
        if($result){
            $_SESSION['user'] = $userId;
            $_SESSION['userType'] = $result['@userType'];
        }


        header("location:" . BASE_URL);

    } catch (Exception $e) {
        echo 'Query error.' . $e->getMessage();
    }
}

if (isset($_GET['status']) && $_GET['status'] === 'fail') { ?>
    <div class="alert alert-danger alert-dismissible" role="alert"
         style="margin-top: 0;margin-bottom: 0; padding-bottom: 0 ">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> Wrong Matric No or Password. If this continues, please contact webmaster.
    </div>
    <?php
}
$title = 'Log In';
$section = 'login';
include ROOT_PATH . 'inc/header.php';
include ROOT_PATH . 'inc/navigation.php';
?>

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




