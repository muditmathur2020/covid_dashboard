<?php
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$addt=$_POST['addt'];
$med=$_POST['med'];
 if(!empty($fname) ||!empty($lname) ||!empty($addt) ||!empty($med))
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
     $SELECT = "SELECT fname From pharma Where fname = ? Limit 1";
     $INSERT = "INSERT Into pharma (fname, lname, addt, med) values(?, ?, ?, ?)";
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
      $stmt->bind_param("ssss", $fname, $lname, $addt, $med);
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