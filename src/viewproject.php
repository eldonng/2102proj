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

    textarea {
      resize: none;
    }

    table {
      margin-left: 10px;
      border-spacing: 10px;
      border-collapse: separate;
      width: 100%;
    }

    tbody {
      border: 1px solid #c9b7a2;
      /* float: left; */
      width: 45%;
      background: #e9e9e9;
    }

    /* td {
      border: 2px solid #c9b7a2;
      padding: 8px;
      text-align: left;
    }

    th {
      text-align: left;
    } */

    .form-container {
      background: #e9e9e9;
      text-decoration: none;
      text-align: left;
      padding: 8px;
    }

    .form-field {
      border: 2px solid #c9b7a2;
      background: #e9e9e9;
      color: black;
      padding: 8px;
      width: 200px;
    }

    .form-field:focus {
      background: #e9e9e9;
      border-color: #6CBEEC;
      color: black;
    }

    .form-title {
      /* margin-bottom:10px; */
      color: black;
      text-align: left;
      padding-left: 8px;
    }

    .table-date {
      text-align: left;
      padding: 8px;

    }

    .table-field {
      text-align: left;
      padding: 8px;
      margin-bottom: 10px;
      width: 250px;
    }

    body .table-fieldOwner {
      /* margin-bottom: 2px; */
      padding-left: 8px;
      padding-top: 8px;
      width: 250px;
    }

    .table-fieldOwnerName {
      /* margin-bottom: 2px; */
      padding-left: 8px;
      width: 250px;
    }

    .table-fieldLong {
      text-align: left;
      padding: 8px;
      margin-bottom: 10px;
      width: 400px;
      height: 70px;
      vertical-align: top;
    }

    .table-header {
      text-align: left;
      margin-bottom:10px;
      font-size: 28px;
    }

    .title-field {
      font-size: 20px;
    }

    .progress {
      -moz-appearance: none;
      -webkit-appearance: none;
      border: none;
      border-radius: 290486px;
      display: block;
      height: 1rem;
      overflow: hidden;
      padding: 0;
      width: 100%;
    }

    .progress::-webkit-progress-bar {
      background-color: #dbdbdb;
    }

    .progress::-webkit-progress-value {
      background-color: #4a4a4a;
    }

    .progress::-moz-progress-bar {
      background-color: #4a4a4a;
    }

    .progress::-ms-fill {
      background-color: #4a4a4a;
      border: none;
    }

    .progress.is-approaching::-webkit-progress-value {
      background-color: #3273dc;
    }

    .progress.is-approaching::-moz-progress-bar {
      background-color: #3273dc;
    }

    .progress.is-approaching::-ms-fill {
      background-color: #3273dc;
    }

    .progress.is-funded::-webkit-progress-value {
      background-color: #23d160;
    }

    .progress.is-funded::-moz-progress-bar {
      background-color: #23d160;
    }

    .progress.is-funded::-ms-fill {
      background-color: #23d160;
    }

    .progress.is-starting::-webkit-progress-value {
      background-color: #ffdd57;
    }

    .progress.is-starting::-moz-progress-bar {
      background-color: #ffdd57;
    }

    .progress.is-starting::-ms-fill {
      background-color: #ffdd57;
    }

    .progress.is-small {
      height: 0.75rem;
    }

    .progress.is-medium {
      height: 1.25rem;
    }

    .progress.is-large {
      height: 1.5rem;
    }

    .progress.show-value {
      position: relative;
    }

    .progress.show-value:after {
      content: attr(value)'%';
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      font-size: calc(1rem / 1.5);
      line-height: 1rem;
    }

    .progress.show-value.is-small:after {
      font-size: calc(0.75rem / 1.5);
      line-height: 0.75rem;
    }

    .progress.show-value.is-medium:after {
      font-size: calc(1.25rem / 1.5);
      line-height: 1.25rem;
    }

    .progress.show-value.is-large:after {
      font-size: calc(1.5rem / 1.5);
      line-height: 1.5rem;
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
      width: 150px;
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

<?php
  session_start();
  $db = pg_connect("host=localhost port=5432 dbname=projectdemo user=postgres password=eldon");
    if (!$db) {
    echo "An error occured when connecting to DB.\n";
    exit;
  }
  $projectid = $_GET["projectid"];
  $uemail = $_SESSION["email"];
  $query = "SELECT u.firstname, u.lastname, p.uemail as powner, p.title, p.startdate, p.enddate, p.category, (p.amountfund*100/p.targetamount) as pctamount,
          p.amountfund, p.targetamount, p.description, p.status FROM project_advertised p, users u WHERE p.projectid = '$projectid' AND u.email = p.uemail";
  $result = pg_query($db, $query);
  $row = pg_fetch_assoc($result);
  if (!$result) {
    echo "Unable to display Project.";
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
      } else {
        echo '<script language="javascript">';
        echo 'alert("Successfully added fund!")';
        echo '</script>';
      }
    }

    $query = "SELECT u.firstname, u.lastname, p.uemail as powner, p.title, p.startdate, p.enddate, p.category, (p.amountfund*100/p.targetamount) as pctamount,
            p.amountfund, p.targetamount, p.description, p.status FROM project_advertised p, users u WHERE p.projectid = '$projectid' AND u.email = p.uemail";
    $result4 = pg_query($db, $query4);
    $row = pg_fetch_assoc($result4);
    if (!$result4) {
      echo '<script language="javascript">';
      echo 'alert("Error occured showing updated funds.")';
      echo '</script>';
    }
  }
