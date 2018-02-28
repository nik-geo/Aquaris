<?php
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
//$mail->SMTPDebug = 3;
$body = file_get_contents('emailmsg.html');  // Enable verbose debug output
$email_id=$_POST["emailid"];
$name=$_POST["firstname"];
$productname=$_POST["typeoffish"];
$firstname1=$_POST["firstname"];
$lastname1=$_POST["lastname"];
$emailid1=$_POST["emailid"];
$phoneno1=$_POST["phoneno"];
$countoffish1=$_POST["count"];
$typeoffish1=$_POST["typeoffish"];
$address1=$_POST["address"];
$con = @mysql_connect("localhost","root",""); 
if (!$con) 
  { 
  die('Could not connect: ' . @mysql_error()); 
  } 

@mysql_select_db("aquaris", $con); 

$sql="INSERT INTO order_details VALUES('$firstname1','$lastname1','$emailid1',$phoneno1,$countoffish1,'$address1','$productname')"; 

if (!@mysql_query($sql,$con)) 
  { 
  die('Error: ' . @mysql_error()); 
  } 

@mysql_close($con);
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';          // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'aquarisaquaris3@gmail.com';                 // SMTP username
$mail->Password = 'aquaris123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom('aquarisaquaris3@gmail.com', 'Team_Aquaris');
$mail->addAddress($email_id,$name);
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Order Confirmation';
$mail->MsgHTML($body);
$mail->AltBody = 'Order successfully placed. <b>Team Aquaris</b>';
if(!$mail->send()) {
    echo("<script>location.href = 'Types of Fishes/MSG REDIRECT/msgnotsent.html';</script>");
} else {
	  echo("<script>location.href = 'Types of Fishes/MSG REDIRECT/msgsent.html';</script>");
}
?>