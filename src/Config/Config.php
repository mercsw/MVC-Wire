<?php

define ('DEVELOPMENT_ENVIRONMENT',TRUE);

if(DEVELOPMENT_ENVIRONMENT == TRUE)
{
	// Use SQLite for local dev
	$DB_CONSTRING = 'sqlite:/tmp/mvc-wire.sqlite';
	$DB_USER = '';
	$DB_PASSWORD = '';
}
else{	
	// Use Mysql for Production
	$DB_CONSTRING = 'mysql:host=localhost;dbname=mydatabase';
	$DB_USER = '';
	$DB_PASSWORD = '';
}

