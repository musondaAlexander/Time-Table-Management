<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="Login//style.css">

</head>
<body>
    <section>
    <div class="box">
        <div class="form">
			<center>  <h2 style="margin-top:-50px">Login</h2></center>
            <?php include 'validate.php'; ?>
			<form method="post">
                <div class="inputBx">
                    <input type="text" name="id" placeholder="CMS-ID" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
                    <img src="Login//user.png" width="25">
                </div>
                <div class="inputBx">
                    <input type="password" name="password" placeholder="Password">
                    <img src="Login//padlock.png" width="25">
                </div>
                <label class="remeber"><input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> >
                    Remember Me</label>
				<div>
					<input type="submit" value="login" name="login"></label>
				</div>
            </form>
        </div>
    </div>
    </section>
</body>
</html>