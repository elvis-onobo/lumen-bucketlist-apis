
## API Documentation Link

https://documenter.getpostman.com/view/8410691/SVfQRpKN

## .ENV

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bucketlist
DB_USERNAME=root
DB_PASSWORD=
```

NOTE: You will need to create a JWT Secret key

```
php artisan jwt:secret
```

## The Project

Problem Description
In this exercise you will be required to create a Restful API for a bucket list service. Specification for the API is shown below. You may use any database you prefer for this assignment. Make use of any framework you desire.

EndPoint	Functionality
```
POST /auth/login	Logs a user in

GET /auth/logout	Logs a user out

POST /bucketlists/	Create a new bucket list

GET /bucketlists/	List all the created bucket lists

GET /bucketlists/<id>	Get single bucket list
	
PUT /bucketlists/<id>	Update this bucket list
	
DELETE /bucketlists/<id>	Delete this single bucket list
	
POST /bucketlists/<id>/items/	Create a new item in bucket list
	
GET /bucketlists/<id>/items	List all the created items in a bucket list
	
GET /bucketlists/<id>/items/<id>	Get a single item in a bucket list
	
PUT /bucketlists/<id>/items/<item_id>	Update a bucket list item
	
DELETE /bucketlists/<id>/items/<item_id>	Delete an item in a bucket list
```

Task 0 - Create API
In this task you are required to create the API described above using any microframework. The JSON data model for a bucket list and a bucket list item is shown below.

```
{
    id: 1,
    name: “BucketList1”,
    items: [
        {
            id: 1,
            name: “I need to do X”,
            date_created: “2015-08-12 11:57:23”,
            date_modified: “2015-08-12 11:57:23”,
            done: False
        }
    ]
    date_created: “2015-08-12 11:57:23”,
    date_modified: “2015-08-12 11:57:23”
    created_by: “1113456”
}
```

Task 1 - Implement Token Based Authentication
For this task, you are required to implement Token Based Authentication for the API using Json Web Tokens(JWT) such that some methods are not accessible via unauthenticated users. Access control mapping is listed below.

EndPoint	Public Access
```
POST /auth/login	TRUE

GET /auth/logout	FALSE

POST /bucketlists/	FALSE

GET /bucketlists/	FALSE

GET /bucketlists/<id>	FALSE
	
PUT /bucketlists/<id>	FALSE
	
DELETE /bucketlists/<id>	FALSE
	
POST /bucketlists/<id>/items/	FALSE
	
PUT /bucketlists/<id>/items/<item_id>	FALSE
	
DELETE /bucketlists/<id>/items/<item_id>	FALSE
```

Task 2 - Implement Pagination on your API
For this task, you are required to implement pagination on your API such that users can specify the number of results they would like to have via a GET parameter limit. The default number of results is 20 and the maximum number of results is 100. 
Note: Do not use a gem for this.


Request
GET http://localhost:5555/bucketlists?page=2&limit=20


Response
20 bucket list records belonging to the logged in user.


Task 3 - Implement Searching by name
For this task, you are required to implement searching for bucket lists based on the name using a GET parameter q.


Request
GET http://localhost:5555/bucketlists?q=bucket1


Response
Bucket lists with the string “bucket1” in their name.


Task 4 - Version your API
The api can be accessed thus - somedomain.com/api/v1/someendpoint

Task 5 - Document your API
Use API Blueprint, slate or swagger or any other to document your API.
Docs should be available at the root url.


Task 6 - React/Angular/Vue
Build a minimalism design to handle Frontend of the API giving user the best of experience.


For this exercise, take care to make use of RESTful API design best practices.

