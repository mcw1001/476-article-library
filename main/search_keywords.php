<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookindex";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$conn->select_db("bookindex");

$id = (int)$_POST["id"];

$sql="SELECT * FROM keywords WHERE book_id=$id LIMIT 100";
$result = $conn->query($sql);

if($result === FALSE){
    echo "\nError: ".$conn->error;
}else{
    $returnStr="";
    if($result->num_rows > 0){
        //encode in JSON then convert to string?
        // $books=[];
        while ($row = $result->fetch_assoc()) {
            $returnStr .= $row["keyword"].",";
        }
        // $json=json_encode($books);
        // $returnStr.=$json;

    }else{
        echo "No keywords found.";
    }
    echo $returnStr;
}
$conn->close();
?>