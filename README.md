# Scholarship Management System
A Scholarship Portal, where
* **Student** applies for the scholarship
* **College** verifies the student's applications belonging to that college
* **Admin** Sanctions the Scholarship to the applications verified by college

## Schema
![](data/schema.png)

## Requirements
* Xampp

## Set-up on your local machine
start xampp
```
/opt/lampp/xampp start
```
---
Extract the code into /opt/lampp/htdocs
```
cd /opt/lampp/htdocs
git clone https://github.com/sonydotgit/scholarship
```
---
Create a new database using phpmyadmin named 'scholarship' and import database/scholarship.sql
```
firefox localhost/phpmyadmin
```
---
Fireup the browser and go to index.php
```
firefox localhost/scholarship/index.php
```
