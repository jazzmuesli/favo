<?php
//ini_set('display_errors','On');
//$tmpdir = sys_get_temp_dir();
//ini_set('error_log',$tmpdir . '/muesli.log');
error_reporting(E_ALL);
include("dbo.php");
?>
<html>
<head>
<title>Favo</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#start_date" ).datepicker({
      defaultDate: "+1h",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#start_date" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#end_date" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#end_date" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>

</head>
<body>
