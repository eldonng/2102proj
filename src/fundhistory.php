<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CrowdFund | My Projects</title>
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

    .search {
      width: 100%;
      position: relative
    }

    .searchTerm {
      float: left;
      width: 100%;
      border: 3px solid #222;
      padding: 5px;
      height: 20px;
      border-radius: 5px;
      outline: none;
      color: #9DBFAF;
    }

    .searchTerm:focus {
      color: #222;
    }

    .searchButton {
      position: absolute;
      right: -50px;
      width: 40px;
      height: 36px;
      border: 1px solid #222;
      background: #222;
      text-align: center;
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
      font-size: 20px;
    }
    .modifyButton {
      background-color: #222;
      border: 3px solid #222;
      color: #f4f4f4;
      cursor: pointer;
      border-radius: 12px;
    }
    .modifyButton:hover {
      background: #6aa436;
      border:3px solid #6aa436;
      color: #fff;
    }


    /*Resize the wrap to see the search bar change!*/

    .wrap {
      width: 30%;
      position: relative;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    */
    /* info (hed, dek, source, credit) */

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


    .rg-dek form {
      display: inline-block;
    }

    .rg-dek form button#createproject {
      background-color: #222;
      border: 3px solid #222;
      color: #f4f4f4;
      cursor: pointer;
      border-radius: 12px;
    }

    /* table */

    table.rg-table {
      width: 100%;
      margin-bottom: 0.5em;
      font-size: 1em;
      border-collapse: collapse;
      border-spacing: 0;
    }

    table.rg-table tr {
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      border: 0;
      font-size: 100%;
      font: inherit;
      vertical-align: baseline;
      text-align: left;
      color: #333;
    }

    table.rg-table thead {
      border-bottom: 3px solid #ddd;
    }

    table.rg-table tr {
      border-bottom: 1px solid #ddd;
      color: #222;
    }

    table.rg-table tr.highlight {
      background-color: #dcf1f0 !important;
    }

    table.rg-table.zebra tr:nth-child(even) {
      background-color: #f6f6f6;
    }

    table.rg-table th {
      font-weight: bold;
      padding: 0.35em;
      font-size: 0.9em;
    }

    table.rg-table td {
      padding: 0.35em;
      font-size: 0.9em;
    }

    table.rg-table td a {
      color: #222;
      text-decoration: none;
    }

    table.rg-table td a:visited {
      color: #222;
    }

    table.rg-table td a:hover {
      color: grey;
    }

    table.rg-table .highlight td {
      font-weight: bold;
    }

    table.rg-table th.number,
    td.number {
      text-align: right;
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

    .project-action button {
      display: inline;
    }
    /* media queries */

    @media screen and (max-width: 600px) {
      .rg-container {
        max-width: 600px;
        margin: 0 auto;
      }
      .rg-hed {
      display: inline-block;
    }
      table.rg-table {
        width: 100%;
      }
      table.rg-table tr.hide-mobile,
      table.rg-table th.hide-mobile,
      table.rg-table td.hide-mobile {
        display: none;
      }
      table.rg-table thead {
        display: none;
      }
      table.rg-table tbody {
        width: 100%;
      }
      table.rg-table tr,
      table.rg-table th,
      table.rg-table td {
        display: block;
        padding: 0;
      }
      table.rg-table tr {
        border-bottom: none;
        margin: 0 0 1em 0;
        padding: 0.5em;
      }

      table.rg-table tr.highlight {
        background-color: inherit !important;
      }
      table.rg-table.zebra tr:nth-child(even) {
        background-color: transparent;
      }
      table.rg-table.zebra td:nth-child(even) {
        background-color: #f6f6f6;
      }
      table.rg-table tr:nth-child(even) {
        background-color: transparent;
      }
      table.rg-table td {
        padding: 0.5em 0 0.25em 0;
        border-bottom: 1px dotted #ccc;
        text-align: right;
      }
      input[type=submit] {
        background-color: #222;
        border: 3px solid #222;
        color: #f4f4f4;
        cursor: pointer;
        border-radius: 12px;
      }
      table.rg-table td[data-title]:before {
        content: attr(data-title);
        font-weight: bold;
        display: inline-block;
        content: attr(data-title);
        float: left;
        margin-right: 0.5em;
        font-size: 0.95em;
      }
      table.rg-table td:last-child {
        padding-right: 0;
        border-bottom: 2px solid #ccc;
      }
      table.rg-table td:empty {
        display: none;
      }
      table.rg-table .highlight td {
        background-color: inherit;
        font-weight: normal;
      }
    }
  </style>
</head>

<?php
session_start();
$db = pg_connect($_SESSION['dblogin']);
   if (!$db) {
    echo "An error occured when connecting to DB.\n";
    exit;
  }
  $user = $_SESSION['email'];
  $query = pg_query($db, "SELECT p.title, (p.amountfund*100/p.targetamount) as pctamount, f.amountfunded, p.targetamount, p.projectid, p.enddate FROM project_advertised p, fund f where
  f.uemail = '$user' AND p.projectid = f.pprojectid");
  if (!$query) {
  echo "An error occured while querying DB.\n";
  exit;
  }
?>

<body>
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
          <a href="profile.php">Profile |</a>
          <a href="logout.php">Logout</a>
        </div>
      </span>
      <table class='rg-table' style='width: 85%;' summary='CrowdFund'>
      <thead>
        <tr>
          <th class='text '>Project Title</th>
          <th class=' '>% Funded</th>
          <th class=' '>Target</th>
          <th class=' '>Contributed Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while ($row = pg_fetch_array($query)) {
            $projectid = $row['projectid'];
            echo "<tr>";
            echo "<td class='text ' data-title='Project Title'><a href=\"viewproject.php?projectid=".$row['projectid']."\">".$row['title']."</a></td>";
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
              echo "<td class='text' data-title='Target'>$".$row['targetamount']."</td>";
              echo "<td class='text' data-title='Contributed Amount'>$".$row['amountfunded']."</td>";
              // echo "<td class='text' data-title='End Date'>".$row['enddate']."</td>";
              // echo "<td class='text project.action' data-title='Project Title'><a href=\"editproject.php?projectid=".$row['projectid']."\">
              //   <button type='button' class='modifyButton'>Modify</button></a>
              //   </td>";
              echo "</tr>";
          }
          ?>

      </tbody>
    </table>
  </div>
</body>

</html>
