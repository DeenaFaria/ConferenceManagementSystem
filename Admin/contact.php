<?php
include("session.php");
include("config.php");
?>


<!DOCTYPE html>
<html>
<head>
<title>Contact Information|Conference Management System</title>
 <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css" >
<?php

$sql="select * from logo";
$res=mysqli_query($conn,$sql);

$row = mysqli_fetch_array($res);
if($row['size']>0)
{
echo '<link rel="icon" href="Logo/'.$row['file'].'" type="image/x-icon">';
}
?>
<div class="header">
<h1>Add contact</h1>
</div>
</head>

<body>

<br><br>

<center>
<form action="contact.php" method="post">
<textarea class="tinymce" name="contact" rows="30" cols="80"></textarea><br><br>
<input type="hidden" name="id">
<center><input type="submit" name="submit" value="Add Information">
<input type="reset" value="Reset"></center>
</form>

<script type="text/javascript" src="tinymce/js/jquery.min.js"></script>
<script type="text/javascript" src="tinymce/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="tinymce/plugin/tinymce/init-tinymce.js"></script>
</center>

<?php
if(isset($_POST['submit'])){
$contact=mysqli_real_escape_string($conn, $_REQUEST['contact']);
if(!empty($contact)){
$sql = "INSERT INTO contact (contact)
VALUES ('$contact')";


if ($conn->query($sql) === TRUE) {
    echo "<h4>New record created successfully</h4>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// header("Location: home.php");
}
else echo "Required Field is empty! Please add something first!";
}
?>

</body>
</html>