<?php

require_once 'SqliteCrud.php';

/***************************************************************************************
								Using Functions of PHP SqliteCrud Class
***************************************************************************************/
	
	// Open the database connection

	$db = new SqliteCrud();
	   if(!$db) {
		  echo $db->lastErrorMsg();
		}else {
		  echo "Opened database successfully\n"."<br/><br/>";
		}

	// SQL Create Table
	
	$sqlCreateTable ="
		CREATE TABLE IF NOT EXISTS USERS (
			id 			INTEGER		PRIMARY KEY AUTOINCREMENT,
			firstname 	VARCHAR(30) NOT NULL,
			lastname 	VARCHAR(30) NOT NULL,
			email 		VARCHAR(50) NOT NULL,
			password  	VARCHAR(50) NOT NULL,
			age 		INT(3),
			location 	VARCHAR(25) DEFAULT NULL,
			date 		TIMESTAMP
		);
		";

	// SQL INSERT INTO Table

	$sqlInsert ="
		INSERT INTO USERS (firstname,lastname,email,password,age,location,date)
		VALUES ('Toto', 'TITI', 'toto@sqlite.com', '123456', '25', 'Niamey-Niger', '".date("Y-m-d H:i:s")."');
	
		INSERT INTO USERS (firstname,lastname,email,password,age,location,date)
		VALUES ('Alice', 'BOB', 'abob@sqlite.com', '123450', '30', 'Abuja-Nigeria', '".date("Y-m-d H:i:s")."');
		";
		
	// SQL UPDATE

	$sqlUpdate ="	
		UPDATE USERS set password = '123456789' where email='toto@sqlite.com';
		";
		
	// SQL SELECT

	$sqlSelect ="	
		SELECT * from USERS;
		";
		
	// SQL DELETE

	$sqlDelete ="	
		DELETE from USERS WHERE email='abob@sqlite.com';
		";

	/********************************************************
    * Use the main function
	* Choise the operation of CRUD you need to execute
	* CREATETABLE / INSERT / UPDATE / DELETE / SELECT for Default
	* @Return Boolean (true or false) For CREATETABLE / INSERT / UPDATE / DELETE Operations
	* @Return Array for SELECT Operation.
    *********************************************************/
	
	// $operation = $db->switchOperationsCrud("CREATETABLE",$sqlCreateTable); // Example of create table
	// $operation = $db->switchOperationsCrud("INSERT",$sqlInsert); // Example of Insert operation
	// $operation = $db->switchOperationsCrud("UPDATE",$sqlUpdate); // Example of Update operation
	// $operation = $db->switchOperationsCrud("DELETE",$sqlDelete); // Example of Delete operation
	
	$operation = $db->switchOperationsCrud("",$sqlSelect); // Example of Select operation
	if(!$operation) {
      echo $db->lastErrorMsg();
	}else {
      var_dump($operation);
	}
	
	
?>