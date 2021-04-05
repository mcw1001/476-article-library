
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookindex";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$conn->select_db("bookindex");

$name = $_POST["name"];
$pass = $_POST["pass"];
// $passHash = sha1($pass);
$passHash = hash("sha256",$pass); // get hash of current login password to compare

//this is probably vulnerable to injection now that I think abt it
$sql = "SELECT * FROM users WHERE username = '".$name."' LIMIT 1";
$result = $conn->query($sql);

if($result === FALSE){
    die($conn->error);
}

$returnStr="";
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $storedPassHash = $row['password'];

    if(strcmp($passHash,$storedPassHash)==0){
        //return number matching role
        $returnStr="role#".$row['role'];
    }else{
        // console.log("stored ".$storedPassHash." != ".$pass." given");
        $returnStr="no";
        // $returnStr = "storedPassHash ".$storedPassHash." != ".$pass;
    }
   
}else{
    $returnStr = "fail"; 
}
echo $returnStr;

$conn->close();
?>