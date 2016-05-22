<!--google js lib-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->

<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"-->
<!--        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"-->
<!--        crossorigin="anonymous"></script>-->

<script src="<?php echo BASE_URL . 'libs/js/jquery.js' ?>"></script>
<script src="<?php echo BASE_URL . 'libs/js/bootstrap.js' ?>"></script>
<script src="<?php echo BASE_URL.'libs/js/script.js' ?>"></script>
<!--<script src="../libs/js/dropzone.js"></script>-->
<?php if ($section === 'log') { ?>
    <script src="../libs/js/responsive-calendar.js"></script>
    <script type="text/javascript">
        var weekend = <?= json_encode($weekend);?>;

        <?php
        if($_SESSION['userType'] != 'STUDENT'){?>
        var stud_id = "<?php echo $_GET['id'];?>";
        <?php
        }
        ?>
        $(document).ready(function () {
            function addLeadingZero(num) {
                if (num < 10) {
                    return "0" + num;
                } else {
                    return "" + num;
                }
            }

            $('.responsive-calendar').responsiveCalendar({
                onDayClick: function (events) {
                    var thisDay = $(this).data('year') + '-' +
                        addLeadingZero($(this).data('month')) + '-' +
                        addLeadingZero($(this).data('day'));
                    <?php
                    if($_SESSION['userType'] == 'STUDENT' ){?>
                    window.location.href = "daily.php?date=" + thisDay;
                    <?php }else if($_SESSION['userType'] == 'LECTURER'){?>
                    window.location.href = "daily.php?id=" + stud_id + "&date=" + thisDay;
                    <?php }
                    ?>

                }, events: {
                    <?php
                    if ($_SESSION['userType'] == 'STUDENT') {
                        foreach ($logs as $log) {
                            echo '"' . $log['dailylog_date'] . '":{"class": "' . strtolower($log['dailylog_status']) . '"},';
                        }
                        $logs->closeCursor();
                    } else if ($_SESSION['userType'] == 'LECTURER') {
                        foreach ($lec_stmt as $log) {
                            echo '"' . $log['dailylog_date'] . '":{"class":"' . (strtolower($log['dailylog_lecturer_comment']) === 'not_commented' ? 'not_commented' : 'logged') . '"},';
                        }
                        $lec_stmt->closeCursor();
                    }

                    ?>

                }
            });
        });
    </script>
    <?php
}
?>


</body>
</html>