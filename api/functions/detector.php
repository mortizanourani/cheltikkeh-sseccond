<?php

	/*
	Address Detector Block
	*/
	
	/* Address Detector Block SubRoutines */
	function token_decode( $token ){
		return base64_decode( $token );
	}
	
	/* Address Detector Block Main Routine */
	function detect( $routine, $args = array() ){
		switch( strtolower( $routine ) ){
			case( 'address' ):
				if( ! strpos( strtolower( $_SERVER["HTTP_HOST"] ), "cheltikkeh" ) ){
					
					$domain = ltrim( strtolower( $_SERVER["HTTP_HOST"] ), 'www.' );
					$site = database( 'read', DB_NAME, array(
						'table_name'			=> 'sites',
						'conditions'			=> 'domain="'. $domain. '"',
					) );
					
					if( $site ){
						if( $site['expire_date'] < date( 'Y-m-d' ) ){
							// Site Expired
							header( 'location: http://cheltikkeh.com' );
							exit();
							die();
						}
						
						$address = rtrim( ltrim( $_SERVER['REQUEST_URI'], '/' ), '/' );
						if( strpos( $address, '?' ) !== false )
							$address = substr( $address, 0, strpos( $address, '?' ) );
						
						require_once( ROOT. '/users/'. $site['name']. '/'. $address. '/index.php' );
						die();
					}
					
				}elseif( strtolower( $_SERVER["HTTP_HOST"] ) === 'blog.cheltikkeh.com' ){
					
					$address = rtrim( ltrim( $_SERVER['REQUEST_URI'], '/' ), '/' );
					if( strpos( $address, '?' ) !== false )
						$address = substr( $address, 0, strpos( $address, '?' ) );
					
					$page = ROOT. '/users/blog/'. $address. '/index.php';
					
					if( file_exists( $page ) ){
						require_once( $page );
						die();
					}
					
					$output = array(
						'operation'			=> 'show',
						'page'				=> 'other',
						'sub'				=> 'notfound',
						'args'				=> NULL,
					);
					
					return $output;
					
				}elseif( strtolower( $_SERVER["HTTP_HOST"] ) === 'preview.cheltikkeh.com' ){
					
					start_session();
					
					$user = strtolower( $_SESSION['login_user'] );
					
					if( $user ){
						$address = rtrim( ltrim( $_SERVER['REQUEST_URI'], '/' ), '/' );
						if( strpos( $address, '?' ) !== false )
							$address = substr( $address, 0, strpos( $address, '?' ) );
						
						$page = ROOT. '/users/'. $user. '/'. $address. '/index.php';
						
						if( file_exists( $page ) ){
							require_once( $page );
							die();
						}
						
						$output = array(
							'operation'			=> 'show',
							'page'				=> 'other',
							'sub'				=> 'notfound',
							'args'				=> NULL,
						);
						
						return $output;
					}else{
						$output = array(
							'operation'			=> 'show',
							'page'				=> 'other',
							'sub'				=> 'offline',
							'args'				=> NULL,
						);
						
						return $output;
					}
					
				}
				
				$default_get = array(
					'notfound'			=> NULL,
					'page'				=> NULL,
					'sub'				=> NULL,
					'token'				=> NULL,
				);
				
				$page = NULL;
				
				$output = array(
					'operation'			=> 'show',
					'page'				=> 'other',
					'sub'				=> '404',
					'args'				=> NULL,
				);
				
				if( isset( $_REQUEST['au'] ) || isset( $_REQUEST['rs'] ) ){
					$input = array(
						'operation'			=> 'verify',
						'args'				=> array(
							'au'				=> $_REQUEST['au'],
							'rs'				=> $_REQUEST['rs'],
						),
					);
					
					$output = array_merge( $output, $input );
					return $output;
				}
				
				if( $_GET ){
					$_GET = array_merge( $default_get, $_GET );
					
					if( isset( $_GET['notfound'] ) ) break;
					
					if( isset( $_GET['page'] ) ){
						switch( strtolower( $_GET['page'] ) ){
							/* Administrators Page */
							case( 'administrators' ):
								if( isset( $_GET['sub'] ) )
									$_GET['address'] = $_GET['sub']. '/'. $_GET['token'];
								
								unset( $_GET['page'] );
								unset( $_GET['sub'] );
								unset( $_GET['token'] );
								
								if( isset( $_GET['address'] ) ){
									$_GET['address'] = ltrim( rtrim( $_GET['address'], '/' ), '/' );
									if( strpos( $_GET['address'], '/' ) > 0 ){
										$_GET['page'] = substr( $_GET['address'], 0, strpos( $_GET['address'], '/' ) );
										$_GET['sub'] = substr( $_GET['address'], strpos( $_GET['address'], '/' ) + 1 );
									}else{
										$_GET['page'] = $_GET['address'];
									}
								}
								
								require_once( ROOT. '/administrators/index.php' );
								die();
								break;
							/* ------------------- */
							case( 'store' ):
							case( 'controlpanel'):
								$page = database( 'read', DB_NAME, array(
									'table_name'		=> 'pages',
									'conditions'		=> 'page="'. strtolower( $_GET['page'] ). '" AND sub="'. strtolower( $_GET['sub'] ). '"',
								) );
								
								if( isset( $_GET['token'] ) ){
									$decoded_token = $_GET['token'];
									if( $_GET['token'] != 'list' && $_GET['token'] != 'new' && $_GET['token'] != 'logout' )
										$decoded_token = token_decode( $_GET['token'] );
									
									$token_operation = preg_replace( '/[^a-z]+/', '', $decoded_token );
									$token_id = preg_replace( '/[^0-9]+/', '', $decoded_token );
									
									$token_args = NULL;
									
									switch( $token_operation ){
										case( 'show' ):
										case( 'edit' ):
										case( 'update' ):
										case( 'delete' ):
											$token_args = array( 'args_id'	=> $token_id, );
											break;
									}
									
									$token = array(
										'operation'			=> $token_operation,
										'args'				=> $token_args,
									);
									
									$page = array_merge( $page, $token );
								}
								break;
							
							case( 'designer' ):
								$page = database( 'read', DB_NAME, array(
									'table_name'		=> 'pages',
									'conditions'		=> 'page="'. strtolower( $_GET['page'] ). '"',
								) );
								
								if( !empty( $_GET['sub'] ) ){
									$decoded_token = token_decode( $_GET['sub'] );
									
									$token_operation = preg_replace( '/[^a-z]+/', '', $decoded_token );
									$token_id = preg_replace( '/[^0-9]+/', '', $decoded_token );
									
									$token = array(
										'operation'			=> $token_operation,
										'args'				=> array( 'args_id' => $token_id, ),
									);
									$page = array_merge( $page, $token );
								}
								break;
								
							default:
								if( isset( $_GET['sub'] ) ) break;
								$page = database( 'read', DB_NAME, array(
									'table_name'		=> 'pages',
									'conditions'		=> 'page="main" AND sub="'. strtolower( $_GET['page'] ). '"',
								) );
						}
						
						if( $page ) $output = array_merge( $output, $page );
					
					}elseif( isset( $_GET['token'] ) ){
						$output = array(
							'operation'			=> 'token',
							'page'				=> 'main',
							'sub'				=> 'token',
							'args'				=> array(
								'token'			=> $_GET['token'],
							),
						);

						switch( $_GET['token'] ){
							
							default:
						}
					}else{
						break;
					}
				}else{
					$output = array(
						'operation'			=> 'show',
						'page'				=> 'main',
						'sub'				=> 'home',
						'args'				=> NULL,
					);
				}
				
				if( isset( $_POST['submit'] ) ){
					switch( $_POST['submit'] ){
						
						case( 'forget' ):
							$input = array(
								'operation'			=> 'forget',
								'args'				=> array(
									'email'			=> $_POST['email'],
								),
							);
							break;
						
						case( 'login' ):
							$input = array(
								'operation'			=> 'login',
								'args'				=> array(
									'username'		=> strtolower( $_POST['username'] ),
									'password'		=> $_POST['password'],
								),
							);
							break;
						
						case( 'logout' ):
							$input = array(
								'operation'			=> 'logout',
							);
							break;
						
						case( 'message' ):
							$input = array(
								'operation'			=> 'message',
								'args'				=> array(
									'name'			=> $_POST['name'],
									'email'			=> $_POST['email'],
									'message'		=> $_POST['text'],
									'captcha'		=> NULL,
								),
							);
							break;
						
						case( 'signup' ):
							$input = array(
								'operation'			=> 'signup',
								'args'				=> array(
									'firstname'				=> $_POST['firstname'],
									'lastname'				=> $_POST['lastname'],
									'username'				=> strtolower( $_POST['username'] ),
									'email'					=> strtolower( $_POST['email'] ),
									'email-retype'			=> strtolower( $_POST['email-retype'] ),
									'phone'					=> $_POST['phone'],
									'password'				=> $_POST['password'],
									'password-retype'		=> $_POST['password-retype'],
									'terms'					=> $_POST['terms'],
								),
							);
							break;
						
						case( 'delete' ):
							$input = array(
								'operation'			=> 'delete',
								'args'				=> array(
									'args_id'			=> $_POST['id'],
								),
							);
							break;
						
						case( 'update' ):
							$input = array(
								'operation'			=> 'update',
								'args'				=> array(
									'args_id'			=> $_POST['id'],
								),
							);
							break;
						
						case( 'save' ):
							$input = array(
								'operation'			=> 'save',
								'args'				=> NULL,
							);
							break;
						
						case( 'publish' ):
							$input = array(
								'operation'			=> 'publish',
								'args'				=> array(
									'args_id'			=> $_POST['id'],
									'args_html'			=> $_POST['html'],
								),
							);
							break;
						
						case( 'informations' ):
							$input = array(
								'operation'			=> 'informations',
								'args'				=> array(
									'firstname'			=> $_POST['firstname'],
									'lastname'			=> $_POST['lastname'],
									'email'				=> $_POST['email'],
									'phone'				=> $_POST['phone'],
									'title'				=> $_POST['title'],
									'description'		=> $_POST['description'],
								),
							);
							break;
						
						case( 'change' ):
							if( isset( $_POST['current'] ) ){
								$input = array(
									'operation'			=> 'password',
									'args'				=> array(
										'current'				=> $_POST['current'],
										'password'				=> $_POST['password'],
										'password-retype'		=> $_POST['password-retype'],
									),
								);
							}else{
								$input = array(
									'operation'			=> 'password',
									'args'				=> array(
										'token'					=> $_GET['token'],
										'password'				=> $_POST['password'],
										'password-retype'		=> $_POST['password-retype'],
									),
								);
							}
							break;
						
						case( 'ticket' ):
							$input = array(
								'operation'			=> 'ticket',
								'args'				=> array(
									'title'				=> $_POST['title'],
									'text'				=> $_POST['text'],
								),
							);
							break;
						
						case( 'answer' ):
							$input = array(
								'operation'			=> 'answer',
								'args'				=> array(
									'ticket_num'		=> $_POST['no'],
									'title'				=> $_POST['title'],
									'text'				=> $_POST['text'],
								),
							);
							break;
						
						case( 'addto' ):
							$input = array(
								'operation'			=> 'addtocart',
								'args'				=> array(
									'args_id'			=> $_POST['id'],
								),
							);
							break;
						
						case( 'clearcart' ):
							$input = array(
								'operation'			=> 'clearcart',
								'args'				=> NULL,
							);
							break;
						
						case( 'remove' ):
							$input = array(
								'operation'			=> 'remove',
								'args'				=> array(
									'args_type'			=> $_POST['type'],
									'args_id'			=> $_POST['id'],
								),
							);
							break;
						
						case( 'pay' ):
							$input = array(
								'operation'			=> 'payment',
								'args'				=> array(
									'payment_type'		=> $_POST['type'],
								),
							);
							break;
						
						case( 'charge' ):
							$input = array(
								'operation'			=> 'charge',
								'args'				=> array(
									'amount'			=> $_POST['amount'],
								),
							);
							break;
						
						default:
							die( 'Wrong Post' );
					}
					
					$output = array_merge( $output, $input );
				}
				
				break;
				
			default:
				die( "DETECTION_ERROR" );
		}
		
		if( $output ) return $output;
		return;
	}
