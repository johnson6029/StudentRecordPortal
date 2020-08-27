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
</head>
 <?php
 include_once 'dbConnection.php';
 ?>
 <body>
 <div class="header">
 <div class="row">
 <div class="logo_div">
 <span class="logo">Quiz<strong>App</strong></span></div>
 <div class="user_info_col user_info_col1">
  <?php
  include_once 'dbConnection.php';
 session_start();
   if(!(isset($_SESSION['email']))){
 header("location:index.php");

 }
 else
 {
 $name = $_SESSION['name'];
 $email=$_SESSION['email'];

 include_once 'dbConnection.php';
 echo '<span class="title1">&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php?q=1" class="log">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log">&nbsp;Signout</button></a></span>';
 }?>
 </div>
 </div></div>
 <div class="bg">
   <div id="tabMenu">
   <ul class="topnev">
  <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="account.php?q=1">&nbsp;Home<span class="sr-only">(current)</span></a></li>
           <li>|</li>
  <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="account.php?q=2">&nbsp;History</a></li>
       <li>|</li>
  <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="account.php?q=3">&nbsp;Ranking</a></li>
   </ul>
   </div>

 <div class="container"><!--container start-->
 <div class="row">
 <div class="logo_div">

 <!--home start-->
 <?php if(@$_GET['q']==1) {

 $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
 echo  '<div class="panel"><table class="table table-striped table_title">
 <tr><td><b>S No.</b></td><td><b>Topic</b></td><td><b>Questions</b></td><td><b>Marks</b></td><td><b>Progress</b></td></tr>';
 $c=1;
 while($row = mysqli_fetch_array($result)) {
 	$title = $row['title'];
 	$total = $row['total'];
 	$sahi = $row['sahi'];
     $time = $row['time'];
 	$eid = $row['eid'];
 $q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
 $rowcount=mysqli_num_rows($q12);
 if($rowcount == 0){
 	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td>
 	<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" style="margin:0px;padding:2px 7px 6px 2px;background:#003366">&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
 }
 else
 {
 echo '<tr style="color:#990033"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td>
 	<td><b><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'" style="margin:0px;padding:5px 7px 6px 5px;background:#990033"&nbsp;<span class="title1"><b>Re-take</b></span></a></b></td></tr>';
 }
 }
 $c=0;
 echo '</table></div>';

 }?>
 <!--<span id="countdown" class="timer"></span>
 <script>
 var seconds = 40;
     function secondPassed() {
     var minutes = Math.round((seconds - 30)/60);
     var remainingSeconds = seconds % 60;
     if (remainingSeconds < 10) {
         remainingSeconds = "0" + remainingSeconds;
     }
     document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
     if (seconds == 0) {
         clearInterval(countdownTimer);
         document.getElementById('countdown').innerHTML = "Buzz Buzz";
     } else {
         seconds--;
     }
     }
 var countdownTimer = setInterval('secondPassed()', 1000);
 </script>-->

 <!--home closed-->

 <!--quiz start-->
 <?php
 if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
 $eid=@$_GET['eid'];
 $sn=@$_GET['n'];
 $total=@$_GET['t'];
 $q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
 echo '<div class="panel" style="margin:5%">';
 while($row=mysqli_fetch_array($q) )
 {
 $qns=$row['qns'];
 $qid=$row['qid'];
 echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';
 }
 $q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
 echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
 <br />';

 while($row=mysqli_fetch_array($q) )
 {
 $option=$row['option'];
 $optionid=$row['optionid'];
 echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
 }
 echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
 //header("location:dash.php?q=4&step=2&eid=$id&n=$total");
 }
 //result display
 if(@$_GET['q']== 'result' && @$_GET['eid'])
 {
 $eid=@$_GET['eid'];
 $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
 echo  '<div class="panel">
 <center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

 while($row=mysqli_fetch_array($q) )
 {
 $s=$row['score'];
 $w=$row['wrong'];
 $r=$row['sahi'];
 $qa=$row['level'];
 echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
       <tr style="color:#003366"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr>
 	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
 	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
 }
 $q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
 while($row=mysqli_fetch_array($q) )
 {
 $s=$row['score'];
 echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
 }
 echo '</table></div>';

 }
 ?>
 <!--quiz end-->
 <?php
 //history start
 if(@$_GET['q']== 2)
 {
 $q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
 echo  '<div class="panel title">
 <table class="table table-striped title1" >
 <tr style="color:red"><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
 $c=0;
 while($row=mysqli_fetch_array($q) )
 {
 $eid=$row['eid'];
 $s=$row['score'];
 $w=$row['wrong'];
 $r=$row['sahi'];
 $qa=$row['level'];
 $q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
 while($row=mysqli_fetch_array($q23) )
 {
 $title=$row['title'];
 }
 $c++;
 echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
 }
 echo'</table></div>';
 }

 //ranking start
 if(@$_GET['q']== 3)
 {
 $q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
 echo  '<div class="panel title">
 <table class="table table-striped title1" >
 <tr style="color:red"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>College</b></td><td><b>Score</b></td></tr>';
 $c=0;
 while($row=mysqli_fetch_array($q) )
 {
 $e=$row['email'];
 $s=$row['score'];
 $q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
 while($row=mysqli_fetch_array($q12) )
 {
 $name=$row['name'];
 $gender=$row['gender'];
 $college=$row['college'];
 }
 $c++;
 echo '<tr><td style="color:#003366"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$gender.'</td><td>'.$college.'</td><td>'.$s.'</td><td>';
 }
 echo '</table></div>';}
 ?>



 </div></div></div></div>
 <footer class="site-footer">
  &copy; 2018 - Devinder Goyal | Johnson Khristi | Guru Patel
 </footer>


 </body>
 </html>
