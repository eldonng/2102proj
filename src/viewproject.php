<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - View Project</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- <link rel="stylesheet" <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet"> -->
	<!-- <style>li {list-style: none;}</style> -->

</head>

<?php
	session_start();
	$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=4or2jsqi");
	if (!db) {
		echo "error connecting to DB.\n";
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
			echo "failed";
		} else {
			echo "done";
			$query3 = "UPDATE project_advertised SET amountfund = amountfund + $_POST[amountfunded] WHERE projectid = '$projectid'";
			$result3 = pg_query($db, $query3);
			$query4 = "SELECT title, startdate, enddate, category, amountfund, targetamount, description, status FROM project_advertised WHERE projectid = '$projectid'";
			$result4 = pg_query($db, $query4);
			$row = pg_fetch_assoc($result4);
			if (!result3) {
				echo "update failed";
			} else {
				echo "update success";
			}

			if (!result4) {
				echo "updated show failed";
			} else {
				echo "updated show success";
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
				echo "<tr><td> Start Date: ".$row['startdate']."</td></tr>";
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
	<input type="submit" name="submit" />
	</form>

</body>

</html>
