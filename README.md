
## About Books

Books is a simple web application built with vue js and laravel. Users can Signup, create books and read books created by other users

## View Books

The Link below takes you to the web application
https://books-aft.herokuapp.com/

## About  API's

  Books
This shows all requested api's in books application

Authorization
API Key
Key
<key>
Value
<value>
POST
api/login
http://127.0.0.1:8000/api/logout
This logs in a user

Request Type: POST Request Values: { 'email', // Valid User Email 'password' // Valid User Password, Min Lenght : 6 } Expected Response : Status - 200 returns (json) { 'message',// Success message 'token', // User Token For authorization }, Status - 422 returns (json) Validation Error messages

Authorization
API Key
Key
<key>
Value
<value>
GET
api/logout
http://127.0.0.1:8000/api/logout
This logs out a user

Request Type: GET Request Values: None Expected Response : Status - 200 returns (json) { 'message',// Success message },

Authorization
API Key
This request is using an authorization helper from collection Books
POST
api/signup
http://127.0.0.1:8000/api/signup
This Creates new User

Request Type: POST Request Values: { 'name', // User Name - String 'email', // Valid User Email 'password' // Valid User Password, Min Length : 6 } Expected Response : Status - 200 returns (json) { 'message',// Success message }, Status - 422 returns (json) Error messages, Status - 500 returns (json) Server Error Message,

Authorization
API Key
This request is using an authorization helper from collection Books
GET
api/books
http://127.0.0.1:8000/api/books
Gets all books

Request Type: GET

Request Values: None AUTH Required Expected Response : Status - 200 returns (json) { books // Returns all books }, Status - 500 returns (json) Server Error messages

Authorization
API Key
This request is using an authorization helper from collection Books
POST
api/book
http://127.0.0.1:8000/api/book
Creates new book

Request Type: POST

Request Values: json { 'title' //String 'description' //String, max value - 255 } AUTH Required Expected Response : Status - 200 returns (json) { // Success Message }, Status - 422 returns (json) Validation Error messages Status - 500 returns (json) Server Error messages

Authorization
API Key
This request is using an authorization helper from collection Books
DEL
api/book/{id}
http://127.0.0.1:8000/api/book/{id}
This deletes a single book

Request Type: DELETE Request Values: NONE Request Parameters: ID //Book ID Expected Response : Status - 200 returns (json) { // Success Message }, Status - 500 returns (json) Server Error messages

Authorization
API Key
This request is using an authorization helper from collection Books
GET
api/book/{id}
http://127.0.0.1:8000/api/book/{id}
This gets a single book

Request Type: GET Request Values: NONE Request Parameters: ID //Book ID Expected Response : Status - 200 returns (json) { // Single Book Data }, Status - 500 returns (json) Server Error messages

Authorization
API Key
This request is using an authorization helper from collection Books


## License

The Book webapp is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
