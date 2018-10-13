<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - Edit Project</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">

    <style>

    nav{
      background-color: black;
      margin: 0;
    }
    nav h1{
      color: white;
      margin: 0;
      text-align: left;
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
      margin: 0;
      min-width: 100%;
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
	$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=password");
	if (!db) {
		echo "error connecting to DB.\n";
		exit;
	}
	$projectid = $_GET["projectid"];
	$uemail = $_SESSION["email"];
	$query = "SELECT uemail, title, startdate, enddate, category, amountfund, targetamount, description, status FROM project_advertised WHERE projectid = '$projectid'";
	$result = pg_query($db, $query);
	$row = pg_fetch_assoc($result);
	if (!$result) {
		echo "Query failed.";
	}
  // if ($row[uemail] != $uemail) {
  //   // header("Location: home.php"); /* Redirect browser */
    // echo '<script type="text/javascript">
    //       alert("You cannot edit projects that are not yours!");
    //       window.location="home.php";
    //       </script>';
  // }
  if (isset($_POST['submit'])) {
    $query2 = "UPDATE project_advertised SET title = '$_POST[title]', startdate = '$_POST[startdate]', enddate = '$_POST[enddate]',
    category = '$_POST[category]', targetamount= '$_POST[targetamount]', description = '$_POST[description]'
    WHERE projectid = '$projectid'";
    $result2 = pg_query($db, $query2);
    if (!$result2) {
      echo '<script language="javascript">';
      echo 'alert("Failed to update project!")';
      echo '</script>';
    } else {
      echo '<script language="javascript">';
      echo 'alert("Succesfully updated project!")';
      echo '</script>';
    }
    $query3 = "SELECT title, startdate, enddate, category, amountfund, targetamount, description, status FROM project_advertised WHERE projectid = '$projectid'";
    $result3 = pg_query($db, $query3);
    $row = pg_fetch_assoc($result3);
  }
  if (isset($_POST['delete'])) {
    $query4 ="DELETE from fund WHERE pprojectid = '$projectid'";
    $result4 = pg_query($db, $query4);
    $query5 = "DELETE from project_advertised WHERE projectid = '$projectid'";
    $result5 = pg_query($db, $query5);
    if (!$result5) {
      echo '<script language="javascript">';
      echo 'alert("Failed to delete project!")';
      echo '</script>';
    } else {
      echo '<script language="javascript">';
      echo 'alert("Succesfully deleted project!")';
      echo '</script>';
    }
    echo '<script type="text/javascript">
          window.location="myprojects.php";
          </script>';
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

    <form class = "form-container" name="add_project" action="editproject.php?projectid=<?php echo $projectid;?>" method="POST" >
      <h2> Update Project Details </h2>
      <div class="form-title">Title: </div>
      <input class="form-field" type="text)" name="title" value ="<?php echo $row[title];?>" />
      <div class="form-title">Start Date: </div>
        <input class="form-field" type="date" name="startdate"  value ="<?php echo $row[startdate];?>" />

      <div class="form-title">End Date: </div>
      <input class="form-field" type="date" name="enddate"  value ="<?php echo $row[enddate];?>"/>

      <div class="form-title">Category: </div>
      <input class="form-field" type="text" name="category" value ="<?php echo $row[category];?>"/>
      <div class="form-title">Target Amount: </div>
      <input class="form-field" type="text" name="targetamount" value ="<?php echo $row[targetamount];?>"/>

      <div class="form-title">Description: </div>
        <textarea class="form-fieldLong" type="varchar(256)" name="description"/><?php echo $row[description];?></textarea>
        <div class="submit-container">
        <input class ="submit-button" type="submit" name="submit" />
      </div>
      <div class="submit-container">
        <input class ="submit-button" type="submit" name="delete" value="Delete" onclick ="return validate_delete()" />
      </div>
    </form>

</body>


</html>

<script>
function validate_delete() {
  if(confirm("Are you sure you want to delete this project?")) {
    return true;
  } else {
    return false;
  }
}
</script>
