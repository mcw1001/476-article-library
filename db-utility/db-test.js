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
    //password is 'password123', stored as an sha256 hash
    sql = `INSERT IGNORE INTO users (username, password, role)
    VALUES ("userguy", "ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f", 1)`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("user added");
    });

    // sql = `INSERT IGNORE INTO users (username, password, role)
    // VALUES ("adminguy", "password123", 2)`;
    // connection.query(sql, function (err, result) {
    //     if (err) throw err;
    //     console.log("admin added");
    // });

    //the password is 'pass', stored in an sha256 hash
    sql=`INSERT INTO users(username, password, role)
    VALUES ("admin", "d74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1", 2)`;
    connection.query(sql,function(err, result){
        if(err) throw err;
        console.log("admin added");
    })

    // test books
    //removed IGNORE to see any errors
    sql = `INSERT INTO books (name, author, publisher, publish_date, description, reception) 
    VALUES ("book1", "author1", "publisher1", "2001/04/01", "a cool book and all that", "positive")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("book1 added");
    });

    sql = `INSERT INTO books (name, author, publisher, publish_date, description, reception) 
    VALUES ("book2", "author2", "publisher1",  "1999/02/24", "another cool book and all that", "positive")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("book2 added");
    });
    
    sql = `INSERT INTO books (name, author, publisher, publish_date, description, reception) 
    VALUES ("book3", "author3", "publisher2", "1999/01/01", "book", "positive")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("book3 added");
    });

    // test articles //added more, as book_search looks thru books JOINed with articles, and a book without
    //      an article doesn't show up in search results
    sql = `INSERT INTO articles (book_id,content)
    VALUES (1, "my big article goes here")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("article for book1 added");
    });

    sql = `INSERT INTO articles (book_id,content)
    VALUES (2, "my big article 2 goes here")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("article for book2 added");
    });
    sql = `INSERT INTO articles (book_id,content)
    VALUES (3, "my big article 3 goes here")`;
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("article for book3 added");
    });
    

    // test inspirations

    sql = `INSERT INTO inspirations (book_id, inspiration_id)
    VALUES (1, 2)`
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("inspiration added");
    });

    sql = `INSERT INTO inspirations (book_id, inspiration_id)
    VALUES (1, 3)`
    connection.query(sql, function (err, result) {
        if (err) throw err;
        console.log("inspiration added");
    });

    sql = `INSERT INTO inspirations (book_id, inspiration_id)
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