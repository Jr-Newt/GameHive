<html>
<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

  $connection = mysqli_connect('localhost','root','');
  $db = mysqli_select_db($connection,'gamehive');
  if(isset($_POST['signup']))
{
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  /*$repassword = $_POST['repassword'];
  $phone = $_POST['phone'];
  $gen = $_POST['gender'];

  #$_SESSION['firstname'] = $firstname;
  #$_SESSION['lastname'] = $lastname;
  #$_SESSION['email'] = $email;

  #if($password != $repassword)
  #{
    #$_SESSION['error'] = 'Passwords did not match';
    #header('location: signup.php');
  #}
  #else{
    #$connection = $pdo->open();
  #}
  /*$query = mysqli_query($connection,"INSERT INTO registration values('$email', '$password', '$firstname', '$lastname', '$phone')");
  if($query)*/
  $sql = "INSERT INTO registration (`firstname`, `lastname`, `email`, `password`,`phone`) VALUES ('$firstname', '$lastname', '$email', '$password','$phone')";
  $rs = mysqli_query($connection, $sql);
  if($rs)
  {
    echo "user created successfully";
  }
  else{
    echo "something went wrong!!";
  }
}
?>
</html>
