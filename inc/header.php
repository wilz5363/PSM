<?php

if(!isset($_SESSION['user'])) {
    if ($section !== 'login') {
        header("Location:" . BASE_URL . "login");
    }
}else{
    if($section === 'login'){
        header("Location:".BASE_URL);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <?php if($section === 'log')?>
        <link rel="stylesheet" href="../libs/css/responsive-calendar.css">

</head>
