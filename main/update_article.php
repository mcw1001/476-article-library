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
$article = $_POST["article"];
if($id && $article){
    //enable special error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    $conn->select_db("bookindex");

    $sql = "UPDATE LOW_PRIORITY articles
    SET content = '$article'
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