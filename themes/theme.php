<?php
	
	/* Define Themes Directory Physical Path */
	if( !defined( 'THEMES' ) )
		define( 'THEMES', dirname( __FILE__ ) );
	
	/* Find Selected Theme & Load It */
	$theme = theme( 'active' );
	
	/* Load Active Theme index.php File */
	define( 'THEME', THEMES. '/'. $theme );
	
	if( file_exists( THEME. '/index.php' ) )
		require_once( THEME. '/index.php' );
