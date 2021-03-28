var mysql = require('mysql');
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    dbname: 'bookindex',
    password: '',
});

connection.connect(function(err) {
    if (err) {
      console.error('error connecting: ' + err.stack);
      return;
    }
    connection.query("USE bookindex");
    let sql;

    // test users

    sql = `INSERT IGNORE INTO users (username, password, role)
    VALUES ("userguy", "password123", 1)`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("user added");
    });

    sql = `INSERT IGNORE INTO users (username, password, role)
    VALUES ("adminguy", "password123", 2)`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("admin added");
    });

    // test books

    sql = `INSERT IGNORE INTO books (name, author, publisher, publish_date, description, reception) 
    VALUES ("book1", "author1", "publisher1", 2001/04/01, "a cool book and all that", "positive")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("book1 added");
    });

    sql = `INSERT IGNORE INTO books (name, author, publisher, publish_date, description, reception) 
    VALUES ("book2", "author2", "publisher1",  1999/02/24, "another cool book and all that", "positive")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("book2 added");
    });
    
    sql = `INSERT IGNORE INTO books (name, author, publisher, publish_date, description, reception) 
    VALUES ("book3", "author3", "publisher2", 1999/01/01, "book", "positive")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("book3 added");
    });

    // test articles
    sql = `INSERT IGNORE INTO articles 
    VALUES (1, "my big article goes here")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("article for book1 added");
    });

    // test inspirations

    sql = `INSERT IGNORE INTO inspirations (book_id, inspiration_id)
    VALUES (1, 2)`
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("inspiration added");
    });

    sql = `INSERT IGNORE INTO inspirations (book_id, inspiration_id)
    VALUES (1, 3)`
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("inspiration added");
    });

    sql = `INSERT IGNORE INTO inspirations (book_id, inspiration_id)
    VALUES (2, 3)`
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("inspiration added");
    });

    sql = `SELECT * FROM inspirations WHERE book_id=1`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log(result);
    });

    connection.end();
});