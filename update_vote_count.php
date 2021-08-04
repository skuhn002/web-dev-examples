hello from import 2

<?php

  echo "<br>PhP version: ".phpversion()."<br>";

  $con = mysqli_connect('localhost','root','root','testing_db');

  if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
  }
  else {
    mysqli_select_db($con, "voting");

    $sql1 = "SELECT 'votes_1', 'votes_2' FROM 'voting'";

    $querryRtrn1 = mysqli_query($con, $sql1);

    $row = mysqli_fetch_array($querryRtrn1);
      $newV1 = $row['votes_1']; #newV1 and newV2 are variables to use in the second sql string to denote the updated number of votes
      $newV2 = $row['votes_2'];

      $artist_n = $_GET['n'];
      echo "artist n is: ".$artist_n;
      if ($artist_n == 1){
        $vt2updt = "votes_1";
      }
      if ($artist_n == 2){
        $vt2updt = "votes_2";
      }

    $sql2 = "UPDATE `voting` SET $vt2updt=".$vt2updt."+1";

    $querryRtrn2 = mysqli_query($con, $sql2);

    mysqli_close($con);
  }
?>
