<html>
<head><title>test-login</title></head>
<body>
    <form action="" method = "post">
        Name: <input type="text"  name="name">
        password: <input type="password"  name="pass">
        <input type="submit" name="login">
    </form>
    <?php
    if(isset($_POST['login']))
    {
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        $login = 0;
    
    if($name=="shaun"&& $pass=="123"){
        echo "login suucessful";
        $login = 1;
    }
    else{
        echo "login failed";
    }
    if($login==1){
        session_start();
        $_SESSION['user'] = $name;
        $user = $_SESSION['user'];
        echo "<a href='#'>$user</a>";
    }}
    ?>
</body>
</html>