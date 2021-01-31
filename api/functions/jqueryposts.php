<?php
	/*
	jQuery Posts Block
	*/
	
	define( 'ROOT', dirname( dirname( dirname( __FILE__ ) ) ) );
	
	require_once( ROOT. '/initialize.php' );
	
	require_once( KERNEL. '/kernel.php' );
	
	/* jQuery Posts Block SubRoutines */
	
	/* jQuery Posts Block Main Routine */
	switch( $_POST['operation'] ){
		case( 'unique_check' ):
			if( isset( $_POST['username'] ) ){
				$conditions = 'username="'. $_POST['username']. '"';
			}elseif( isset( $_POST['email'] ) ){
				$conditions = 'email="'. $_POST['email']. '"';
			}else{
				die( '0' );
			}
			
			$exists = database( 'num_rows', DB_NAME, array(
				'table_name'			=> 'users',
				'conditions'			=> $conditions,
			) );
			
			if( !$exists ) die( '1' );
			die( '-1' );
			
			break;
		
		case( 'addto' ):
			$sub = $_POST['type'];
			$args_id = $_POST['id'];
			
			if( !isset( $_SESSION ) ) session_start();
			
			if( !isset( $_SESSION['cart'] ) ) die( '-1' );
			
			$product = database( 'read', DB_NAME, array(
				'table_name'			=> $sub,
				'conditions'			=> 'id="'. $args_id. '"',
			) );
			
			if( !$product ) die( '-2' );
			
			$user = session( 'user_info' );
			$prefix = $user['site_id']. '_';
			
			switch( $sub ){
				case( 'plans' ):
					$owned = database( 'num_rows', DB_NAME, array(
						'table_name'			=> $prefix. 'plans',
						'conditions'			=> 'title="'. $product['title']. '" AND expired > "'. date('Y-m-d') . '"',
					) );
					
					// if( $owned ) die( '-3' );
					
					$_SESSION['cart']['plans'] = $product;
					break;
					
				case( 'modules' ):
				case( 'templates' ):
					$owned = database( 'num_rows', DB_NAME, array(
						'table_name'			=> $prefix. $sub,
						'conditions'			=> 'title="'. $product['title']. '"',
					) );
					
					if( $owned ) die( '-3' );
					
					if( isset( $_SESSION['cart'][$sub][$product['id']] ) ) die( '-4' );
					
					$_SESSION['cart'][$sub][$product['id']] = $product;
					break;
					
				default:
					die( '0' );
			}
			
			die( '1' );
			
			break;
		
		case( 'remove' ):
			$args = array(
				'args_type'			=> $_POST['type'],
				'args_id'			=> $_POST['id'],
			);
			
			if( !isset( $_SESSION ) ) session_start();
			
			switch( $args['args_type'] ){
				case( 'plans' ):
					$_SESSION['cart'][$args['args_type']] = NULL;
					break;
				case( 'modules' ):
				case( 'templates' ):
					if( isset( $_SESSION['cart'][$args['args_type']][$args['args_id']] ) ){
						unset( $_SESSION['cart'][$args['args_type']][$args['args_id']] );
					}else{
						die( '-1' );
					}
					break;
			}
			
			$cart_price = 0;
			if( !empty( $_SESSION['cart']['plans'] ) || !empty( $_SESSION['cart']['modules'] ) || !empty( $_SESSION['cart']['templates'] ) ){
				if( !empty( $_SESSION['cart']['plans'] ) )
					$cart_price += $_SESSION['cart']['plans']['price'] * ( 100 - $_SESSION['cart']['plans']['off'] ) / 1000;
				
				if( !empty( $_SESSION['cart']['modules'] ) ){
					$keys = array_keys( $_SESSION['cart']['modules'] );
					$c = 0;
					while( each( $keys ) ){
						$cart_price += $_SESSION['cart']['modules'][$keys[$c]]['price'] * ( 100 - $_SESSION['cart']['modules'][$keys[$c]]['off'] ) / 1000;
						$c++;
					}
				}
				
				if( !empty( $_SESSION['cart']['templates'] ) ){
					$keys = array_keys( $_SESSION['cart']['templates'] );
					$c = 0;
					while( each( $keys ) ){
						$cart_price += $_SESSION['cart']['templates'][$keys[$c]]['price'] * ( 100 - $_SESSION['cart']['templates'][$keys[$c]]['off'] ) / 1000;
						$c++;
					}
				}
				
				$final_cart_price = $cart_price;
				
				die( number_format( $final_cart_price ). ' تومان' );
			}else{
				die( 'empty' );
			}
			
			break;
	}
	