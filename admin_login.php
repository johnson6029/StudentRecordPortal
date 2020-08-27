<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="style/main.css">
 <script src="js/jquery.js" type="text/javascript"></script>
 <?php if(@$_GET['w'])
 {echo'<script>alert("'.@$_GET['w'].'");</script>';}
 ?>
<script>
function validateForm() {var y = document.forms["form"]["name"].value;	var letters = /^[A-Za-z]+$/;if (y == null || y == "") {alert("Name must be filled out.");return false;}var z =document.forms["form"]["college"].value;if (z == null || z == "") {alert("college must be filled out.");return false;}var x = document.forms["form"]["email"].value;var atpos = x.indexOf("@");
var dotpos = x.lastIndexOf(".");if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {alert("Not a valid e-mail address.");return false;}var a = document.forms["form"]["password"].value;if(a == null || a == ""){alert("Password must be filled out");return false;}if(a.length<5 || a.length>25){alert("Passwords must be 5 to 25 characters long.");return false;}
var b = document.forms["form"]["cpassword"].value;if (a!=b){alert("Passwords must match.");return false;}}
</script>
</head>
<body>

<div class="body"></div>
		<div class="grad"></div>
		<div class="app_call">
		<div>Ad<span><strong>min</strong></span></div>		</div>
		<br>
		<div class="login">
      <form action="admin.php?q=index.php" method="POST">
        <input type="text" name="uname" maxlength="20"  placeholder="Admin user id"><br>
        <input type="password" name="password" maxlength="15" placeholder="Password"><br>
				  <input type="submit" name="login" value="Login" />
        </form>
		</div>
    <div class="footer">
      <span class="footer-left"><p>&copy; 2018 - Devinder Goyal | Johnson Khristi | Guru Patel</p></span><span class="footer-right"><p>User Login</p></span>
    </div>
