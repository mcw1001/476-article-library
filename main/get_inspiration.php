<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookindex";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$conn->select_db("bookindex");
// 
$id = (int)$_POST["id"];



$sql="SELECT * FROM inspirations WHERE book_id=$id LIMIT 100";
$result = $mysqli->query($sql);

$returnStr="";
$arr = [];
$arr["NONE"]= "No inspiration found."; //default state, overridden if anything else
if($result === FALSE){
    echo "\nError: ".$mysqli->error;
    // $arr = [];
    // $arr["ERROR"]=$mysqli->error;
}else{
    if($result->num_rows > 0){
        $arr = [];
        //encode in JSON then convert to string?
        // $books=[];
        while ($row = $result->fetch_assoc()) {
            // $returnStr .= $row["keyword"]." ";
            $arr[]= $row["inspiration_id"];
        }
        $json=json_encode($arr);
        // $returnStr.=$json;

    }
    echo $json;
}

$conn->close();



?>