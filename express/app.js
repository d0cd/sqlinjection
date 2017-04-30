/**
 * Created by pranav on 4/28/17.
 */
'use strict'

var express = require('express');
var app = express()
var bodyParser = require('body-parser');
var path = require('path');
var mysql = require('mysql');
var connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "password",
    database: "store"
});

connection.connect(function(err) {
    if (err) {
        console.log("Error connecting to database.");
        console.log(err);
        return;
    } else {
        console.log("Connected to database.")
    }
});


app.use(bodyParser.urlencoded({ extended: true}));
app.use(bodyParser.json());

app.get("/", function(req, res) {
    res.sendFile(path.join(__dirname, "form.html"));
});

app.post("/send", function(req, res) {
    console.log(req.body.firstname);
    console.log(req.body.lastname);
    console.log(req.body.secretMessage);
    var values = {
        FirstName: req.body.firstname,
        LastName: req.body.lastname,
        SecretMessage:req.body.secretMessage
    };
    connection.query('INSERT INTO `secrets` SET ?', [values], function (err, rows, fields) {
        if (err) {
            console.log("Failed to insert into table");
        } else {
            console.log("Insert successful");
        }
    });
    res.redirect("/");
});


app.get("/secrets", function(req, res) {
    connection.query('SELECT * FROM `secrets`', function (err, rows, fields) {
        if (err) {
            console.log("Failed to query table");
            console.log(err);
        } else {
            res.send(rows);
            console.log("Query successful");
        }
    });
});


app.listen(8080);
