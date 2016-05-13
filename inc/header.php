<?php

if (!isset($_SESSION['user'])) {
    if ($section !== 'login') {
        header("Location:" . BASE_URL . "login");
    }
} else {
    if ($section === 'login') {
        header("Location:" . BASE_URL);
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
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"-->
<!--          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
          integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd"
          crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL.'libs/css/bootstrap.css';?>">
    <?php if ($section === 'log') ?>
    <link rel="stylesheet" href="<?php echo BASE_URL.'libs/css/responsive-calendar.css';?>">
    <?php if($section == 'dailylog')?>
<!--    <link href="../libs/css/dropzone.css">-->
</head>
