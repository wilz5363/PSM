<!--google js lib-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<?php if ($section === 'log') {
    $weekend = json_encode(array('friday', 'saturday'));
?>
    <script></script>
<script src="../libs/js/responsive-calendar.js"></script>
<script type="text/javascript">
    var weekend = <?= $weekend;?>;
    $( document ).ready( function() {
  function addLeadingZero(num) {
    if (num < 10) {
      return "0" + num;
    } else {
      return "" + num;
    }
  }


  $('.responsive-calendar').responsiveCalendar({
    onDayClick: function(events) {
        var thisDay = $(this).data('year')+'-'+
        addLeadingZero( $(this).data('month') )+'-'+
        addLeadingZero( $(this).data('day') );
        window.location.href="daily.php?date="+thisDay;
    }, events:{
          "2016-03-28":{"class": "logged"},
          "2016-03-27":{"class": "sick_leave"}
      }
  });
});
</script>
<?php
}
?>


</body>
</html>