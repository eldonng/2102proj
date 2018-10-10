<!DOCTYPE html>  
<head>
  <title>CrowdFund | Login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <!-- <link rel="stylesheet" href="style.css"> -->
   <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
   <style>
    body {
      padding-top: 10px;
      font: 400 18px/1.5 "Roboto", sans-serif;
      background-color: #f4f4f4;
      width: 85%;
      margin: auto;
    }

    #target-reached {
      color: rgb(17, 170, 17);
    }

    #target-near {
      color: rgb(53, 240, 253);
    }

    a {
      color: #222;
      text-decoration: none;
    }

    a:visited {
      color: #222;
    }

    a:hover {
      color: grey;
    }

  </style>
</head>
<body>
<?php
    session_start();
    $_SESSION['email'] = null;
    header("Location: index.php");
?>
</body>
</html>