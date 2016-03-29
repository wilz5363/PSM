<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2016
 * Time: 9:25 PM
 */
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}