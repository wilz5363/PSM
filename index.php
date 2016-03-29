<?php
require_once 'inc/constants.php';
$title = 'Main';
$section = 'index';
include './inc/header.php';
include './inc/navigation.php';
?>

<div class="text-center">
    <?php

    if($_SESSION['userType'] == 'FAC_ADV'){
        include "fac_adv/mainPage.php";
    }else if($_SESSION['userType'] == 'STUDENT'){
        include "student/mainPage.php";
    }



    ?>
</div>


<?php
include './inc/footer.php';
?>

