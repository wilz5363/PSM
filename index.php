<?php
$title = 'Main';
$section = 'index';
include 'inc/head.php';
?>

<div class="container">
    <?php

    if($_SESSION['userType'] == 'LECTURER'){
        include "fac_adv/index.php";
    }else if($_SESSION['userType'] == 'STUDENT'){
        include "student/index.php";
    }else if ($_SESSION['userType'] == 'COMPANY'){
        include "ind/index.php";
    }
    ?>
</div>


<?php
include './inc/footer.php';
?>

