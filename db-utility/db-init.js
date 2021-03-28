var mysql = require('mysql');
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
});

// See https://dbdiagram.io/d/605cf9dcecb54e10c33d4cc5 for schema
// To run:
// npm i (if you have not already)
// node db-init OR npm run init
connection.connect(function(err) {
    if (err) {
      console.error('error connecting: ' + err.stack);
      return;
    }
   
    connection.query("CREATE DATABASE IF NOT EXISTS bookindex", function (err, result) {
        if (err) throw err;
        console.log("Database created!");
    });
    connection.query("USE bookindex");

    // USERS TABLE
    let sql = `CREATE TABLE IF NOT EXISTS users (
        user_id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL, 
        role TINYINT NOT NULL
    )`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("Created users table!");
    });

    // BOOKS TABLE
    sql = `CREATE TABLE IF NOT EXISTS books (
        book_id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
        name VARCHAR(255) NOT NULL,
        author VARCHAR(255) NOT NULL,
        publisher VARCHAR(255),
        publish_date DATE,
        description VARCHAR(1000) NOT NULL,
        reception VARCHAR(255)
    )`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("Created books table!");
    });

    // REVIEWS TABLE
    sql = `CREATE TABLE IF NOT EXISTS reviews (
        review_id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        book_id BIGINT NOT NULL,
        rating TINYINT NOT NULL,
        review VARCHAR(500),
        FOREIGN KEY (book_id) REFERENCES books(book_id)
    )`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("Created reviews table!");
    });

    // KEYWORDS TABLE
    sql = `CREATE TABLE IF NOT EXISTS keywords (
        book_id BIGINT NOT NULL,
        keyword VARCHAR(255),
        FOREIGN KEY (book_id) REFERENCES books(book_id),
        PRIMARY KEY(book_id, keyword)
    )`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("Created keywords table!");
    });

    // INSPIRATIONS TABLE
    sql = `CREATE TABLE IF NOT EXISTS inspirations (
        book_id BIGINT NOT NULL,
        inspiration_id BIGINT NOT NULL,
        FOREIGN KEY (book_id) REFERENCES books(book_id),
        FOREIGN KEY (inspiration_id) REFERENCES books(book_id),
        PRIMARY KEY(book_id, inspiration_id)
    )`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("Created inspirations table!");
    });

    // ARTICLES TABLE
    sql = `CREATE TABLE IF NOT EXISTS articles (
        book_id BIGINT PRIMARY KEY NOT NULL,
        content MEDIUMTEXT,
        FOREIGN KEY (book_id) REFERENCES books(book_id)
    )`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("Created articles table!");
    });

    connection.end();
});