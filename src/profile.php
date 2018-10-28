<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - Profile Page</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
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
    background: #e9e9e9;
  }

  table, th, td {
    border-spacing: 10px;
    border-collapse: separate;
    width: 20%;
    padding: 8px;
    background: #e9e9e9;
    }

  tbody {
    border: 1px solid #c9b7a2;
    /* float: left; */
    /* width: 45%; */
    background: #e9e9e9;
  }

  textarea {
    resize: none;
  }

  .form-container {
    background: #e9e9e9;
    text-decoration: none;
    text-align: center;
    margin-left: auto;
    margin-right: auto;

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
    padding: 8px;
    width: 280px;
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
    // Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=projectdemo user=postgres password=eldon");
        if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }
    if($_SESSION['email'] != null) {
      $user = $_SESSION['email'];
    }  else {
      header("Location: index.php"); /* Redirect browser */
    }
    $query = "SELECT u.firstname, u.lastname, u.email FROM users u WHERE u.email = '$user'";
    $result = pg_query($db, $query);
    $row = pg_fetch_assoc($result);
    if (!$result) {
      echo "Query failed";
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

  <table class="form-container">
		<tbody>
			<?php
        echo "<tr><td class='form-title'> <b>Profile</b> </td></tr>";
        echo "<tr><td class='form-field'> Name: ".$row['firstname']." ".$row['lastname']."</td></tr>";
        echo "<tr><td class='form-field'> Email: ".$row['email']."</td></tr>";
        $query = "SELECT COUNT(*) AS numproj FROM project_advertised WHERE uemail = '$user'";
        $result = pg_query($db, $query);
        $row = pg_fetch_assoc($result);
        if (!$result) {
          echo "Failed to get number of projects created";
        }
        echo "<tr><td class='form-field'><a href= \"myprojects.php\"> No. of Projects Created: ".$row['numproj']." </a></td></tr>";
        $query = "SELECT COUNT(*) AS projfunded FROM fund WHERE uemail = '$user'";
        $result = pg_query($db, $query);
        $row = pg_fetch_assoc($result);
        if (!$result) {
          echo "Failed to get number of projects funded";
        }
        echo "<tr><td class='form-field'><a href= \"fundhistory.php\"> No. of Projects Funded: ".$row['projfunded']." </a></td></tr>";
        echo "<tr><td class='form-field'><a href= \"changepw.php\"> Change Password </a></td></tr>";
			?>
		</tbody>
	</table>
</body>
</html>
