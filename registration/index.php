<?php include "../inc/constants.php";
include ROOT_PATH . 'inc/connectDB.php';
include ROOT_PATH . 'inc/validateInput.php';
require_once  ROOT_PATH.'recaptchalib.php';

$err_message;
$secret = "6LdzPCATAAAAAJQeVgJH64WplYzSLKhXN1fF2w7F";
// empty response
$response = null;
// check secret key
$reCaptcha = new ReCaptcha($secret);


try {
    $get_weekends = $dbh->query('select * from weekends order by weekend_id')->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}
$company_id;
$company_name;
$company_contact;
$company_email;
$company_password;
$company_password_confrimation;
$company_weekend1;
$company_weekend2;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['g-recaptcha-response']) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }

    if ($response != null && $response->success) {

        $company_id = validate($_POST['companyIdInput']);
        $company_name = validate($_POST['companyNameInput']);
        $company_contact = validate($_POST['companyNumberInput']);
        $company_email = validate($_POST['companyEmailInput']);
        $company_password = validate($_POST['companyPasswordInput']);
        $company_password_confrimation = validate($_POST['companyPasswordConfirmationInput']);
        $company_weekend1 = $_POST['weekend1Input'];
        $company_weekend2 = $_POST['weekend2Input'];

        if ($company_password_confrimation != $company_password) {
            $err_message = 'Password and Confrimation Password should be the same.';
        } else {
            try {
                $stmt = $dbh->prepare("call utem_intern.company_registration_proc(?, ?, ?, ?, ?, ?, ?);");
                $stmt->bindValue(1, $company_name);
                $stmt->bindValue(2, $company_id);
                $stmt->bindValue(3, $company_password);
                $stmt->bindValue(4, $company_contact);
                $stmt->bindValue(5, $company_email);
                $stmt->bindValue(6, $company_weekend1);
                $stmt->bindValue(7, $company_weekend2);
                $stmt->execute();
                $stmt->closeCursor();

                $_SESSION['user'] = $company_id;
                $_SESSION['userType'] = 'COMPANY';
                header('location:' . BASE_URL);
                exit();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
     $err_message="Please ensure the captcha is ticked.";
    }

}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company Registration</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<?php

?>
<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">FTMK Internship Log Book System</a>
    </div>
</nav>
<?php

    if(isset($err_message)){
        echo '<div class="alert">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Title!</strong> Alert body ...
</div>';
    }

?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
            <form action="" method="post" role="form" autocomplete="off">
                <legend>Company Registration</legend>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="companyId">Company ID: </label>
                        <input type="text" class="form-control" name="companyIdInput" id="companyId"
                               placeholder="Company ID" required
                               maxlength="30" <?php if (isset($company_id)) echo 'value= "' . htmlspecialchars($company_id) . '"'; ?>>
                    </div>
                    <div class="form-group">
                        <label for="companyName">Company Name: </label>
                        <input type="text" class="form-control" name="companyNameInput" id="companyName"
                               placeholder="Company Name" required
                               maxlength="100" <?php if (isset($company_name)) echo 'value= "' . htmlspecialchars($company_name) . '"'; ?>>
                    </div>
                    <div class="form-group">
                        <label for="companyNumber">Company Contact Number: </label>
                        <input type="text" class="form-control" name="companyNumberInput" id="companyNumber"
                               placeholder="Company Contact Number" required
                               maxlength="10" <?php if (isset($company_contact)) echo 'value= "' . htmlspecialchars($company_contact) . '"'; ?>>
                    </div>
                    <div class="form-group">
                        <label for="companyEmail">Company Email: </label>
                        <input type="email" class="form-control" name="companyEmailInput" id="companyEmail"
                               placeholder="Company Email"
                               required <?php if (isset($company_email)) echo 'value= "' . htmlspecialchars($company_email) . '"'; ?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="companyPassword">Password: </label>
                        <input type="password" class="form-control" name="companyPasswordInput" id="companyPassword"
                               placeholder="Password" required title="Password must be minimum 8 characters."
                               pattern=".{8,}">
                    </div>
                    <div class="form-group">
                        <label for="companyPasswordConfirmation">Confirmation Password: </label>
                        <input type="password" class="form-control" name="companyPasswordConfirmationInput"
                               id="companyPasswordConfirmation" placeholder="Password Confirmation" required
                               title="Password must be minimum 8 characters." pattern=".{8,}">
                    </div>

                    <div class="form-group">
                        <label for="weekend1">First Day of Weekend: </label>
                        <select name="weekend1Input" id="weekend1" class="form-control" required>
                            <option value=""> -- Select One --</option>
                            <?php
                            foreach ($get_weekends as $weekend) {
                                echo '<option value="' . $weekend[weekend_id] . '">' . $weekend['weekend_day'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weekend2">Second Day of Weekend: </label>
                        <select name="weekend2Input" id="weekend2" class="form-control" required>
                            <option value=""> -- Select One --</option>
                            <?php
                            foreach ($get_weekends as $weekend) {
                                echo '<option value="' . $weekend[weekend_id] . '">' . $weekend['weekend_day'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center ">
                    <div class="g-recaptcha" data-sitekey="6LdzPCATAAAAAP7dnprSlIVWjD4nehaFxyj2Blru"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
</body>
</html>
