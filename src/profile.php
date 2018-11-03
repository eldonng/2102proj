<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - Profile Page</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <!-- <link rel="stylesheet" href="formstyle.css">
    <link rel="stylesheet" href="style.css"> -->

    <style media="screen">

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
  body {
    padding-top: 10px;
    font: 400 18px/1.5 "Roboto", sans-serif;
    background-color: #f4f4f4;
    width: 100%;
    margin: auto;
  }
  table {
    border-spacing: 10px;
    border-collapse: separate;
    width: 30%;
    padding: 8px;
    background: #f4f4f4;
    }
  tbody {
    /* border: 1px solid #c9b7a2; */
    /* float: left; */
    width: 30%;
    background: #f4f4f4;
  }
  textarea {
    resize: none;
  }
  .form-container {
    background: #f4f4f4;
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
     width:200px;
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
     text-align: left;
     }
     .rg-container {
       width: 85%;
       margin: auto;
       padding: 1em 0.5em;
       color: #222;
     }
     .rg-header {
       margin-bottom: 1em;
       text-align: left;
     }
     .rg-header>* {
       display: block;
     }
     .rg-hed {
       display: grid;
       grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
       font-weight: bold;
     }
     .rg-hed .title {
       font-size: 1.8em;
       grid-column: 1 / span 1;
     }
     .rg-hed .userProfile{
       grid-column: 3 / span 4;
       align-self: end;
       justify-self: end;
       font-size: 1em;
     }
     .rg-dek {
       display: grid;
       grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
       font-size: 1em;
     }
     .rg-dek .action-bar{
       grid-column: 1 / span 3;
       align-self: start;
     }
     .rg-dek .user-bar{
       font-size: 0.9em;
       grid-column: 4 / span 3;
       grid-row: 1;
       align-self: start;
       justify-self: end;
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
   @media screen and (max-width: 600px) {
     .rg-hed {
       display: inline-block;
   }
     .rg-dek {
       display: inline-block;
     }
   }

  </style>
</head>

<body>
<?php
    session_start();
    // Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect($_SESSION['dblogin']);
        if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }
    if ($_SESSION['email'] != null) {
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

    $query2 = "SELECT COUNT(DISTINCT projectid) as numproj FROM project_advertised WHERE uemail='$user'";
    $result2 = pg_query($db, $query2);
    $row2 = pg_fetch_assoc($result2);
    if (!$result2) {
      echo "Num Projects Query failed";
    }

    $query3 = "SELECT COUNT(DISTINCT pprojectid) as numfunded FROM fund WHERE uemail='$user'";
    $result3 = pg_query($db, $query3);
    $row3 = pg_fetch_assoc($result3);
    if (!$result3) {
      echo "Num Funded Query failed";
    }
?>
  <div class='rg-container'>
  <caption class='rg-header'>
    <span class='rg-hed'>
      <a class='title' href='home.php'>CrowdFund</a>
      <?php
        echo ("<div class='userProfile'>Logged in as: ".$user."</div>")
      ?>
    </span>
    <span class='rg-dek'>
    <div class='user-bar'>
      <a href="changepw.php">Change Password |</a>
      <a href="logout.php">Logout</a>
    </div>
    </span>
  </caption>

  <table class="form-container">
		<tbody>
		<?php
        echo "<tr><td class='form-title'> <b>Profile</b> </td></tr>";
        echo "<tr><td class='form-field'> Name: ".$row['firstname']." ".$row['lastname']."</td></tr>";
        echo "<tr><td class='form-field'> Email: ".$row['email']."</td></tr>";
        echo "<tr><td class='form-field'><a href= \"myprojects.php\"> No. of Projects Created: ".$row2['numproj']." </a></td></tr>";
        echo "<tr><td class='form-field'><a href= \"fundhistory.php\"> No. of Projects Funded: ".$row3['numfunded']." </a></td></tr>";
		?>
		</tbody>
    <!-- <tbody style="float: right">
		<?php
        echo "<tr><td class='form-title'> <b>Profile</b> </td></tr>";
        echo "<tr><td class='form-field'> Name: ".$row['firstname']." ".$row['lastname']."</td></tr>";
        echo "<tr><td class='form-field'> Email: ".$row['email']."</td></tr>";
        echo "<tr><td class='form-field'> Total Projects: ".$row2['numproj']."</td></tr>";
        echo "<tr><td class='form-field'> No. of Projects Funded: ".$row3['numfunded']."</td></tr>";
		?>
    </tbody> -->
	</table>
  </div>
</body>
</html>
