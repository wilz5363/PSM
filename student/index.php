<?php
$numOfDate;
$date = '2016-05-01';
try{
    $getDateDiff = $dbh->prepare("select (datediff(now(),'".$date."')-count(*)) as datediff from dailylog where student_id = ?");
    $getDateDiff->bindParam(1, $_SESSION['user']);
    $getDateDiff->execute();
    $dateDiff = $getDateDiff->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
<div class="page-header">
  <h1>Student Page<small> Log Book</small></h1>
</div>


<?php
if ($dateDiff['datediff'] > 0) {
echo '<div class="alert alert-warning">
	<strong>Attention!! </strong> You have approximately late to log for '.$dateDiff['datediff'].' day(s). Please log your daily log now.
</div>';
}else{
    echo '<div class="alert alert-success">
	<strong>Great!! </strong> Everything looking great!!
</div>';
}
?>

