<?php ob_start(); ?>
<?php include("init.php"); ?>
<!DOCTYPE html>
<html ng-app="timer" ng-controller="timerCtrl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Timer</title>

    <!-- Bootstrap Core CSS -->
    <link href="/timer/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/timer/css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/timer/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Angularjs -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- Timer Functions -->
    <script src="/timer/js/timer_functions.js"></script>
    <!-- Stylesheet -->
    <link href="/timer/css/styles.css" rel="stylesheet">
    <script src="/timer/js/moment.js"></script>


</head>

<body>

    <div id="wrapper">