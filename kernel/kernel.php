<?php
	
	/* Define Kernel Directory Physical Path */
	if( !defined( 'KERNEL' ) )
		define( 'KERNEL', dirname( __FILE__ ) );

	
	/* Define Kernel PHP Functions Directory Physical Path */
	define( 'KERNEL_PHP', KERNEL. '/functions' );
	
	
	/* Load Database Block */
	if( file_exists( KERNEL_PHP. '/database.php' ) )
		require_once( KERNEL_PHP. '/database.php' );
	
	
	/* Load Session Block */
	if( file_exists( KERNEL_PHP. '/session.php' ) )
		require_once( KERNEL_PHP. '/session.php' );
	
	
	/* Load Content Block */
	if( file_exists( KERNEL_PHP. '/content.php' ) )
		require_once( KERNEL_PHP. '/content.php' );
	
	
	/* Load Mailer Block */
	if( file_exists( KERNEL_PHP. '/mailer.php' ) )
		require_once( KERNEL_PHP. '/mailer.php' );
	
	
	/* Load nusoap Block
	if( file_exists( KERNEL_PHP. '/nusoap.php' ) )
		require_once( KERNEL_PHP. '/nusoap.php' );
	*/
	
	/* Load Theme Block */
	if( file_exists( KERNEL_PHP. '/theme.php' ) )
		require_once( KERNEL_PHP. '/theme.php' );
	