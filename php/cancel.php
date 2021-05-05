<html>
<head></head>
<BODY>
<div class="container">
<form action="cancelprocess.php" method="post">
    <div class="status">
        <h1 class="error">Your PayPal Transaction has been Canceled</h1>
        <input type="hidden" name="transact" value="<?php echo $_SESSION['transact'];?>">
        <button type="submit" name="back">back</button>
    </div>
    </form>
</div>
</BODY>
</html>


