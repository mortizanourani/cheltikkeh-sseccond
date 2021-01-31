<?php
	/*
	Theme Block
	*/

	/* Theme Block SubRoutines */

	
	/* Theme Block Main Routine */
	function theme( $routine, $args = array() ){
		$output = NULL;
		switch( strtolower( $routine ) ){
			case( 'active' ):
				$theme = database( 'read', DB_NAME, array(
					'table_name'		=> 'themes',
					'conditions'		=> 'active = "true"',
					) );
				$output = $theme['directory'];
				break;
				
			default:
				die( "THEME_ERROR" );
		}
		
		if( $output ) return $output;
		return;
	}