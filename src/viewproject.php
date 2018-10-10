<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - View Project</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
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
      border-bottom: 2px solid #ccc;
      padding-bottom: 8px;
      border: 1px solid #447314;
      text-shadow: #31540c 0 1px 0;
      background: #6aa436;
      background-image: -ms-linear-gradient(top, #8dc059 0%, #6aa436 100%);
      color: #fff;
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

<?php
	session_start();
	$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=4or2jsqi");
	if (!db) {
		echo "An error occured when connecting to DB.\n";
		exit;
	}
	$projectid = $_GET["projectid"];
	$uemail = $_SESSION["email"];
	$query = "SELECT title, startdate, enddate, category, amountfund, targetamount, description, status FROM project_advertised WHERE projectid = '$projectid'";
	$result = pg_query($db, $query);
	$row = pg_fetch_assoc($result);
	if (!$result) {
		echo "Query failed.";
	}

	if (isset($_POST['submit'])) {

    $query2 = "INSERT INTO fund VALUES('$uemail', '$_POST[amountfunded]', '$projectid')";
    $result2 = pg_query($db, $query2);
		if (!$result2) {
      echo '<script language="javascript">';
      echo 'alert("Failed to add funds!")';
      echo '</script>';
		} else {
			$query3 = "UPDATE project_advertised SET amountfund = amountfund + $_POST[amountfunded] WHERE projectid = '$projectid'";
			$result3 = pg_query($db, $query3);
      if (!$result3) {
        echo '<script language="javascript">';
        echo 'alert("Failed to update funds!")';
        echo '</script>';
      }
	    $query4 = "SELECT title, startdate, enddate, category, amountfund, targetamount, description, status FROM project_advertised WHERE projectid = '$projectid'";
      $result4 = pg_query($db, $query4);
      $row = pg_fetch_assoc($result4);
      if (!$result4) {
        echo '<script language="javascript">';
        echo 'alert("Failed to update funds!")';
        echo '</script>';
	    } else {
        echo '<script language="javascript">';
        echo 'alert("Successfully added fund!")';
        echo '</script>';
	    }
    }
  }
?>

<body>
	<header>
    <nav>
    <ul>
      <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
	</nav>
	</header>

	<table>
		<thead>
			<?php
				echo "<th>";
				echo $row['title'];
				echo "</th>";
			?>
		</thead>
		<tbody>
			<?php
				echo "<tr><td><div class="text-" Start Date: ".$row['startdate']."</td></tr>";
				echo "<tr><td> End Date: ".$row['enddate']."</td></tr>";
				echo "<tr><td> Category: ".$row['category']."</td></tr>";
				echo "<tr><td> Description: ".$row['description']."</td></tr>";
				echo "<tr><td> Target Amount: $".$row['targetamount']."</td></tr>";
				echo "<tr><td> Amount Funded: $".$row['amountfund']."</td></tr>";
				echo "<tr><td> Current Status: ".$row['status']."</td></tr>";
			?>
		</tbody>
	</table>

	<form name="view_project" action="viewproject.php?projectid="<?php echo $projectid;?> method="POST">
  <li>Fund Amount</li>
	<input type="text" name="amountfunded" />
	<input class="submit-button" type="submit" name="submit" />
	</form>

</body>

</html>
