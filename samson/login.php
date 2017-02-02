<?php session_start();?>

<html>
<title>BOOKS</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style/style.css">

<body>

<!-- Navbar  -->
<div class="w3-top">
  <ul class="w3-navbar w3-white w3-wide w3-padding-8 w3-card-2">
    <li>
      <a href="#home" class="w3-margin-left"><b>MY</b> LIBRARY</a>
    </li>
    <!-- Float links to the right. Hide them on small screens -->
    <li class="w3-right w3-hide-small">
      <a href="#projects" class="w3-left">Welcome</a>
      
    </li>
  </ul>
</div>
<?php
$c = oci_connect("loyal","loyal","localhost/xe");
if (!$c) {
  $e= oci_error();
  trigger_error('Could not connect to the database:'.$e['message'],E_USER_ERROR);
}

$s=oci_parse($c, "select * from Books");

if (!$s) {
  $e=oci_error($c);
  trigger_error('Could not parse statement:'.$e['message'],E_USER_ERROR);

}
$r= oci_execute($s);
if (!$r) {
  $e=oci_error($s); 
  trigger_error('Could not execute statement:'.$e['message'],E_USER_ERROR);
}
?>


<form method="post" align= "center" action="#">
	<h1> LOG-IN </h1>
	<label class="w3-margin-left">Username :</label>
	<input type="text", name="username", placeholder="Enter Username"/> <br>
	<label class="w3-margin-left">Password :</label>
	&nbsp<input type="password", name="password", placeholder="Enter Password"/> <br>
	<input class="w3-margin-left" type="submit" name="submit" value="GO"/> <br>
	</form>

<?php
	if(isset($_POST['submit'])){
	
		$c_user = addslashes($_POST['username']);
		$c_pass =addslashes ($_POST['password']);
		$sel_c = "select * from USERS where pass ='".$c_pass."' AND username='".$c_user."'";
		$run_c = oci_parse($c, $sel_c);
		$ex = oci_execute($run_c);
		$a = oci_fetch_array($run_c);
		$check=oci_num_rows($run_c);
		echo $check;
		while(($row=oci_fetch_array($run_c, OCI_ASSOC + OCI_RETURN_NULLS))!=False){
		
	}
		if($check == 0){
			echo "<script>alert('password or email is incorrect!')</script>";
		}else{
			header("Location: index.php");
		}
		
		

	}


?>


</body>
</html>