?>

<body>
  <div class='rg-container'>
  <caption class='rg-header'>
    <span class='rg-hed'>
      <a class='title' href='home.php'>CrowdFund</a>
      <?php
        echo ("<div class='userProfile'>Logged in as: ".$uemail."</div>")
      ?>
    </span>
    <span class='rg-dek'>
    <div class='user-bar'>
      <a href="">Profile |</a>
      <a href="logout.php">Logout</a>
    </div>
    </span>
  </caption>
 	<table>
		<thead>
			<?php
				echo "<tr><th class='table-header' colspan='2'>";
				echo $row['title'];
				echo "</th></tr>";
			?>
		</thead>
		<tbody style="float: left">
			<?php
        echo "<tr><td class='table-field'> <b>About</b> </td></tr>";
        echo "<tr><td class='table-fieldLong'>".$row['description']."</td></tr>";
        echo "<tr><td class='table-field'> Category: ".$row['category']."</td></tr>";
			?>
		</tbody>
    <tbody style="float: right">
      <?php
        echo "<tr><td class='table-field'> <b>Funding</b> </td></tr>";
        echo "<tr><td class='table-field'> Project Owner: </td>";
        echo "<td class='table-field'>".$row['firstname']." ".$row['lastname']."</td></tr>";
        // echo "<tr><td class='table-field'> Start Date: </td>";
        // echo "<td class='table-field'>".$row['startdate']."</td></tr>";
        echo "<tr>";
        if ($row['pctamount'] >= 100){
          echo "<td class='text' data-title='% Funded'><progress class=\"progress is-funded show-value\" value=\"".$row['pctamount']."\" max=\"100\"></progress>
          </td>";
        } else if ($row['pctamount'] >= 65){
          echo "<td class='text' data-title='% Funded'><progress class=\"progress is-approaching show-value\" value=\"".$row['pctamount']."\" max=\"100\"></progress>
          </td>";
        } else {
          echo "<td class='text' data-title='% Funded'><progress class=\"progress is-starting show-value\" value=\"".$row['pctamount']."\" max=\"100\">90%</progress>
          </td>";
        }
        echo "</tr>";
        echo "<tr><td class='table-field'>$".$row['amountfund']." of Goal $".$row['targetamount']."</td></tr>";
        echo "<tr><td class='table-date'> Funding ends on ".$row['enddate']."</td></tr>";
        echo "<tr><td class='table-field'> Current Status: </td>";
        echo "<td class='table-field'>".$row['status']."</td></tr>";
        echo "<tr><form class='form-container' name='view_project' method='POST'>";
        echo "<td><div class='form-title'>Support!</div></td></tr>";
        echo "<tr><td><input class='form-field' type='text' name='amountfunded' /></td>";
        echo "<td><input class='submit-button' type='submit' name='submit' value='Fund it!' /></td>";
        echo "</form></tr>";
      ?>
    </tbody>
	</table>
</body>

</html>
