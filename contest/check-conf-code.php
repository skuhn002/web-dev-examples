<?php

  //echo "Check 1: ".basename($_SERVER['PHP_SELF']);
  // echo "Check 2: Conf code through get is: ".$_GET['conf_code'];

  $con = mysqli_connect('localhost','root','root','testing_db');

  if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
  }
  else {
    $sql1 = "SELECT `email` FROM `email_conf_codes` WHERE conf_code='".$_GET['conf_code']."'";

    $querryRtrn1 = mysqli_query($con, $sql1);

    $row = mysqli_fetch_array($querryRtrn1);

    if($row == NULL){
      echo "Incorrect Confirmation Code";
    }
    else {
      echo "<br>Success! Thank you ".$row['email']." for confirming your account.";
      echo "<br><div><a href='poetry-submission-form.php'><button type='button'>Continue</button></a></div>";
    }

    mysqli_close($con);
  }

?>
