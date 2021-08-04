<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require '../header.php';

  //Load Composer's autoloader
  require '../vendor/autoload.php';

  function updateConfCodes($email, $conf_code){
    /* Update table of Confirmation Codes
    -------------------------------------
    Parameters:
      email : str
        - the email to connect the confirmation code to
      conf_code : int
        - the code to confirm the email
    -------------------------------------
    Returns:
      confStatus : boolean
        - true if the confirmation code is correct
        - false if the confirmation code is incorrect
    */

    $con = mysqli_connect('localhost','root','root','testing_db');

    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
    else {
      // $sql1 = "SELECT * FROM 'email_conf_codes'";
      //
      // $querryRtrn1 = mysqli_query($con, $sql1);

      //$sql2 = "SELECT * FROM voting";//"INSERT INTO `email_conf_codes`(`email`, `conf_code`) VALUES ($email, $conf_code)";
      // echo "type of conf_code is :".gettype($conf_code)."<br>";
      // echo "type of email is : ".gettype($email)."<br>";
      // echo "email is :".$email."<br>";
      $sql2 = "INSERT INTO email_conf_codes(email, conf_code) VALUES ('$email', $conf_code)";

      $querryRtrn2 = mysqli_query($con, $sql2);

      // echo "Querry Return 2 is of type: ".gettype($querryRtrn2)."<br>";
      //echo "Querry Return 2 is : ".$querryRtrn2."<br>";

      // if ($querryRtrn2 != false){
      //   echo "Return: success on querry 2";
      // }
      // else {
      //   echo "Return: failed on querry 2";
      // }

      mysqli_close($con);
    }


    //return confStatus
  }

  function send_conf_email($conf_code){
    /* Send a generic email.
    ------------------------
    Parameters:
      conf_code : int
        - code for email Confirmation
    ------------------------
    Returns:
      completion_message : str
        - message explaining how email completion went
    ------------------------
    Notes:
      I want to get this function to work if I put it in functions.php, but for now I don't know how to get that to work
    */



    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);


    try {
        // Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.mailtrap.io'; //'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '1937d7a8cc62bf'; //'redmillenial101';                     //SMTP username
        $mail->Password   = 'c3547201a7d532'; //"zkjufgpczsblhehc";                              //SMTP password {starting in c}   //redmillenial101 Gmail password {starting in z}
                                                                                                // The redmillenial101 password may have to be regenerated as a temporary google password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 2525; //587;                                   //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above    //TCP port to conect to for gmail is 587

        //Recipients
        $mail->setFrom('kuhnsamuel2@gmail.com', 'Mailer');
        //$mail->setFrom('redmillenial101@gmail.com', 'Red Millenial');
        $mail->addAddress($_POST['email']);     //Add a recipient
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $search = "___CONF_CODE___";
        $subject = file_get_contents("../emails/confirmation-email.php");
        $replace = $conf_code;
        $mail->Body = str_replace($search, $replace, $subject);
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return 'Message has been sent';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }

  $conf_code = rand(pow(10,1), pow(10,8));

  $email_rtrn = send_conf_email($conf_code);
  updateConfCodes($_POST['email'], $conf_code);

?>
<style media="screen">
  body {
    text-align: left !important;
  }
</style>
<div class="text-align-left" style="margin-left: 50px;">
  <h2>
    <?php
      // echo "Checking:";
      // nSpaces(1);
      // echo "Post:";
      // nSpaces(1);
      // echo "&nbsp&nbsp&nbsp";
      // echo "First Name : ";
      // echo $_POST['first-name'];
      // nSpaces(1);
      // echo "&nbsp&nbsp&nbsp";
      // echo "Last Name : ";
      // echo $_POST['last-name'];
      // nSpaces(1);
      // echo "&nbsp&nbsp&nbsp";
      // echo "Email : ";
      // echo $_POST['email'];
    ?>
  </h2>








<h2>Let's see if we can send you, <?php  echo $_POST['first-name'];?>, an email at <?php echo $_POST['email']; ?>.</h2>
<br>
<h2>
  <div id="email-status">
    Email Not yet Sent.
  </div>
<br>
    <input type="text" onchange="javascript: emailStatusUpdate(document.getElementById('conf-code').value);" id="conf-code" name="conf-code">
      <!-- You can make the input box of type password so the conf code doesn't show up as it's being typed -->

</h2>
</div>








<script type="text/javascript">

  function emailStatusUpdate(conf_code){
    /* This function updates a block of text to let me know how the email is going.
    -------------------------------------------------------------------------------
    Parameters:
      conf_code : int
        - the confirmation code the user entered that needs to be checked against the database
    */
    // var email_rtrn = "<?php echo $email_rtrn; ?>"
    // document.getElementById('email-status').innerHTML = email_rtrn + "<br><br> The next thing to do is to see if I can match the conf_code input to the confirmation codes indexed by email in the database";


    // Send a querry to the database with an httprequest to see if the conf_code matches any of the rows in the email_conf_codes table of the db

    updatev2('email-status', 'check-conf-code.php?conf_code=' + conf_code);


  }

  // emailStatusUpdate();

</script>
