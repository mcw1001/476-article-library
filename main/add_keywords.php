<!-- <html>

<head>
  <title>Add a User</title>
</head>

<body> -->
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

    $name = $_POST["name"];
    $author = $_POST["author"];
    $publisher = $_POST["publisher"];
    $publishdate = $_POST["publishdate"];
    $description = $_POST["description"];
    $reception = $_POST["reception"];

    if($name && $author && $description){
        //enable special error reporting
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
        $conn->select_db("bookindex");

        //using an sql transaction with variables to do multi-table insert with autoincrement values

        $conn->autocommit(false); //begins transaction

        $statement = $conn->prepare('INSERT INTO books(name,author,publisher,publish_date,description,reception)
        VALUES(?,?,?,?,?,?)');
        $statement->bind_param('ssssss',$name,$author,$publisher,$publishdate,$description,$reception);
        $statement->execute();

        $book_id = $conn->insert_id;
        $statement = $conn->prepare("INSERT INTO articles(book_id,content) VALUES(?, '')");
        $statement->bind_param('s',$book_id);
        $statement->execute();

        if($conn->commit()!=TRUE){
            echo "\nError: ".$conn->error;
        }else{
            echo "Book added successfully!";
        }
        
        $conn->autocommit(true);
        // "
        // SET @bookid = LAST_INSERT_ID()
        // INSERT INTO articles(book_id,content) VALUES(@bookid, '')
        // COMMIT;";
        // echo "SQL ".$sql."/n";
        // if($conn->query($sql)!=TRUE){
        //     echo "\nError: ".$conn->error;
        // }else{
        //     echo "User added successfully.";
        // }


        $conn->close();

    }else{
        echo "Error: missing information!";
    }
    
    ?>

<!-- </body>
</html> -->