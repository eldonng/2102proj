<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - Add Project</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <style media="screen">

    nav{
      background-color: black;
    }

    nav ul{
      margin:0;
      list-style-type: none;
      text-align: center;
      text-color: white;
    }

    nav ul li{
      display: inline-block;
      text-align: center;
      padding: 20px;
      height: 2%;
      text-color: white;
    }

    nav ul li a{
      text-decoration: none;
      color: white;
      padding: 20px;
    }
    nav ul li a:hover, nav ul li a:active{
      border: 1px solid #447314;
      text-shadow: #31540c 0 1px 0;
      background: #6aa436;
      color: #fff;
    }


  body {
    font: 400 15px/1.5 "Roboto", sans-serif;
    display: inline-block;
    text-align: center;
    margin: 0;
    padding: 0;
    min-width: 100%;

  }
  textarea {
    resize: none;
  }

  .form-container {
    background: white;
    text-decoration: none;
    text-align: center;


     }
  .form-field {
     border: 2px solid #c9b7a2;
     background: white;
     color: black  ;
     padding:8px;
     width:280px;
     }
  .form-fieldLong {
    border: 2px solid #c9b7a2;
    background: white;
    color: black;
    padding:8px;
    width:280px;
    height: 70px;
    }

  .form-field:focus {
     background: #fff;
     border-color: #6CBEEC;
     color: black;
     }
  .form-fieldLong:focus {
    background: #fff;
    border-color: #6CBEEC;
    color: black;
    }
  .form-container h2 {
     font-size:18px;
     font-weight:bold;
     text-align:center;
      }
  .form-title {
     margin-bottom:10px;
     color: black ;
     }
  .submit-container {
     }
  .submit-button {
     border: 1px solid white;
     background: black;
     color: white;
     padding: 8.5px 18px;
     font-size: 14px;
     text-decoration: none;
     vertical-align: middle;
     width: 300px;
     }
  .submit-button:hover {
     border: 1px solid #447314;
     text-shadow: #31540c 0 1px 0;
     background: #6aa436;
     background-image: -ms-linear-gradient(top, #8dc059 0%, #6aa436 100%);
     color: #fff;
     }
  .submit-button:active {
     text-shadow: #31540c 0 1px 0;
     border: 1px solid #447314;
     background: #8dc059;
     background-image: -ms-linear-gradient(top, #6aa436 0%, #8dc059 100%);
     color: #fff;
     }

    </style>
</head>

<body>
<?php
    session_start();
    if($_SESSION['email'] != null) {
      $user = $_SESSION['email'];
    }  else {
      header("Location: index.php"); /* Redirect browser */
    }
?>
  <header>
    <nav>
    <ul>
      <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </nav>
  </header>
    <form class = "form-container" name="add_project" action="addproject.php" method="POST" >
        <div class ="form-title"><h2> Please enter project details</h2></div>

      <div class="form-title">Title: </div>
      <input class="form-field" type="text)" name="title" />
      <div class="form-title">Start Date: </div>
        <input class="form-field" type="date" name="startdate" />

      <div class="form-title">End Date: </div>
      <input class="form-field" type="date" name="enddate" />

      <div class="form-title">Category: </div>
      <input class="form-field" type="text" name="category" />
      <div class="form-title">Target Amount: </div>
      <input class="form-field" type="text" name="targetamount" />

      <div class="form-title">Description: </div>
        <textarea class="form-fieldLong" type="varchar(256)" name="description"/></textarea>
        <div class="submit-container">
        <input class ="submit-button" type="submit" name="submit" />
      </div>
    </form>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=password");
        if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }
    $uniqueId = uniqid();
    $uniqueId8 = substr($uniqueId, 0, 8);
    if (isset($_POST['submit'])) {
        $query = "INSERT INTO project_advertised(uemail, projectid, title, startdate, enddate, category, targetamount, description) VALUES('$user', '$uniqueId8' , '$_POST[title]', '$_POST[startdate]', '$_POST[enddate]',
          '$_POST[category]', '$_POST[targetamount]', '$_POST[description]')";
        $result = pg_query($db, $query);
        if (!$result) {
          echo '<script language="javascript">';
          echo 'alert("Failed to add project")';
          echo '</script>';
        } else {
          echo '<script language="javascript">';
          echo 'alert("Succesfully added project!")';
          echo '</script>';
        }
    }
    ?>
</body>
</html>
