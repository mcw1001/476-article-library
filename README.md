# Bookindex
Our final project for our Internet Computing course. A mishmash of personal wiki and library/database. 


## Instructions

Make sure you have Nodejs installed under xampp, that xampp is running apache and mysql.

First, to initialize the database, go to the db-utiity folder in a command terminal and run npm i to install relevant tools.
Next, use nodejs to run db-init.js. Run db-test.js as well to create some accounts and fill the database with some data to test.

To begin using the webapp, go to the main folder and open login.html.
From there, you can login to an account.
db-test.js creates two main accounts that you can use to login initially:
admin, password is "pass"
userguy, password is "password123"

Once logged in, a cookie will keep you logged in for 30 minutes (or if you log out).
Simply follow the prompts and try the different features.