<?php
	
	/*
	Database Connection Informations
	*/

	/* The name of the database for ChelTikkeh */
	if( !defined( 'DB_NAME' ) )
		define( 'DB_NAME', 'cheltikkeh' );
	
	/* MySQL database username */
	if( !defined( 'DB_USER' ) )
		define( 'DB_USER', 'root' );

	/* MySQL database password */
	if( !defined( 'DB_PASS' ) )
		define( 'DB_PASS', '$N0uR@ni66' ); 

	/* MySQL hostname */
	if( !defined( 'DB_HOST' ) )
		define( 'DB_HOST', '127.0.0.1:3306' );

	/* Database Charset to use in creating database tables */
	if( !defined( 'DB_CHARSET' ) )
		define( 'DB_CHARSET', 'utf8' );

	/* The Database Collate type */
	if( !defined( 'DB_COLLATE' ) )
		define( 'DB_COLLATE', '' );
	
	
	
	/* Bank Account Identification Data */
	if( !defined( 'BANK_ID' ) )
		define( 'BANK_ID', 'PFKj0OljpS5b0gO142u3' );
	
	if( !defined( 'BANK_SEND_URL' ) )
		define( 'BANK_SEND_URL', 'https://pec.shaparak.ir/pecpaymentgateway/EShopService.asmx?wsdl' );
	
	if( !defined( 'BANK_GATE_URL' ) )
		define( 'BANK_GATE_URL', 'https://pec.shaparak.ir/pecpaymentgateway/?au=' );
	
	if( !defined( 'BANK_VERIFY_URL' ) )
		define( 'BANK_VERIFY_URL', 'https://pec.shaparak.ir/pecpaymentgateway/EShopService.asmx?wsdl' );
	
	if( !defined( 'BANK_CALLBACK_URL' ) )
		define( 'BANK_CALLBACK_URL', 'http://cheltikkeh.com/' );
	
	
	
	/* Mail Service Setup Data */
	if( !defined( 'MAIL_HOST' ) )
		define( 'MAIL_HOST', 'mail.cheltikkeh.com' );
	
	if( !defined( 'MAIL_USERNAME' ) )
		define( 'MAIL_USERNAME', 'support' );
	
	if( !defined( 'MAIL_PASSWORD' ) )
		define( 'MAIL_PASSWORD', '$N0uR@ni66' );
	
	if( !defined( 'MAIL_REPLY_TO' ) )
		define( 'MAIL_REPLY_TO', 'support@cheltikkeh.com' );
	
	if( !defined( 'MAIL_SET_FORM_MAIL' ) )
		define( 'MAIL_SET_FORM_MAIL', 'support@cheltikkeh.com' );
	
	if( !defined( 'MAIL_SET_FORM_TITLE' ) )
		define( 'MAIL_SET_FORM_TITLE', 'پشتیبانی سامانه چل تیکه' );
	
	if( !defined( 'MAIL_CHARSET' ) )
		define( 'MAIL_CHARSET', 'UTF-8' );
	
	if( !defined( 'MAIL_CONTENT_TYPE' ) )
		define( 'MAIL_CONTENT_TYPE', 'text/html' );
	
	
	
	/*
	Kernel and API Physical Path
	*/
	
	/* Kernel Physical Path */
	define( 'KERNEL', ROOT. '/kernel' );
	
	/* API Physical Path */
	define( 'API', ROOT. '/api' );
	
	/* Themes Physical Path */
	define( 'THEMES', ROOT. '/themes' );
	
