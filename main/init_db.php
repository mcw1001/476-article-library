<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookindex";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$check = $conn->select_db("bookindex");
if($check===false){ //db doesn't exist, create

    // $sql = ;
    $result = $conn->query("CREATE DATABASE IF NOT EXISTS bookindex");
    if($result===false){
        die($conn->error);
    }

    $sql = "CREATE TABLE IF NOT EXISTS users (
        user_id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL, 
        role TINYINT NOT NULL
    )";
    $result = $conn->query($sql);
    if($result===false){
        die($conn->error);
    }
    $sql = "CREATE TABLE IF NOT EXISTS books (
        book_id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
        name VARCHAR(255) NOT NULL,
        author VARCHAR(255) NOT NULL,
        publisher VARCHAR(255),
        publish_date DATE,
        description VARCHAR(1000) NOT NULL,
        reception VARCHAR(255)
    )";
    $result = $conn->query($sql);
    if($result===false){
        die($conn->error);
    }
    $sql="CREATE TABLE IF NOT EXISTS reviews (
        review_id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        book_id BIGINT NOT NULL,
        rating TINYINT NOT NULL,
        review VARCHAR(500),
        FOREIGN KEY (book_id) REFERENCES books(book_id)
        ON DELETE CASCADE
    )";
    $result = $conn->query($sql);
    if($result===false){
        die($conn->error);
    }
    $sql="CREATE TABLE IF NOT EXISTS keywords (
        book_id BIGINT NOT NULL,
        keyword VARCHAR(255),
        FOREIGN KEY (book_id) REFERENCES books(book_id)
        ON DELETE CASCADE,
        PRIMARY KEY(book_id, keyword)
    )";
    $result = $conn->query($sql);
    if($result===false){
        die($conn->error);
    }
    $sql="CREATE TABLE IF NOT EXISTS inspirations (
        book_id BIGINT NOT NULL,
        inspiration_id BIGINT NOT NULL,
        FOREIGN KEY (book_id) REFERENCES books(book_id)
        ON DELETE CASCADE,
        FOREIGN KEY (inspiration_id) REFERENCES books(book_id)
        ON DELETE CASCADE,
        PRIMARY KEY(book_id, inspiration_id)
    )";
    $result = $conn->query($sql);
    if($result===false){
        die($conn->error);
    }
    $sql = "CREATE TABLE IF NOT EXISTS articles (
        book_id BIGINT PRIMARY KEY NOT NULL,
        content MEDIUMTEXT,
        FOREIGN KEY (book_id) REFERENCES books(book_id)
        ON DELETE CASCADE
    )";
    
    $result = $conn->query($sql);
    if($result===false){
        die($conn->error);
    }


    //Insert some basic values on creation:

    $sql = "INSERT INTO users(username, password, role)
    VALUES ('admin', 
    'd74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1', 2)";
    
    $result = $conn->query($sql);
    if($result===false){
        die($conn->error);
    }





}

//$sql="SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'bookindex'";



$conn->close();
?>