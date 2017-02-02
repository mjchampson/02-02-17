<?php session_start();?>
 
<!DOCTYPE html>
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
      <a href="#projects" class="w3-left"><a href="delete_session.php"> Logout</a>
      
    </li>
  </ul>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="style/images/libraries.jpg" alt="Architecture" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white">

    <span class="w3-padding w3-black w3-opacity-min"><b>MY</b></span> <span class="w3-hide-small w3-text-light-grey">Library</span></h1>
  </div>
</header>



<div align="center"class="w3-container w3-padding-32" id="about">
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

echo "<table border='1'>\n";
$ncols=oci_num_fields($s);
echo"<tr>\n";
for($i=1;$i<=$ncols;++$i){
  $colname=oci_field_name($s, $i);
  echo "<th><b>".htmlentities($colname, ENT_QUOTES)."</b></th>\n";
}
echo "</tr>\n";
while(($row=oci_fetch_array($s,OCI_ASSOC + OCI_RETURN_NULLS))!=False){
  echo "<tr>\n";
  foreach ($row as $item) {

    echo "<td>".($item!==null?htmlentities($item,ENT_QUOTES):"&nbsp;")."</td>\n";

  }
  echo "<tr>\n";
}
echo "<table>\n";
?>
</div>



  <!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-12">About</h3>
    <p>LIBRARY
    </p>
  </div>


</body>
</html>
