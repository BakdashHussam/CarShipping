# CarShipping
Car Shipping Management System

**Database**

The database used for the application is MYSQL and the patch script is
in the "Database.txt" file where we create a database "car_shipping" and
a table "cars" with ID, Make, Model, Year, VIN, and Status columns.

**Backend**

The backend consists of RESTful API that allow:

Get Cars: A GET /cars endpoint that supports pagination. (Page is set to
3 records only for testing)

Add Car: A POST /cars endpoint to add a new car to the shipping list.

Update Status: A PATCH /cars/{id} endpoint to update the shipping status
of a car to "In Progress".

Remark: The API could be modified for further enhancement to be more
dynamic.

The backend is built under Node.js, the port is set to 3000 and to run
it: npm run start:dev

The Database settings is configured in .env file.

**Frontend**

The front end is built using PHP and using XAMPP Apache as a php server

The main page is: index.php where display the cars in db and the first
page (3 cars) with the button to Add Car that redirect to Create.php
page that allow to create new record and add new car.

The main page has two "Previous" and "Next" buttons that allow to
navigate pages.

For each record a button "Update Status" as action that change the
status of the record to "In Progress". For the updating status, it could
be enhanced to allow user to enter the value of the status.
