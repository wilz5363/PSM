<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2016
 * Time: 8:04 PM
 */
require_once '../inc/constants.php';
$errPassword = "";
$rowCount = 0;
$updateMessage="";
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    include ROOT_PATH . 'inc/validateInput.php';

    if ($_POST['inputPassword'] !== $_POST['inputConfirmPassword']) {
        $errMessage = "Password and Confirmation Password must be same.";
    } else {
        $matricNo = validate($_POST['inputMatricNo']);
        $name = validate($_POST['inputName']);
        $nric = validate($_POST['inputNric']);
        $password = validate($_POST['inputPassword']);
        echo $password."a";

        if ($matricNo == "" || $name == "" || $nric == "" || $password == "") {
            $errMessage = "All field must be inserted";
        } else {
            require_once ROOT_PATH . 'inc/connectDB.php';
            try{
                $stmt = $dbh->prepare("update student set name = ?, nric = ?, password = ? where matricNo = ?");
                $stmt->bindValue(4, $matricNo,PDO::PARAM_STR);
                $stmt->bindValue(1, $name,PDO::PARAM_STR);
                $stmt->bindValue(2, $nric,PDO::PARAM_STR);
                $stmt->bindValue(3, $password,PDO::PARAM_STR);
                $stmt->execute();
                $rowCount = $stmt->rowCount();
               echo $password."q";
            }catch (Exception $e) {
                echo 'Query error.' . $e->getMessage();
            }
        }

        if($rowCount >0){
            $updateMessage = "Successfully updated profile";
            $_SESSION['user'] = $matricNo;
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['nric'] = $nric;
        }else{
            $updateMessage = "Update profile unsuccessful.";
        }

    }
}
$title = 'Profile';
$section = 'profile';
include ROOT_PATH . 'inc/header.php';
include ROOT_PATH . 'inc/navigation.php';
?>
<div class="container">

    <form action="" method="post">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="inputMatricNo">Matric No</label>
                    <input type="text" class="form-control" id="inputMatricNo" name="inputMatricNo"
                           placeholder="Email" value="<?php echo htmlspecialchars($_SESSION['user']); ?>" autofocus
                           required>
                </div>
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name"
                           value="<?php echo htmlspecialchars($_SESSION['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="inputNric">NRIC</label>
                    <input type="text" class="form-control" id="inputNric" name="inputNric" placeholder="NRIC"
                           value="<?php echo htmlspecialchars($_SESSION['nric']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword"
                           placeholder="Password"
                           value="<?php echo htmlspecialchars($_SESSION['password']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="inputConfirmPassword">Confirmation Password</label>
                    <input type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword"
                           placeholder="Password"
                           value="<?php echo htmlspecialchars($_SESSION['password']); ?>" required>
                    <?php if ($errPassword != "") {
                        echo '<p class="alert alert-danger">' . $errPassword . '</p>';
                    } else if(!isset($updateMessage)){
                       if($rowCount > 0 ){
                           echo '<p class="alert alert-success">' . $updateMessage . '</p>';
                       }else{
                           echo '<p class="alert alert-danger">' . $updateMessage . '</p>';
                       }
                    }?>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
                <div class="col-md-6">
                    <button type="reset" class="btn btn-danger btn-block">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>


<?php
include ROOT_PATH . 'inc/footer.php';
?>
