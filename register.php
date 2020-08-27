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
		<div class="regiser-login">
      <form name="form" action="sign.php?q=account.php" onSubmit="return validateForm()" method="POST">
        <input id="name" name="name" placeholder="Enter your name" type="text"><br><br>
        <select id="gender" name="gender" placeholder="Enter your gender" class="select-style" >
       <option value="Male">Select Gender</option>
      <option value="M">Male</option>
      <option value="F">Female</option> </select><br><br>
      <input id="college" name="college" placeholder="Enter your college name" type="text"><br><br>
      <input id="email" name="email" placeholder="Enter your email-id" type="email"><br><br>
      <input id="mob" name="mob" placeholder="Enter your mobile number"  type="number"><br>
      <input id="password" name="password" placeholder="Enter your password" type="password"><br>
      <input id="cpassword" name="cpassword" placeholder="Conform Password" type="password"><br>
      <?php if(@$_GET['q7'])
      { echo'<p style="color:red;font-size:15px;">'.@$_GET['q7'];}?>
        <input  type="submit" class="sub" value="sign up"/>
        </form>
		</div>
    <div class="footer">
      <span class="footer-left"><p>&copy; 2018 - Devinder Goyal | Johnson Khristi | Guru Patel</p></span><span class="footer-right"><p>User Login</p></span>
    </div>
