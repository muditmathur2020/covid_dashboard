<?php
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$cityn=$_POST['cityn'];
$addt=$_POST['addt'];
$f=$_POST['s1'];
$t=$_POST['s2'];
$dc=$_POST['s3'];
 if(!empty($fname) ||!empty($lname) ||!empty($city) ||!empty($addt) || !empty($f) ||!empty($t) || !empty($dc))
 {
	$host="localhost";
	$dbUsername="root";
	$dbPassword="";
	$dbname="hackchennai";
	//create connection
	$conn = new MySQLI($host,$dbUsername,$dbPassword,$dbname);
	  if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } 
	 else {
     $SELECT = "SELECT fname From backend Where fname = ? Limit 1";
     $INSERT = "INSERT Into backend (fname, lname, cityn, addt, f, t, dc) values(?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $fname);
     $stmt->execute();
     $stmt->bind_result($fname);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssss", $fname, $lname, $cityn, $addt, $f, $t, $dc);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already used this identity to report";
			}
     $stmt->close();
     $conn->close();
    }
}
 
else{
	echo "All fields are required";
	die();
}
?>