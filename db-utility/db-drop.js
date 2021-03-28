var mysql = require('mysql');
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    dbname: 'bookindex',
    password: '',
});

// To run:
// npm i (if you have not already)
// node db-drop OR npm run drop
connection.connect(function(err) {
    if (err) {
      console.error('error connecting: ' + err.stack);
      return;
    }
   
    connection.query("DROP DATABASE bookindex", function(err, result) {
        if (err) throw err;
        console.log("Database successfully dropped!")
    });

    connection.end();
});