<?php
$title = 'Main';
$section = 'index';
include 'inc/head.php';
?>

<div class="text-center">
    <?php

    if($_SESSION['userType'] == 'FAC_ADV'){
        include "fac_adv/index.php";
    }else if($_SESSION['userType'] == 'STUDENT'){
        include "student/index.php";
    }else if ($_SESSION['userType'] == 'LECTURER'){
        include "lecturer/index.php";
    }
    ?>
</div>


<?php
include './inc/footer.php';
?>

