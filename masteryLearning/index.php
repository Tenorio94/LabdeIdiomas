<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mastery  Learning</title>
    <meta name="description" content="Plataforma de Mastery Learning para ITESM">
    <meta name="author" content="sifu & Diego1149">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <base href="/" />

    <!-- Css -->
    <link href="masteryLearning/externals/bootstrap/bootstrap.lumen.min.css" rel="stylesheet">
    <link href="masteryLearning/externals/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="masteryLearning/app.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body ng-app="masteryLearning">
    <nav-bar></nav-bar>
    <div ui-view></div>

    <!-- Scripts -->
    <script src="masteryLearning/externals/jquery/jquery.min.js"></script>
    <script src="masteryLearning/externals/angularjs/angular.min.js"></script>
    <script src="masteryLearning/externals/angularjs/angular-ui-router.min.js"></script>
    <script src="masteryLearning/externals/d3/d3.min.js"></script>
    <script src="masteryLearning/all.js"></script>
</body>
</html>
