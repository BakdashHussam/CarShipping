require('dotenv').config();
const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const app = express();
const PORT = process.env.PORT;
//Our Database Config
const DB_HOST = process.env.DB_HOST;
const DB_DATABASE = process.env.DB_DATABASE;
const DB_USERNAME = process.env.DB_USERNAME;
const DB_PASSWORD = process.env.DB_PASSWORD;
const DB_PORT = process.env.DB_PORT;


//app.use(express.json());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));

const cars = []; // This will be your in-memory database

app.listen(PORT, function() {
 console.log('Restful API is running on PORT 3000');
});

//Connection to MySQL database
const db = mysql.createConnection({
    host: DB_HOST,  //'localhost',  //'localhost', //'127.0.0.1',
    port: DB_PORT,  //'3306',
    user: DB_USERNAME,  //'root',
    password: DB_PASSWORD,  //'',
    database: DB_DATABASE   //'car_shipping'
  });

db.connect((err) => {
if (err) {
    console.error('Error connecting to MySQL database: ' + err.stack);
    return;
}
console.log('Connected to MySQL database as id ' + db.threadId);
});

// Method to handle query
function queryPromise(sql, values=[]){
    return new Promise((resolve, reject) => {
        db.query(sql, values, (error, results) => {
            if(error){
                reject(error);
            }
            else{
                resolve(results);
            }
        })
    });
}


// GET /cars Collect cars list with pagination
app.get('/cars/:page', async(req, res) => {
    // Implement pagination logic here and return a subset of cars.
    try {
        const {page} = req.params;
        const offsetVal = (page-1)*3;
        const SQL = "SELECT * FROM cars LIMIT 3 OFFSET ?";
        const result = await queryPromise(SQL, [offsetVal]);
        res.json(result);
       
    }
    catch(err) {
        console.log(err);
    }
  });
  
  // POST /cars add a new car
  app.post('/cars', async(req, res) => {
    // Handle the creation of a new car entry here.
    try {
            var Make = req.body["Make"];
            var Model = req.body["Model"];
            var Year = req.body["Year"];
            var VIN = req.body["VIN"];
            var Status = req.body["Status"];
            
            // Validation Check
            if (!Make || !Model || !Year || !VIN || !Status){
                throw new Error("Values should not be empty!");
            }

            const vals = [Make, Model, Year , VIN , Status];
            const SQL = "INSERT INTO cars (Make, Model, Year , VIN , Status) VALUES (?,?,?,?,?)";
            const result = await queryPromise(SQL, vals);
            res.json({ID: result.insertId, Make, Model, Year, VIN, Status});

    }
    catch(err) {
        console.log(err);
    }
  });
  
  // PATCH /cars/{id} update car shipping status
  app.patch('/cars/:id', async(req, res) => {
    // Update the shipping status of a specific car by ID.
    try {
        const {id} = req.params;
        const SQL = "UPDATE cars SET Status='In Progress' WHERE ID = ?";
        const result = await queryPromise(SQL, [id]);
        if (result.affectedRows === 1) {
            res.json({id: id});
        }
        else {
            res.json({error: "Failed to update"});
        }
    }
    catch(err) {
        console.log(err);
    }
  });
  
