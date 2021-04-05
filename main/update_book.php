<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookindex";
// check db creation scripts in db-utility

/**
 * post data: {name: txtTitle, author: txtAuthor, publisher: txtPublisher,
 *               publishdate: datePublished, description: txtDescription,
 *  reception: txtReception, keywords: txtKeywords}
         
    */
$id = (int)$_POST["id"];
$name = $_POST["name"];
$author = $_POST["author"];
$publisher = $_POST["publisher"];
$publishdate = $_POST["publishdate"];
$description = $_POST["description"];
$reception = $_POST["reception"];

if($id && $name && $author && $description){
    //enable special error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    $conn->select_db("bookindex");

    $sql = "UPDATE LOW_PRIORITY books
    SET name = '$name', author = '$author', publisher = '$publisher', publish_date = '$publishdate',
    description = '$description', reception = '$reception'
    WHERE book_id = $id";
    
    if($conn->query($sql)!=TRUE){
        echo "\nError: ".$conn->error;
    }else{
        echo "Book updated successfully!";
    }

    $conn->close();

}else{
    echo "Error: missing information!";
}

?>