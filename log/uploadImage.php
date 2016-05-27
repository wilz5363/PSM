<?php
require_once "../inc/connectDB2.php";

$showStmt = $dbh->query("select imageContent from images where id = 4");
foreach($showStmt as $dataStmt){
    $data[] = $dataStmt;
}
if($showStmt){
    foreach($data as $show){
        echo '<img height = "300" width = "300" src = "data:image;base64,'.$show['imageContent'].'"';
    }
}


if(isset($_POST['submit'])){
   if(getimagesize($_FILES['image']['tmp_name']) == FALSE){
       echo "please select an image";
   }else{
       $image = addslashes($_FILES['image']['tmp_name']);
       $name = addslashes($_FILES['image']['name']);
       $image = file_get_contents($image);
       $image = base64_encode($image);

       $stmt = $dbh->query("insert into images(imageContent) values ('$image')");
       if($stmt){
           echo 'success';
       }else{
           echo 'fail';
       }

   }

}

//$sql = "INSERT INTO files(mime,data) VALUES(:mime,:data)";
//$stmt = $dbh->query($sql);
//$stmt->bindParam(':mime', )
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image" class="form-control">
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>
