<meta charset="utf-8" />
<?php
	
	/*
	API of Cheltikkeh
	*/

	/* Load Kernel of ChelTikkeh (CT) */
	require_once( KERNEL. '/kernel.php' );
	
	
	/* Define API PHP Functions Directory Physical Path */
	define( 'API_PHP', API. '/functions' );
	
	
	/* Load Detector Block */
	if( file_exists( API_PHP. '/detector.php' ) )
		require_once( API_PHP. '/detector.php' );
	
	
	/* Load Operator Block */
	if( file_exists( API_PHP. '/operator.php' ) )
		require_once( API_PHP. '/operator.php' );
	
	/* Detect Address Essential Data */
	$page = detect( 'address' );
	
	/* Load Content Data */
	$content = operate( $page['operation'], $page['page'], $page['sub'], $page['args'] );
	
	/* Load Theme Block */
	if( file_exists( THEMES. '/theme.php' ) )
		require_once( THEMES. '/theme.php' );
