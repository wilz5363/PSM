<?php
$numOfDate;
$getDateDiff = $dbh->prepare('select datediff((sysdate()),(select max(dailylog_date) from dailylog where student_id = ?)) as datediff;');
$getDateDiff->bindParam(1, $_SESSION['user']);
$getDateDiff->execute();
$dateDiff = $getDateDiff->fetch(PDO::FETCH_ASSOC);?>
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

