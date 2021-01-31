<?php
	/*
	SESSION Block
	*/

	/* SESSION Block SubRoutines */
	function start_session(){
		if( !isset( $_SESSION ) ){
			ini_set( 'session.cookie_domain', '.cheltikkeh.com' );
			session_start();
		}
	}
	
	/* SESSION Block Main Routine */
	function session( $routine, $args = array() ){
		switch( strtolower( $routine ) ){
			case( 'is_online' ):
				start_session();
				$output = false;
				if( isset( $_SESSION['login_user'] ) )
					$output = true;
				break;
				
			case( 'user_info' ):
				$output = NULL;
				start_session();
				if( isset( $_SESSION['login_user'] ) )
					$output = database( 'read', DB_NAME, array(
						'table_name'		=> 'users',
						'conditions'		=> 'username="'. $_SESSION['login_user']. '"',
					) );
				break;
			
			case( 'login' ):
				start_session();
				$default_args = array(
					'username'			=> '',
					'password'			=> '',
				);
				
				$args = array_merge( $default_args, $args );
				$login = database( 'num_rows', DB_NAME, array(
					'table_name'		=> 'users',
					'conditions'		=> 'username="'. $args['username']. '" AND password="'. $args['password']. '"',
				) );
				
				$output = -1;
				if( $login ){
					$_SESSION['login_user'] = $args['username'];
					
					$_SESSION['cart'] = array(
						'plans'				=> NULL,
						'modules'			=> NULL,
						'templates'			=> NULL,
					);
					
					$output = 1;
				}
				break;
				
			case( 'logout' ):
				start_session();
				
				if( isset( $_SESSION['cart'] ) )
					unset( $_SESSION['cart'] );
				
				if( isset( $_SESSION['login_user'] ) )
					unset( $_SESSION['login_user'] );
				break;
				
			case( 'captcha' ):
				start_session();
				$output = false;
				/* Check The Captcha */
				/* If Captcha Is Valid Return True */
				$output = true;
				break;
				
			default:
				die( "SESSION_ERROR" );
		}
		
		if( isset( $output ) ) return $output;
		return;
	}