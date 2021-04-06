<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookindex";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$conn->select_db("bookindex");

$name = $_POST["name"];
// $sqlName = "name LIKE '%$name%'";
// if($name==''){$sqlName = "";}
$author = $_POST["author"];
// $sqlAuthor = "author LIKE '%$author%'";
// if($author==''){$sqlAuthor="";}
$publisher = $_POST["publisher"];
// $sqlPublisher = "author LIKE '%$publisher%'";
// if($publisher==''){$sqlPublisher="";}


$checkall = $_POST['checkall'];
$sql="SELECT * FROM books INNER JOIN articles ON books.book_id=articles.book_id
WHERE ('$name'!='' AND name LIKE '%$name%') OR ('$author'!='' AND author LIKE '%$author%') 
OR ('$publisher'!='' AND publisher LIKE '%$publisher%') ";
if($checkall==0){ 
    $sql .= "LIMIT 1";
}else if ($checkall!=1){
    $sql = "SELECT * FROM books INNER JOIN articles ON books.book_id=articles.book_id";
}
$result = $conn->query($sql);

if($result === FALSE){
    die($conn->error);
}

$returnStr="";
if($result->num_rows > 0){
    //encode in JSON then convert to string?
    $books=[];
    while ($row = $result->fetch_assoc()) {
        if($checkall==0){
            $books=$row;
        }else{
            $books[$row['book_id']]=$row;
        }

        //area to sql select inspirations?
    }
    // $returnStr="<table id='bookTable'><tr><th>ID</th><th>Name</th><th>Password</th><th>Role</th></tr>";
    // while ($row = $result->fetch_assoc()) {
    //     $returnStr.="<tr><td>".$row['id']."</td><td>".$row['name'].
    //     "</td><td>".$row['password']."</td><td>".$row['role']."</td></tr>";
    // }
    //$returnStr .="</table>";
    $json=json_encode($books);
    $returnStr.=$json;

}else{
    echo "No book found.";
}
echo $returnStr;

$conn->close();
?>