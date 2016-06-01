<?php
$numOfDate;
$date = '2016-05-01';
try{
    $getDateDiff = $dbh->prepare("select utem_intern.cal_diff_date_func('B031310166') as date_diff");
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
if ($dateDiff['date_diff'] > 0) {
echo '<div class="alert alert-danger">
	<strong>Attention!! </strong> You have approximately late to log for '.$dateDiff['date_diff'].' day(s). Please log your daily log now.
</div>';
}else{
    echo '<div class="alert alert-success">
	<strong>Great!! </strong> Everything looking great!!
</div>';
}
?>

