 <?php
include("config.php");
include("session.php");
$paperno=$_GET['paperno'];
?>
 <?php

 if(isset($_POST['submit'])){
	 $status=$_POST['dec'];
	 $sub=$_POST['sub'];
	 $mess=$_POST['mess'];
	
	  echo "<br>Your Message:<br><br>Subject:".$sub."<br>"."Message:".$mess."<br><br><br>";
 }
$sql="select * from author where id='$paperno'";
$res=mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($res))
{
	$title=$row['title'];
	$corr1=$row['corr1'];
	$corr2=$row['corr2'];
	$corr3=$row['corr3'];
	$corr4=$row['corr4'];
	$email1=$row['email1'];
	$email2=$row['email2'];
	$email3=$row['email3'];
	$email4=$row['email4'];
	if($corr1=="yes")
		sendMail($email1,$sub,$mess);
	if($corr2=="yes")
		sendMail($email2,$sub,$mess);
	if($corr3=="yes")
		sendMail($email3,$sub,$mess);
	if($corr4=="yes")
		sendMail($email4,$sub,$mess);
}
$sql1 = "INSERT INTO paper_status (paperno,title,status,comment) VALUES ('$paperno','$title','$status','$mess')";
mysqli_query($conn, $sql1);

function sendMail($email,$sub,$mess){
	
require_once 'PHPMailerAutoload.php';
require_once 'credential.php';
//Create an instance; passing `true` enables exceptions
$mail =  new PHPMailer(true);

try {
	$mail->isSMTP();
//$mail->Host = 'localhost';
//$mail->SMTPAuth = false;
//$mail->SMTPAutoTLS = false; 
//$mail->Port = 25; 
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = EMAIL;                     //SMTP username
    $mail->Password   = PASS;                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom(EMAIL, 'Conference Management System');
    $mail->addAddress($email);     //Add a recipient
   // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo(EMAIL, 'Information');
  //  $mail->addCC('cc@example.com');
  //  $mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = $mess;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
  ?>