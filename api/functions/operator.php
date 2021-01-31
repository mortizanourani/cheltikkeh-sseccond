<?php
	/*
	Operator Block
	*/
	
	/* Essential Functions */
	function token( $length ){
		$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
		$result = NULL;
		for( $c = 0; $c < $length; $c++ ){
			$result .= $letters[ rand(0, strlen($letters)-1) ];
		}
		
		return $result;
	}
	
	function create_file( $user, $file_dir ){
		if( substr( $file_dir, 0, 1 ) != '/' ) $file_dir = '/'. $file_dir;
		if( substr( $file_dir, strlen( $file_dir ) - 1, 1 ) != '/' ) $file_dir .= '/';
		
		$dirs = explode( '/', $file_dir );
		
		$dirs[0] = $user['username'];
		
		for( $c = 1; $c < sizeof( $dirs ); $c++ ){
			$dir = ROOT. '/users/';
			for( $i = 0; $i < $c; $i++ ) $dir .= $dirs[$i]. '/';
			
			if( !is_dir( $dir ) ){
				mkdir( $dir );
				chmod( $dir, 0777 );
			}
		}
		
		$dir = ROOT. '/users/'. $user['username']. $file_dir;
		
		return $dir;
	}
	
	function delete_file( $user, $file_dir ){
		if( substr( $file_dir, 0, 1 ) != '/' ) $file_dir = '/'. $file_dir;
		if( substr( $file_dir, strlen( $file_dir ) - 1, 1 ) != '/' ) $file_dir .= '/';
		
		$dirs = explode( '/', $file_dir );
		
		$dirs[0] = $user['username'];
		
		unlink( ROOT. '/users/'. $user['username']. $file_dir. 'index.php' );
		
		for( $c = ( sizeof( $dirs ) - 1 ); $c >= 1; $c-- ){
			$dir = ROOT. '/users/';
			for( $i = 0; $i < $c; $i++ ) $dir .= $dirs[$i]. '/';
			
			if( count( scandir( $dir ) ) <= 2 ){
				rmdir( $dir );
			}
		}
	}
	
	function email( $address, $subject, $content ){
		$mail = new PHPMailer( true );
		$mail -> IsSMTP();

		try{
			$mail -> Host			= MAIL_HOST;
			$mail -> SMTPAuth		= true;                 
			$mail -> Username		= MAIL_USERNAME;
			$mail -> Password		= MAIL_PASSWORD;
			$mail -> AddReplyTo( MAIL_REPLY_TO, '' );
			$mail -> AddAddress( $address, '' );
			$mail -> SetFrom( MAIL_SET_FORM_MAIL, MAIL_SET_FORM_TITLE ); 
			$mail -> Subject 		= $subject;
			$mail -> CharSet		= MAIL_CHARSET;
			$mail -> ContentType 	= MAIL_CONTENT_TYPE;
			$mail -> MsgHTML( $content );
			$mail -> Send();
		}
		catch( phpmailerException $e ){
			echo $e -> errorMessage(); 
		} 
		catch( Exception $e ){
			echo $e -> getMessage(); 
		}
		
		return 1;
	}
	
	/* Operator Block SubRoutines */
	function visit( $page, $sub ){
		if( !isset( $_SESSION['current_visitor'] ) )
			$_SESSION['current_visitor'] = token( 20 );
		
		$user = session( 'user_info' );
		
		$columns = 'page, sub, useragent, ip, token';
		$values = '"'. $page. '", "'. $sub. '", "'. $_SERVER['HTTP_USER_AGENT']. '", "'. $_SERVER['REMOTE_ADDR']. '", "'. $_SESSION['current_visitor']. '"';
		if( isset( $user['username'] ) ){
			$columns .= ', username';
			$values .= ', "'. $user['username']. '"';
		}
		
		database( 'write', DB_NAME, array(
			'table_name'			=> 'visitors',
			'columns'				=> $columns,
			'values'				=> $values,
		) );
		
		return;
	}
	
	function show( $page, $sub, $operation_answer, $args = array() ){
		$output = NULL;
		$content = NULL;
		
		$user = session( 'user_info' );
		if( $user ) if( !$args ){ $args = $user; }else{ $args = array_merge( $args, $user ); }
		
		switch( $page ){
			case( 'main' ):
				$content = content( $page, $sub, $args );
				
				$output = $operation_answer;
				if( $content )
					$output += $content;
				
				break;
			
			case( 'store' ):
				$content = content( $page, $sub, $args );
				
				$output = $operation_answer;
				if( $content )
					$output += $content;
				
				break;
			
			case( 'controlpanel' ):
				$content = content( $page, $sub, $args );
				
				switch( $sub ){
					case( 'posts' ):
						$args['args_id'] = NULL;
						unset( $args['operation'] );
						$content['categories'] = content( $page, 'categories', $args );
						break;
					
					case( 'categories' ):
						if( isset( $args['args_id'] ) ){
							$args['category_id'] = $args['args_id'];
							$content['posts'] = content( $page, 'posts', $args );
						}
						break;
				}
				
				$output = $operation_answer;
				if( $content )
					$output += $content;
				
				break;
			
			case( 'designer' ):
				if( isset( $args['args_id'] ) ){
					$content = content( $page, 'designs', $args );
					if( isset( $args['operation'] ) && $args['operation'] === 'edit' ){
						unset ( $args['args_id'] );
						$content['photos'] = content( $page, 'photos', $args );
						$content['modules'] = content( $page, 'modules', $args );
						$content['templates'] = content( $page, 'templates', $args );
					}else{
						
					}
				}else{
					$content = content( $page, 'pages', $args );
				}
				
				$output = $operation_answer;
				if( $content )
					$output += $content;
				
				break;
			
			default:
				$output = -1;
		}

		return $output;
	}
	
	function delete( $sub, $args = array() ){
		$user = session( 'user_info' );
		$prefix = $user['site_id']. '_';
		
		switch( $sub ){
			case( 'posts' ):
				$post = database( 'read', DB_NAME, array(
					'table_name'			=> $prefix. $sub,
					'conditions'			=> 'id="'. $args['args_id']. '"',
				) );
				
				$category = database( 'read', DB_NAME, array(
					'table_name'			=> $prefix. 'categories',
					'conditions'			=> 'id="'. $post['category']. '"',
				) );
				
				database( 'update', DB_NAME, array(
					'table_name'			=> $prefix. 'categories',
					'update_values'			=> 'category_count="'. ( $category['category_count'] - 1 ). '"',
					'conditions'			=> 'id="'. $category['id']. '"',
				) );
				
				break;
				
			case( 'photos' ):
				$file = database( 'read', DB_NAME, array(
					'table_name'			=> $prefix. $sub,
					'conditions'			=> 'id="'. $args['args_id']. '"',
				) );
				define( 'IMAGE_DIR', ROOT. '/users/'. $user['username']. '/includes/images/' );
				if( file_exists( IMAGE_DIR. $file['image'] ) ) unlink( IMAGE_DIR. $file['image'] );
				
				break;
				
			case( 'pages' ):
				$page = database( 'read', DB_NAME, array(
					'table_name'			=> $prefix. 'pages',
					'conditions'			=> 'id="'. $args['args_id']. '"',
				) );
				
				delete_file( $user, $page['link'] );
				
				database( 'delete', DB_NAME, array(
					'table_name'			=> $prefix. 'designs',
					'conditions'			=> 'id="'. $args['args_id']. '"',
				) );
				break;
			
			case( 'categories' ):
				$category = database( 'read', DB_NAME, array(
					'table_name'			=> $prefix. 'categories',
					'conditions'			=> 'id="'. $args['args_id']. '"',
				) );
				
				$uncategorized = database( 'read', DB_NAME, array(
					'table_name'			=> $prefix. 'categories',
					'conditions'			=> 'id="1"',
				) );
				
				database( 'update', DB_NAME, array(
					'table_name'			=> $prefix. 'categories',
					'update_values'			=> 'category_count="'. ( $uncategorized['category_count'] + $category['category_count'] ) . '"',
					'conditions'			=> 'id="1"',
				) );
				
				database( 'update', DB_NAME, array(
					'table_name'			=> $prefix. 'posts',
					'update_values'			=> 'category="1"',
					'conditions'			=> 'category="'. $category['id']. '"',
				) );
				
				break;
			
			case( 'messages' ):
					
				break;
				
			default:
				return array( 'operation_answer'	=> -1, );
		}
		
		database( 'delete', DB_NAME, array(
			'table_name'			=> $prefix. $sub,
			'conditions'			=> 'id="'. $args['args_id']. '"',
		) );
		
		return array( 'operation_answer'	=> 1, );
		
	}
	
	function save( $page, $sub, $args = array() ){
		$user = session( 'user_info' );
		$prefix = $user['site_id']. '_';
		
		$columns = NULL;
		$values = NULL;
		
		switch( $page ){
			case( 'controlpanel' ):
				switch( $sub ){
					case( 'posts' ):
						if( isset( $_POST['commentable'] ) ){
							$columns .= 'commentable, ';
							$values .= '"true", ';
						}else{
							$columns .= 'commentable, ';
							$values .= '"false", ';
						}
						
					case( 'pages' ):
						if( isset( $_POST['status'] ) ){
							$columns .= 'status, ';
							$values .= '"visible", ';
						}else{
							$columns .= 'status, ';
							$values .= '"invisible", ';
						}
						
					case( 'photos' ):
					case( 'categories' ):
						
						// Posts and Photos Common Inputs
						if( isset( $_POST['title'] ) ){
							$columns .= 'title, ';
							$values .= '"'. $_POST['title']. '", ';
						}
						
						if( isset( $_POST['image'] ) ){
							$columns .= 'image, ';
							$values .= '"'. $_POST['image']. '", ';
						}
						
						if( isset( $_FILES['image'] ) ){
							$file_name = $_FILES['image']['name'];
							$file_size = $_FILES['image']['size'];
							$file_tmp = $_FILES['image']['tmp_name'];
							$file_type = $_FILES['image']['type'];
							$file_ext_tmp = explode( '.', $_FILES['image']['name'] );
							$file_ext = strtolower( end( $file_ext_tmp ) );
							
							$valid_ext= array( "jpeg", "jpg", "png", "gif" );
							
							if( in_array( $file_ext, $valid_ext ) === false )
								return array( 'operation_answer'	=> -2, );
							
							if( $file_size > 2097152 )
								return array( 'operation_answer'	=> -3, );
							define( 'IMAGE_DIR', ROOT. "/users/". $user['username']. "/includes/images/" );
							
							if( !file_exists( IMAGE_DIR. $file_name ) ){
								move_uploaded_file( $file_tmp, IMAGE_DIR. $file_name );
								chmod( IMAGE_DIR. $file_name, 0777 );
							}else{
								return array( 'operation_answer'	=> -4, );
							}
							
							$columns .= 'image, ';
							$values .= '"'. $_FILES['image']['name']. '", ';
						}
						
						// Posts Inputs
						if( isset( $_POST['content'] ) ){
							$columns .= 'content, ';
							$values .= '"'. base64_encode( $_POST['content'] ). '", ';
						}
						
						if( isset( $_POST['category'] ) ){
							$columns .= 'category, ';
							$values .= '"'. $_POST['category']. '", ';
						}
						
						// Photos Inputs
						if( isset( $_POST['caption'] ) ){
							$columns .= 'caption, ';
							$values .= '"'. $_POST['caption']. '", ';
						}
						
						if( isset( $_POST['description'] ) ){
							$columns .= 'description, ';
							$values .= '"'. $_POST['description']. '", ';
						}
						
						// Pages Inputs
						if( isset( $_POST['name'] ) ){
							$columns .= 'name, ';
							$values .= '"'. $_POST['name']. '", ';
						}
						
						if( isset( $_POST['link'] ) ){
							$columns .= 'link, ';
							$values .= '"'. $_POST['link']. '", ';
						}
						
						$columns = rtrim( $columns, ', ' );
						$values = rtrim( $values, ', ' );
						
						database( 'write', DB_NAME, array(
							'table_name'			=> $prefix. $sub,
							'columns'				=> $columns,
							'values'				=> $values,
						) );
						
						
						
						if( isset( $_POST['category'] ) ){
							$category = database( 'read', DB_NAME, array(
								'table_name'			=> $prefix. 'categories',
								'conditions'			=> 'id="'. $_POST['category']. '"',
							) );
							
							database( 'update', DB_NAME, array(
								'table_name'			=> $prefix. 'categories',
								'update_values'			=> 'category_count="'. ( $category['category_count'] + 1 ). '"',
								'conditions'			=> 'id="'. $_POST['category']. '"',
							) );
						}
						
						return array( 'operation_answer'	=> 1, );
						break;
						
					default:
						return array( 'operation_answer'	=> -1, );
				}
				break;
			
			case( 'designer' ):
				database( 'delete', DB_NAME, array(
					'table_name'			=> $prefix. 'designs',
					'conditions'			=> 'id="'. $_POST['id']. '"',
				) );
				
				$columns = 'id, html';
				$values = '"'. $_POST['id']. '", "'. $_POST['html']. '"';
				database( 'write', DB_NAME, array(
					'table_name'			=> $prefix. 'designs',
					'columns'				=> $columns,
					'values'				=> $values,
				) );
				
				return array( 'operation_answer'	=> 1, );
				break;
			
			default:
				return array( 'operation_answer'	=> -1, );
		}
	}
	
	function update( $sub, $args = array() ){
		$user = session( 'user_info' );
		$prefix = $user['site_id']. '_';
		
		$update_values = NULL;
		
		switch( $sub ){
			case( 'posts' ):
				if( $_POST['category'] != $_POST['current_category'] ){
					$current_category = database( 'read', DB_NAME, array(
						'table_name'			=> $prefix. 'categories',
						'conditions'			=> 'id="'. $_POST['current_category']. '"',
					) );
					
					$category = database( 'read', DB_NAME, array(
						'table_name'			=> $prefix. 'categories',
						'conditions'			=> 'id="'. $_POST['category']. '"',
					) );
					
					database( 'update', DB_NAME, array(
						'table_name'			=> $prefix. 'categories',
						'update_values'			=> 'category_count="'. ( $current_category['category_count'] - 1 ) . '"',
						'conditions'			=> 'id="'. $_POST['current_category']. '"',
					) );
					
					database( 'update', DB_NAME, array(
						'table_name'			=> $prefix. 'categories',
						'update_values'			=> 'category_count="'. ( $category['category_count'] + 1 ) . '"',
						'conditions'			=> 'id="'. $_POST['category']. '"',
					) );
				}
				
				if( isset( $_POST['commentable'] ) ){
					$update_values .= 'commentable="true", ';
				}else{
					$update_values .= 'commentable="false", ';
				}
			
			case( 'pages' ):
				if( isset( $_POST['status'] ) ){
					$update_values .= 'status="visible", ';
				}else{
					$update_values .= 'status="invisible", ';
				}
				
			case( 'photos' ):
			case( 'categories' ):
				// Posts and Photos Common Inputs
				if( isset( $_POST['title'] ) )
					$update_values .= 'title="'. $_POST['title']. '", ';
				
				if( isset( $_POST['image'] ) )
					$update_values .= 'image="'. $_POST['image']. '", ';
				
				// Posts Inputs
				if( isset( $_POST['content'] ) )
					$update_values .= 'content="'. base64_encode( $_POST['content'] ). '", ';
				
				if( isset( $_POST['category'] ) )
					$update_values .= 'category="'. $_POST['category']. '", ';
				
				// Photos Inputs
				if( isset( $_POST['caption'] ) )
					$update_values .= 'caption="'. $_POST['caption']. '", ';
				
				if( isset( $_POST['description'] ) )
					$update_values .= 'description="'. $_POST['description']. '", ';
				
				// Pages Inputs
				if( isset( $_POST['name'] ) )
					$update_values .= 'name="'. $_POST['name']. '", ';
				
				if( isset( $_POST['link'] ) )
					$update_values .= 'link="'. $_POST['link']. '", ';
				
				/* Change Page Address */
				/* ------------------- */
				
				if( $sub === 'pages' ){
					$page = database( 'read', DB_NAME, array(
						'table_name'			=> $prefix. 'pages',
						'conditions'			=> 'id="'. $args['args_id']. '"',
					) );
					
					$current_link = $page['link'];
					if( substr( $current_link, 0, 1 ) != '/' ) $current_link = '/'. $current_link;
					if( substr( $current_link, strlen( $current_link ) - 1, 1 ) != '/' ) $current_link .= '/';
					
					$link = $_POST['link'];
					if( substr( $link, 0, 1 ) != '/' ) $link = '/'. $link;
					if( substr( $link, strlen( $link ) - 1, 1 ) != '/' ) $link .= '/';
					
					$current_dir = ROOT. '/users/'. $user['username']. $current_link;
					if( is_dir( $current_dir ) && ( $current_link != $link ) ){
						$dir = create_file( $user, $_POST['link'] );
						
						copy( $current_dir. 'index.php', $dir. 'index.php' );
						
						delete_file( $user, $current_link );
					}
				}
				/* ------------------- */
				
				$update_values = rtrim( $update_values, ', ' );
				
				database( 'update', DB_NAME, array(
					'table_name'			=> $prefix. $sub,
					'update_values'			=> $update_values,
					'conditions'			=> 'id="'. $args['args_id']. '"',
				) );
				
				return array( 'operation_answer'	=> 1, );
				break;
				
			default:
				return array( 'operation_answer'	=> -1, );
		}
	}
	
	function create_tables(){
		$queries = database( 'read', DB_NAME, array(
			'table_name'			=> 'queries',
			'single'				=> false,
		) );
		
		$user = session( 'user_info' );
		$prefix = $user['site_id']. '_';
		
		for( $c = 1; $c <= $queries['nums']; $c++ ){
			database( 'create_table', DB_NAME, array(
				'table_name'			=> $prefix. $queries[$c]['table_name'],
				'rows_definitions'		=> $queries[$c]['table_query'],
			) );
			
			if( !empty( $queries[$c]['columns'] ) ){
				database( 'write', DB_NAME, array(
					'default_value'			=> true,
					'table_name'			=> $prefix. $queries[$c]['table_name'],
					'columns'				=> $queries[$c]['columns'],
					'values'				=> $queries[$c]['values'],
				) );
			}
		}
		
		$exists = database( 'num_rows', DB_NAME, array(
			'table_name'			=> $prefix. 'informations',
			'conditions'			=> '1',
		) );
		if( $exists <= 0 ){
			$columns = 'user, firstname, lastname, email, phone, site';
			$values = '"'. $user['id']. '", "'. $user['firstname']. '", "'. $user['lastname']. '", "'. $user['email']. '", "'. $user['phone']. '", "'. $user['site_id']. '"';
			
			database( 'write', DB_NAME, array(
				'table_name'			=> $prefix. 'informations',
				'columns'				=> $columns,
				'values'				=> $values,
			) );
		}
		
		return;
	}
	
	function create_folders(){
		$template_root = ROOT. '/users/template/';
		
		$user = session( 'user_info' );
		$user_root = ROOT. '/users/'. $user['username']. '/';
		if( !is_dir( $user_root ) ){
			mkdir( $user_root );
			chmod( $user_root, 0777 );
		}
		
		/* Read Template Files List */
		/* ------------------------ */
		$dir = array();
		$c = 0;
		$tmp[0] = $template_root;
		while( isset( $tmp[$c] ) && is_dir( $tmp[$c] ) ){
			$result = scandir( $tmp[$c], 1 );
			unset( $result[count( $result ) - 1] );
			unset( $result[count( $result ) - 1] );
			if( empty( $result ) ) $dir[count( $dir )] = $tmp[$c];
			for( $n = 0; $n < count( $result ); $n++ ){
				$dir[count( $dir )] = ( $tmp[$c]. $result[$n] );
				if( is_dir( $dir[count( $dir ) - 1] ) ) $dir[count( $dir ) - 1] .= '/';
			}
			
			$c++;
			if( !isset( $tmp[$c] ) ){
				if( $dir != $tmp ){
					$tmp = $dir;
					$dir = array();
					$c = 0;
					while( isset( $tmp[$c] ) && !is_dir( $tmp[$c] ) ){
						$dir[count( $dir )] = $tmp[$c];
						$c++;
					}
				}else{
					break;
				}
			}else{
				while( isset( $tmp[$c] ) && !is_dir( $tmp[$c] ) ){
					$dir[count( $dir )] = $tmp[$c];
					$c++;
				}
			}
		}
		
		/* Copy Template Files To User Root Directory */
		/* ------------------------------------------ */
		$template_files = $dir;
		for( $c = 0; $c < count( $template_files ); $c++ ){
			$user_files[$c] = str_replace( 'template', $user['username'], $template_files[$c] );
			if( is_file( $template_files[$c] ) ){
				if( !file_exists( $user_files[$c] ) ){
					$dirs = explode( '/', substr( $user_files[$c], strpos( $user_files[$c], 'users/' ) ) );
					unset( $dirs[count( $dirs ) - 1] );
					$dir = substr( $user_files[$c], 0, strpos( $user_files[$c], $dirs[1] ) ). $dirs[1];
					for( $n = 2; $n < count( $dirs ); $n++ ){
						$dir .= '/'. $dirs[$n];
						if( !is_dir( $dir ) ){
							mkdir( $dir );
							chmod( $dir, 0777 );
						}
					}
					copy( $template_files[$c], $user_files[$c] );
				}
			}else{
				if( !is_dir( $user_files[$c] ) ){
					$dirs = explode( '/', substr( $user_files[$c], strpos( $user_files[$c], 'users/' ) ) );
					unset( $dirs[count( $dirs ) - 1] );
					$dir = substr( $user_files[$c], 0, strpos( $user_files[$c], $dirs[1] ) ). $dirs[1];
					for( $n = 2; $n < count( $dirs ); $n++ ){
						$dir .= '/'. $dirs[$n];
						if( !is_dir( $dir ) ){
							mkdir( $dir );
							chmod( $dir, 0777 );
						}
					}
				}
			}
		}
		
		return;
	}
	
	function signup( $args = array() ){
		$columns = 'name, expire_date';
		$values = '"'. $args['username']. '", "'. date( 'Y-m-d H:i:s', strtotime( "+14days", strtotime ( date( 'Y-m-d H:i:s' ) ) ) ). '"';
		database( 'write', DB_NAME, array(
			'table_name'			=> 'sites',
			'columns'				=> $columns,
			'values'				=> $values,
		) );
		
		$site = database( 'read', DB_NAME, array(
			'table_name'			=> 'sites',
			'columns'				=> 'id',
			'conditions'			=> 'name="'. $args['username']. '"',
		) );
		
		$columns = 'firstname, lastname, email, phone, username, password, site_id';
		$values = '"'. $args['firstname']. '", "'. $args['lastname']. '", "'. $args['email']. '", "'. $args['phone']. '", "'. $args['username']. '", "'. md5( 'chel'. $args['password']. 'tikkeh' ). '", "'. $site['id']. '"';
		database( 'write', DB_NAME, array(
			'table_name'			=> 'users',
			'columns'				=> $columns,
			'values'				=> $values,
		) );
		
		return 1;
	}
	
	function signup_errors( $args = array () ){
		if( empty( $args['firstname'] ) ) return -1;
		
		if( empty( $args['lastname'] ) ) return -2;
		
		if( empty( $args['username'] ) ) return -3;
		
		$conditions = 'username="'. $args['username']. '"';
		$exists = database( 'num_rows', DB_NAME, array(
			'table_name'			=> 'users',
			'conditions'			=> $conditions,
		) );
		if( $exists ) return -3;
		
		if( empty( $args['password'] ) ) return -4;
		
		if( empty( $args['password-retype'] ) ) return -5;
		
		if( $args['password-retype'] != $args['password'] ) return -5;
		
		if( empty( $args['email'] ) ) return -6;
		
		if( empty( $args['email-retype'] ) ) return -7;
		
		if( $args['email-retype'] != $args['email'] ) return -7;
		
		if( empty( $args['phone'] ) ) return -8;
		
		if( $args['terms'] != 'on' ) return -9;
		
		return 1;
	}
	
	function addtocart( $sub, $args_id ){
		start_session();
		
		if( !isset( $_SESSION['cart'] ) ) return -1;
		
		$product = database( 'read', DB_NAME, array(
			'table_name'			=> $sub,
			'conditions'			=> 'id="'. $args_id. '"',
		) );
		
		if( !$product ) return -2;
		
		$user = session( 'user_info' );
		$prefix = $user['site_id']. '_';
		
		switch( $sub ){
			case( 'plans' ):
				$owned = database( 'num_rows', DB_NAME, array(
					'table_name'			=> $prefix. 'plans',
					'conditions'			=> 'title="'. $product['title']. '" AND expired > "'. date('Y-m-d') . '"',
				) );
				
				if( $owned ) return -3;
				
				$_SESSION['cart']['plans'] = $product;
				break;
				
			case( 'modules' ):
			case( 'templates' ):
				$owned = database( 'num_rows', DB_NAME, array(
					'table_name'			=> $prefix. $sub,
					'conditions'			=> 'title="'. $product['title']. '"',
				) );
				
				if( $owned ) return -3;
				
				if( isset( $_SESSION['cart'][$sub][$product['id']] ) ) return -4;
				
				$_SESSION['cart'][$sub][$product['id']] = $product;
				break;
				
			default:
				return 0;
		}
		
		return 1;
	}
	
	function ownupcart( $args = array() ){
		start_session();
		
		$user = session( 'user_info' );
		$prefix = $user['site_id']. '_';
		
		/* Read Current Credit */
		/* ------------------- */
		$credit = database( 'read', DB_NAME, array(
			'table_name'			=> $prefix. 'transactions',
			'columns'				=> 'credit',
			'order'					=> 'date DESC LIMIT 1',
		) );
		$credit = $credit['credit'];
		
		if( $_SESSION['cart']['plans'] ){
			$title = $_SESSION['cart']['plans']['title'];
			$host = $_SESSION['cart']['plans']['host'];
			$bandwidth = $_SESSION['cart']['plans']['bandwidth'];
			$gift_credit = $_SESSION['cart']['plans']['credit'];
			$price = $_SESSION['cart']['plans']['price'] * ( 1 - ( $_SESSION['cart']['plans']['off'] / 100 ) );
			
			$plan_period = '+'. substr( $title, 1, 2 ). ' months +1 day';
			
			$current_plan = database( 'read', DB_NAME, array(
				'table_name'			=> $prefix. 'plans',
				'order'					=> 'id DESC LIMIT 1',
			) );
			
			$expired = date( 'Y-m-d 00:00:00', strtotime( $plan_period, strtotime( date( 'Y-m-d H:i:s' ) ) ) );
			if( $current_plan )
				$expired = date( 'Y-m-d 00:00:00', strtotime( $plan_period, strtotime( $current_plan['expired'] ) ) );
			
			$credit -= $price;
			$columns = 'transfer, credit, description';
			$values = '"-'. $price. '", "'. $credit. '", "خریداری طرح"';
			database( 'write', DB_NAME, array(
				'table_name'			=> $prefix. 'transactions',
				'columns'				=> $columns,
				'values'				=> $values,
			) );
			
			$columns = 'title, host, bandwidth, expired';
			$values = '"'. $title. '", "'. $host. '", "'. $bandwidth. '", "'. $expired. '"';
			database( 'write', DB_NAME, array(
				'table_name'			=> $prefix. 'plans',
				'columns'				=> $columns,
				'values'				=> $values,
			) );
			
			if( $gift_credit > 0 ){
				$credit += $gift_credit;
				$columns = 'transfer, credit, description';
				$values = '"+'. $gift_credit. '", "'. $credit. '", "اعتبار هدیه ی طرح خریداری شده"';
				database( 'write', DB_NAME, array(
					'table_name'			=> $prefix. 'transactions',
					'columns'				=> $columns,
					'values'				=> $values,
				) );
			}
			
			$new_plan = database( 'read', DB_NAME, array(
				'table_name'			=> $prefix. 'plans',
				'order'					=> 'id DESC LIMIT 1',
			) );
			
			$update_values = 'upgrade_date="'. date( 'Y-m-d', strtotime( $new_plan['bought'] ) ). '", ';
			$update_values .= 'expire_date="'. date( 'Y-m-d', strtotime( $new_plan['expired'] ) ). '"';
			database( 'update', DB_NAME, array(
				'table_name'			=> 'sites',
				'update_values'			=> $update_values,
				'conditions'			=> 'name="'. $user['username']. '"',
			) );
			
			/* Send ticket to apply changes */
			
			$user = session( 'user_info' );
			$last = database( 'read', DB_NAME, array(
				'table_name'			=> 'tickets',
				'order'					=> 'ticket_num DESC LIMIT 1',
			) );
			
			if( $last ){
				$args['ticket_num'] = $last['ticket_num'] + 1;
			}else{
				$args['ticket_num'] = 1;
			}
			
			$columns = 'ticket_num, firstname, lastname, username, email, phone, title, text';
			$values = '"'. $args['ticket_num']. '", "'. $user['firstname']. '", "'. $user['lastname']. '", "'. $user['username']. '", "'. $user['email']. '", "'. $user['phone'];
			$values .= '", "درخواست فعال سازی طرح '. $new_plan['title']. '", "طرح ذکر شده خریداری شده است. لطفا نسبت به فعال سازی آن اقدام گردد."';
			database( 'write', DB_NAME, array(
				'table_name'			=> 'tickets',
				'columns'				=> $columns,
				'values'				=> $values,
			) );
			
			$_SESSION['cart']['plans'] = NULL;
		}
		
		if( $_SESSION['cart']['modules'] ){
			$keys = array_keys( $_SESSION['cart']['modules'] );
			
			$c = 0;
			while( each( $_SESSION['cart']['modules'] ) ){
				$type = $_SESSION['cart']['modules'][$keys[$c]]['type'];
				$title = $_SESSION['cart']['modules'][$keys[$c]]['title'];
				$image = $_SESSION['cart']['modules'][$keys[$c]]['image'];
				$price = $_SESSION['cart']['modules'][$keys[$c]]['price'] * ( 1 - ( $_SESSION['cart']['modules'][$keys[$c]]['off'] / 100 ) );
				
				$credit -= $price;
				$columns = 'transfer, credit, description';
				$values = '"-'. $price. '", "'. $credit. '", "خریداری المان"';
				database( 'write', DB_NAME, array(
					'table_name'			=> $prefix. 'transactions',
					'columns'				=> $columns,
					'values'				=> $values,
				) );
				
				$columns = 'type, title, image';
				$values = '"'. $type. '", "'. $title. '", "'. $image. '"';
				database( 'write', DB_NAME, array(
					'table_name'			=> $prefix. 'modules',
					'columns'				=> $columns,
					'values'				=> $values,
				) );
				
				$_SESSION['cart']['modules'][$keys[$c]] = NULL;
				
				$c++;
			}
			
			$_SESSION['cart']['modules'] = NULL;
		}
		
		if( $_SESSION['cart']['templates'] ){
			$keys = array_keys( $_SESSION['cart']['templates'] );
			
			$c = 0;
			while( each( $_SESSION['cart']['templates'] ) ){
				$title = $_SESSION['cart']['templates'][$keys[$c]]['title'];
				$image = $_SESSION['cart']['templates'][$keys[$c]]['image'];
				$price = $_SESSION['cart']['templates'][$keys[$c]]['price'] * ( 1 - ( $_SESSION['cart']['templates'][$keys[$c]]['off'] / 100 ) );
				
				$credit -= $price;
				$columns = 'transfer, credit, description';
				$values = '"-'. $price. '", "'. $credit. '", "خریداری قالب آماده"';
				database( 'write', DB_NAME, array(
					'table_name'			=> $prefix. 'transactions',
					'columns'				=> $columns,
					'values'				=> $values,
				) );
				
				$columns = 'title, image';
				$values = '"'. $title. '", "'. $image. '"';
				database( 'write', DB_NAME, array(
					'table_name'			=> $prefix. 'templates',
					'columns'				=> $columns,
					'values'				=> $values,
				) );
				
				$_SESSION['cart']['templates'][$keys[$c]] = NULL;
				
				$c++;
			}
			
			$_SESSION['cart']['templates'] = NULL;
		}
		
		return 1;
	}
	
	function verify( $args = array() ){
		$pin = BANK_ID;
		$url = BANK_VERIFY_URL;
		$callback = BANK_CALLBACK_URL;
		
		$authority = $args['au'];
		$status = $args['rs'];
		
		$factor = database( 'read', DB_NAME, array(
			'table_name'			=> 'factors',
			'conditions'			=> 'number="'. $authority. '"',
		) );
		if( $factor ){
			$amount = $factor['amount'];
			$exists = true;
		}else{
			$exists = false;
		}
		
		if( $authority ){
			if ( ( $status === '0' ) && ( $exists ) ){
				$soapclient = new nusoap_client( $url, 'wsdl' );
			
				if( ( !$soapclient ) || ( $err = $soapclient -> getError() ) ){
					
					return 0;
					
				}else{
					$status = 1;
					$params = array(
						'pin'				=> $pin,
						'authority' 		=> $authority,
						'status'			=> $status,
					);
					
					$sendParams = array( $params );
					$result = $soapclient -> call( 'PinPaymentEnquiry', $sendParams );
					$status = $result['status'];
					
					if( $status === '0' ){
						
						start_session();
						
						$user = session( 'user_info' );
						$prefix = $user['site_id']. '_';
						
						$columns = 'source, type, number, amount, username';
						$values = '"'. $factor['source']. '", "paid", "'. $authority. '", "'. $amount. '", "'. $user['username']. '"';
						database( 'write', DB_NAME, array(
							'table_name'			=> 'factors',
							'columns'				=> $columns,
							'values'				=> $values,
						) );
						
						$credit = database( 'read', DB_NAME, array(
							'table_name'			=> $prefix. 'transactions',
							'order'					=> 'date DESC LIMIT 1',
						) );
						$credit = $credit['credit'];
						
						$credit += $amount;
						$columns = 'transfer, credit, description';
						$values = '"+'. $amount. '", "'. $credit. '", "افزایش اعتبار"';
						database( 'write', DB_NAME, array(
							'table_name'			=> $prefix. 'transactions',
							'columns'				=> $columns,
							'values'				=> $values,
						) );
						
						switch( $factor['source'] ){
							case( 'cart' ):
								ownupcart();
								
								header( 'location: /cart/' );
								break;
							
							case( 'credit' ):
								header( 'location: /controlpanel/transactions/' );
								break;
						}
						die();
						
						return 1;
						
					}else{
						switch( $status ){
							default:
								return -1;			// UnSuccessful Payment
						}
					}
				}
			}else{
				return -1;			// UnSuccessful Payment
			}
		}
		
		return -2;				// Wrong Factor Number
	}
	
	function bank( $source, $amount ){
		$pin = BANK_ID;
		$url = BANK_SEND_URL;
		$callbackurl = BANK_CALLBACK_URL;
		
		$orderid = (int) (float) date("ymdHis");
		
		/* Save Prefactor To Proof Payments */
		/* -------------------------------- */
		start_session();
		
		$user = session( 'user_info' );
		
		/* Send Data To Bank To Get Gate Address */
		/* ------------------------------------- */
		
		$soapclient = new nusoap_client( $url, 'wsdl' );
		if( !$err = $soapclient -> getError() )
			$soapProxy = $soapclient -> getProxy();
		
		if( ( !$soapclient ) || ( $err = $soapclient -> getError() ) ){
			
			return 0;
			
		}else{
			$authority = 0;
			$status = 1;
			
			$params = array(
				'pin'				=> $pin,
				'amount'			=> $amount,
				'orderId'			=> $orderid,
				'callbackUrl'		=> $callbackurl,
				'authority'			=> $authority,
				'status'			=> $status,
			);
			
			$sendParams = array( $params );
			
			$result = $soapclient -> call( 'PinPaymentRequest', $sendParams );
			
			$authority = $result['authority'];
			$status = $result['status'];
			
			if( ( $authority ) && ( $status === '0' ) ){
				
				$columns = 'source, type, number, amount, username';
				$values = '"'. $source. '", "draft", "'. $authority. '", "'. $amount. '", "'. $user['username']. '"';
				database( 'write', DB_NAME, array(
					'table_name'			=> 'factors',
					'columns'				=> $columns,
					'values'				=> $values,
				) );
				
				$gateurl = BANK_GATE_URL;
				$parsURL = $gateurl. $authority;
				
				header( 'location: '. $parsURL );
				
				exit();
				die();
				
			}else{
				
				switch( $status ){
					case( '20' ):
					case( '22' ):
						return -1;			// Wrong Pin
						break;
					
					case( '30' ):
						return -2;			// Already Done
						break;
					
					case( '13' ):
						return -3;			// Wrong Amount
						break;
				}
			}
		}
		
		return;
	}
	
	function payment( $args ){
		start_session();
		
		if( !isset( $_SESSION['cart'] ) ) return -1;
		
		$user = session( 'user_info' );
		$prefix = $user['site_id']. '_';
		
		/* Read Current Credit */
		/* ------------------- */
		$credit = database( 'read', DB_NAME, array(
			'table_name'			=> $prefix. 'transactions',
			'columns'				=> 'credit',
			'order'					=> 'date DESC LIMIT 1',
		) );
		$credit = $credit['credit'];
		
		/* Read Cart Last Price */
		/* -------------------- */
		$price = 0;
		if( !empty( $_SESSION['cart']['plans'] ) )
			$price += $_SESSION['cart']['plans']['price'] * ( 1 - ( $_SESSION['cart']['plans']['off'] / 100 ) );
		
		if( !empty( $_SESSION['cart']['modules'] ) ){
			$keys = array_keys( $_SESSION['cart']['modules'] );
			$c = 0;
			while( each( $keys ) ){
				$price += $_SESSION['cart']['modules'][$keys[$c]]['price'] * ( 1 - ( $_SESSION['cart']['modules'][$keys[$c]]['off'] / 100 ) );
				$c++;
			}
		}
		
		if( !empty( $_SESSION['cart']['templates'] ) ){
			$keys = array_keys( $_SESSION['cart']['templates'] );
			$c = 0;
			while( each( $keys ) ){
				$price += $_SESSION['cart']['templates'][$keys[$c]]['price'] * ( 1 - ( $_SESSION['cart']['templates'][$keys[$c]]['off'] / 100 ) );
				$c++;
			}
		}
		
		/* Continue Payment Cycle */
		/* ---------------------- */
		switch( $args['payment_type'] ){
			case( 'cash' ):
				if( $price > 0 ){
					$result = bank( 'cart', $price );
				}else{
					ownupcart();
				}
				break;
			
			case( 'credit' ):
				if( $price > $credit ) return -2;			// Not Enough Credit
				ownupcart();
				break;
			
			default:
				return 0;
		}
		
		return 1;
	}
	
	function publish( $page, $sub, $args = array() ){
		start_session();
		
		$user = session( 'user_info' );
		$prefix = $user['site_id']. '_';
		
		/* Create Page Directory To Create Page index.php File */
		/* --------------------------------------------------- */
		
		$page = database( 'read', DB_NAME, array(
			'table_name'			=> $prefix. 'pages',
			'conditions'			=> 'id="'. $args['args_id']. '"',
		) );
		
		$dir = create_file( $user, $page['link'] );
		/* --------------------------------------------------- */
		
		/* Create Page Content For index.php File */
		/* -------------------------------------- */
		
		$informations_replacement = '
		<?php
		$sql = "SELECT * FROM '. $prefix. 'informations WHERE 1";
		$result = mysqli_query( $connection, $sql );
		$informations = mysqli_fetch_array( $result, MYSQL_ASSOC );
		';
		$firstname_replacement = '
		echo $informations["firstname"];
		?>
		';
		$lastname_replacement = '
		echo $informations["lastname"];
		?>
		';
		$fullname_replacement = '
		echo $informations["firstname"]. " ". $informations["lastname"];
		?>
		';
		$phone_replacement = '
		echo $informations["phone"];
		?>
		';
		$email_replacement = '
		echo $informations["email"];
		?>
		';
		$title_replacement = '
		echo $informations["title"];
		?>
		';
		$description_replacement = '
		echo str_replace( "\n", "<br>", $informations["description"] );
		?>
		';
		
		$page = str_replace( ROOT. '/users/'. $user['username'], '', $dir );
		$categories_replacement = '
		<?php
		if( isset( $_GET["cat"] ) ){
			$sql = "SELECT * FROM '. $prefix. 'posts WHERE category=". base64_decode( $_GET["cat"] );
			$result = mysqli_query( $connection, $sql );
			$nums = mysqli_num_rows( $result );
			for( $c = 1; $c <= $nums; $c++ ){
				$post[$c] = mysqli_fetch_array( $result, MYSQL_ASSOC );
			}
			for( $c = $nums; $c >= 1; $c-- ){
				echo "<b>". $post[$c]["title"]. "</b>". "<br>";
				echo substr( base64_decode( $post[$c]["content"] ), 0, 200 + strpos( substr( base64_decode( $post[$c]["content"] ), 200 ), " " ) ). "...<br>";
				echo "<a href='. $page. '?post=". base64_encode( $post[$c]["id"] ). ">متن کامل</a><br><br>";
			}
		}else{
			if( isset( $_GET["post"] ) ){
				$sql = "SELECT * FROM '. $prefix. 'posts WHERE id=". base64_decode( $_GET["post"] );
				$result = mysqli_query( $connection, $sql );
				$post = mysqli_fetch_array( $result, MYSQL_ASSOC );
				
				echo "<b>". $post["title"]. "</b><br>";
				echo str_replace( "\n", "<br>", base64_decode( $post["content"] ) );
			}else{
				$sql = "SELECT * FROM '. $prefix. 'categories WHERE 1";
				$result = mysqli_query( $connection, $sql );
				$nums = mysqli_num_rows( $result );
				$category[0] = mysqli_fetch_array( $result, MYSQL_ASSOC );
				for( $c = 1; $c < $nums; $c++ ){
					$category[$c] = mysqli_fetch_array( $result, MYSQL_ASSOC );
				}
			}
		}
		';
		$categories_id_replacement = '
		for( $c = 1; $c <= sizeof( $category ); $c++ ){
			echo "<a href=?cat=". base64_encode( $category[$c]["id"] ). ">". $category[$c]["name"]. "</a><br>";
		}
		?>
		';
		$category_replacement = '
		<?php 
		if( isset( $_GET["cat"] ) ){
			$sql = "SELECT * FROM '. $prefix. 'categories WHERE id=". base64_decode( $_GET["cat"] );
			$result = mysqli_query( $connection, $sql );
			$category = mysqli_fetch_array( $result, MYSQL_ASSOC );
		}
		';
		$category_name_replacement = '
		if( isset( $category["name"] ) ){
			echo $category["name"];
		}
		?>
		';
		
		if( strpos( base64_decode( $_POST['cleared_html'] ), "\xE2\x80\x8B\xE2\x80\x8Bمحتوای پست" ) > 0 ){
			$clear_html = base64_decode( $_POST['cleared_html'] );
			$clear_html_posts_tag_part = substr( $clear_html, strpos( $clear_html, "\xE2\x80\x8B\xE2\x80\x8Bمحتوای پست" ) );
			$clear_html_posts_tag_end_point = strpos( substr( $clear_html_posts_tag_part, 6 ), "\xE2\x80\x8B\xE2\x80\x8B" ) + 12;
			$posts_replacement_tag = substr( $clear_html_posts_tag_part, 0, $clear_html_posts_tag_end_point );
			$posts_replacement_category = substr( $posts_replacement_tag, 6, strlen( $posts_replacement_tag ) - 12 );
			if( strpos( $posts_replacement_category, 'محتوای پست های ' ) === false ){
				$posts_replacement_conditions = '1';
			}else{
				$posts_replacement_category = substr( $posts_replacement_category, strlen( 'محتوای پست های ' ) );
				$posts_replacement_category = database( 'read', DB_NAME, array(
					'table_name'			=> $prefix. 'categories',
					'conditions'			=> 'name="'. $posts_replacement_category. '"',
				) );
				
				$posts_replacement_conditions = '1';
				if( $posts_replacement_category )
					$posts_replacement_conditions = 'category='. $posts_replacement_category['id'];
			}
		}else{
			$posts_replacement_conditions = '1';
		}
		$posts_replacement = '
		<?php 
		if( isset( $_GET["post"] ) ){
			$sql = "SELECT * FROM '. $prefix. 'posts WHERE id=". base64_decode( $_GET["post"] );
			$result = mysqli_query( $connection, $sql );
			$post = mysqli_fetch_array( $result, MYSQL_ASSOC );
		}else{
			$sql = "SELECT * FROM '. $prefix. 'posts WHERE '. $posts_replacement_conditions. '";
			$result = mysqli_query( $connection, $sql );
			$nums = mysqli_num_rows( $result );
			for( $c = 1; $c <= $nums; $c++ ){
				$post[$c] = mysqli_fetch_array( $result, MYSQL_ASSOC );
			}
		}
		';
		$post_title_replacement = '
		if( isset( $post["title"] ) ){
			echo $post["title"];
		}
		?>
		';
		
		$page = str_replace( ROOT. '/users/'. $user['username'], '', $dir );
		$post_content_replacement = '
		if( isset( $post["content"] ) ){
			echo str_replace( "\n", "<br>", base64_decode( $post["content"] ) );
		}elseif( isset( $post[1] ) ){
			for( $c = $nums; $c >= 1; $c-- ){
				echo "<b>". $post[$c]["title"]. "</b>". "<br>";
				echo substr( base64_decode( $post[$c]["content"] ), 0, 200 + strpos( substr( base64_decode( $post[$c]["content"] ), 200 ), " " ) ). "...<br>";
				echo "<a href='. $page. '?post=". base64_encode( $post[$c]["id"] ). ">متن کامل</a><br><br>";
			}
		}
		?>
		';
		
		$forms_functions_replacement = '
		<?php
		if( isset( $_POST["submit"] ) ){
			$sql = "INSERT INTO '. $prefix. 'messages ( name, email, message ) VALUES ( '. "'". '". $_POST["name"]. "'. "', '". '". $_POST["email"]. "'. "', '". '". $_POST["message"]. "'. "'". ' )";
			$result = mysqli_query( $connection, $sql );
			header( "refresh: 0" );
			die();
		}
		?>
		';
		
		$images_replacement = '<?php if( strpos( strtolower( $_SERVER["HTTP_HOST"] ), "cheltikkeh" ) ){ echo "http://cheltikkeh.com/users/'. $user['username']. '/"; }else{ echo "/users/'. $user['username']. '/"; } ?>';

		
		$replacements = array(
			"\xE2\x80\x8B\xE2\x80\x8Bنام شما\xE2\x80\x8B\xE2\x80\x8B"					=> $informations_replacement. $firstname_replacement,
			"\xE2\x80\x8B\xE2\x80\x8Bنام خانوادگی شما\xE2\x80\x8B\xE2\x80\x8B"			=> $informations_replacement. $lastname_replacement,
			"\xE2\x80\x8B\xE2\x80\x8Bنام و نام خانوادگی شما\xE2\x80\x8B\xE2\x80\x8B"	=> $informations_replacement. $fullname_replacement,
			"\xE2\x80\x8B\xE2\x80\x8Bشماره تماس شما\xE2\x80\x8B\xE2\x80\x8B"			=> $informations_replacement. $phone_replacement,
			"\xE2\x80\x8B\xE2\x80\x8Bپست الکترونیک شما\xE2\x80\x8B\xE2\x80\x8B"			=> $informations_replacement. $email_replacement,
			"\xE2\x80\x8B\xE2\x80\x8Bعنوان سایت شما\xE2\x80\x8B\xE2\x80\x8B"			=> $informations_replacement. $title_replacement,
			"\xE2\x80\x8B\xE2\x80\x8Bتوضیحات سایت شما\xE2\x80\x8B\xE2\x80\x8B"			=> $informations_replacement. $description_replacement,
			
			"\xE2\x80\x8B\xE2\x80\x8Bدسته بندی ها\xE2\x80\x8B\xE2\x80\x8B"				=> $categories_replacement. $categories_id_replacement,
			"\xE2\x80\x8B\xE2\x80\x8Bنام دسته\xE2\x80\x8B\xE2\x80\x8B"					=> $category_replacement. $category_name_replacement,
			
			"\xE2\x80\x8B\xE2\x80\x8Bعنوان پست\xE2\x80\x8B\xE2\x80\x8B"					=> $posts_replacement. $post_title_replacement,
			$posts_replacement_tag														=> $posts_replacement. $post_content_replacement,
			
			"/users/". $user['username']. "/"											=> $images_replacement,
		);
		
		$html = '
		<html>
		';
		
		$head = '
		<head>
		
		<meta http-equiv="content-type" content="text/html; charset=UTF-8; width=device-width;">
		';
		$head_base = '
		<?php if( strpos( strtolower( $_SERVER["HTTP_HOST"] ), "cheltikkeh" ) ): ?>
			<base href="http://preview.cheltikkeh.com/" >
		<?php elseif( ! strpos( strtolower( $_SERVER["HTTP_HOST"] ), "cheltikkeh" ) ): ?>
			<base href="/" >
		<?php endif; ?>
		';
		$head_tags = '
		<script src="http://cheltikkeh.com/includes/scripts/source.js"></script>
		<link rel="stylesheet" href="http://cheltikkeh.com/includes/css/fonts.css">
		';
		$head_end = '
		</head>
		';
		
		$body = '
		<body>
		';
		$body_content = strtr( base64_decode( $_POST['cleared_html'] ), $replacements );
		$body_end = '
		</body>
		';
		
		$html_end = '
		</html>
		';
		
		
		
		$file = '
		<?php
		$root = dirname( __FILE__ );
		while( !file_exists( $root. "/initialize.php" ) ) $root = dirname( $root );
		require_once( $root. "/initialize.php" );
		
		$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASS, "'. DB_NAME. '" );
		mysqli_query( $connection, "SET CHARACTER SET ". DB_CHARSET ); 
		?>
		';
		
		if( strpos( $body_content, '<form ' ) > 0 )
			$file .= $forms_functions_replacement;
		
		$file .= $html;
		$file .= $head;
		//$file .= $head_base;
		$file .= $head_tags;
		$file .= $head_end;
		$file .= $body;
		$file .= $body_content;
		$file .= $body_end;
		$file .= $html_end;
		
		$index_file = fopen( $dir. 'index.php', "w" ) or die( 'wrong permission' );
		
		fwrite( $index_file, $file );
		fclose( $index_file );
		/* -------------------------------------- */
		
		return 1;
	}
	
	/* Operator Block Main Routine */
	function operate( $operation, $page, $sub, $args = array() ){
		$operation_answer = array( 'operation_answer'	=> NULL, );
		
		switch( strtolower( $operation ) ){
			case( 'signup' ):
				$error = signup_errors( $args );
				switch( $error ){
					case( -1 ):
						$operation_answer = array( 'operation_answer'	=> -1, );
						break;
					case( -2 ):
						$operation_answer = array( 'operation_answer'	=> -2, );
						break;
					case( -3 ):
						$operation_answer = array( 'operation_answer'	=> -3, );
						break;
					case( -4 ):
						$operation_answer = array( 'operation_answer'	=> -4, );
						break;
					case( -5 ):
						$operation_answer = array( 'operation_answer'	=> -5, );
						break;
					case( -6 ):
						$operation_answer = array( 'operation_answer'	=> -6, );
						break;
					case( -7 ):
						$operation_answer = array( 'operation_answer'	=> -7, );
						break;
					case( -8 ):
						$operation_answer = array( 'operation_answer'	=> -8, );
						break;
					case( -9 ):
						$operation_answer = array( 'operation_answer'	=> -9, );
						break;
					case( 1 ):
						signup( $args );
						$operation_answer = array( 'operation_answer'	=> 1, );
						break;
				}
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
				
			case( 'forget' ):
				$user_exists = database( 'num_rows', DB_NAME, array(
					'table_name'			=> 'users',
					'conditions'			=> 'email="'. $args['email']. '"',
				) );
				
				if( !$user_exists ){
					$operation_answer = array( 'operation_answer'	=> -1, );
				}else{
					database( 'update', DB_NAME, array(
						'table_name'			=> 'tokens',
						'update_values'			=> 'status="expired"',
						'conditions'			=> 'email="'. $args['email']. '"',
					) );
					
					$token = token( 45 );
					$link = "http://cheltikkeh.com/token/". $token;
					$expired = date( 'Y-m-d H:i:s', strtotime( '+16 minutes', strtotime( date( 'Y-m-d H:i:s' ) ) ) );
					
					$columns = 'email, token, expired';
					$values = '"'. $args['email']. '", "'. $token. '", "'. $expired. '"';
					database( 'write', DB_NAME, array(
						'table_name'			=> 'tokens',
						'columns'				=> $columns,
						'values'				=> $values,
					) );
					
					$result = email( $args['email'], 'لینک بازسازی رمزعبور', $link );
					
					switch( $result ){
						case( 1 ):
							header( 'location: /login/' );
							die();
							break;
					}
				}
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'token' ):
				$exists = database( 'num_rows', DB_NAME, array(
					'table_name'			=> 'tokens',
					'conditions'			=> 'token="'. $args['token']. '"',
				) );
				if( !$exists ){
					$operation_answer = array( 'operation_answer'	=> -1, );		// Token is not EXIST
				}else{
					$token = database( 'read', DB_NAME, array(
						'table_name'			=> 'tokens',
						'conditions'			=> 'token="'. $args['token']. '"',
					) );
					
					switch( strtolower( $token['status'] ) ){
						case( 'used' ):
							$operation_answer = array( 'operation_answer'	=> -2, );		// Token was USED
							break;
						
						case( 'expired' ):
							$operation_answer = array( 'operation_answer'	=> -3, );		// Token was EXPIRED
							break;
						
						case( 'active' ):
							$expired = strtotime( $token['expired'] );
							$now = strtotime( date( 'Y-m-d H:i:s' ) );
							if( $expired < $now ){
								database( 'update', DB_NAME, array(
									'table_name'			=> 'tokens',
									'update_values'			=> 'status="expired"',
									'conditions'			=> 'token="'. $args['token']. '"',
								) );
								$operation_answer = array( 'operation_answer'	=> -3, );		// Token was EXPIRED
							}else{
								$operation_answer = array( 'operation_answer'	=> 1, );		// Token is VALID
							}
							break;
					}
				}
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'login' ):
				if( !session( 'is_online' ) ){
					$login = session( 'login', array(
						'username'			=> $args['username'],
						'password'			=> md5( 'chel'. $args['password']. 'tikkeh' ),
					) );
					
					switch( $login ){
						case( 1 ):
							create_tables();
							
							create_folders();
							
							$operation_answer = array( 'operation_answer'	=> 1, );
							break;
						
						case( -1 ):
							$operation_answer = array( 'operation_answer'	=> -1, );		// Wrong Username/Password
							break;
					}
				}else{
					$operation_answer =  array( 'operation_answer'	=> 0, );		// Already Online
				}
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
				
			case( 'logout' ):
				session( 'logout' );
				
				header( 'location: /' );
				break;
				
			case( 'message' ):
				$operation_answer = array( 'operation_answer'	=> 'success', );
				if( session( 'captcha', array( 'captcha'	=> $args['captcha'], ) ) ){
					database( 'write', DB_NAME, array(
						'table_name'			=> 'messages',
						'columns'				=> 'name, email, message',
						'values'				=> '"'. $args['name']. '", "'. $args['email']. '", "'. $args['message']. '"',
					) );
					header( 'location: /contact/' );
				}else{
					$operation_answer = array( 'operation_answer'	=> 'wrong_captcha', );
				}
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
				
			case( 'verify' ):
				$result = verify( $args );
				
				switch( $result ){
					case( -2 ):
						$operation_answer = array( 'operation_answer'	=> -2, );	// Not Exists
						break;
					
					case( -1 ):
						$operation_answer = array( 'operation_answer'	=> -1, );	// UnSuccessful
						break;
					
					case( 0 ):
						$operation_answer = array( 'operation_answer'	=> 0, );	// Connection Error
						break;
				}
				
				$factor = database( 'read', DB_NAME, array(
					'table_name'			=> 'factors',
					'conditions'			=> 'number="'. $args['au']. '"',
				) );
				
				if( $factor ){
					switch( $factor['source'] ){
						case( 'cart' ):
							header( 'location: /cart/' );
							break;
						
						case( 'credit' ):
							header( 'location: /controlpanel/transactions/' );
							break;
					}
				}else{
					header( 'location: /' );
				}
				
				exit();
				die();
				
				break;
			
			case( 'charge' ):
				bank( 'credit', $args['amount'] );
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'payment' ):
				$result = payment( $args );
				
				switch( $result ){
					case( -1 ):
						$operation_answer = array( 'operation_answer'	=> -1, );	// Offline User
						break;
					
					case( -2 ):
						$operation_answer = array( 'operation_answer'	=> -2, );	// Low Credit
						break;
					
					case( 1 ):
						$operation_answer = array( 'operation_answer'	=> 1, );	// Done
						break;
					
					default:
						header( 'location: /cart/' );
						die();
				}
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'clearcart' ):
				start_session();
				
				$_SESSION['cart'] = array(
					'plans'				=> NULL,
					'modules'			=> NULL,
					'templates'			=> NULL,
				);
				header( 'location: /cart/' );
				die();
				break;
			
			case( 'remove' ):
				start_session();
				
				switch( $args['args_type'] ){
					case( 'plans' ):
						$_SESSION['cart'][$args['args_type']] = NULL;
						break;
					case( 'modules' ):
					case( 'templates' ):
						if( isset( $_SESSION['cart'][$args['args_type']][$args['args_id']] ) ){
							unset( $_SESSION['cart'][$args['args_type']][$args['args_id']] );
						}else{
							return -1;
						}
						break;
				}
				header( 'location: /cart/' );
				die();
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'addtocart' ):
				$result = addtocart( $sub, $args['args_id'] );
				
				switch( $result ){
					case( 0 ):
						$operation_answe = array( 'operation_answer'	=> 0, );
						break;
					
					case( -1 ):
						$operation_answer = array( 'operation_answer'	=> -1, );
						break;
					
					case( -2 ):
						$operation_answer = array( 'operation_answer'	=> -2, );
						break;
					
					case( -3 ):
						$operation_answer = array( 'operation_answer'	=> -3, );
						break;
					
					case( -4 ):
						$operation_answer = array( 'operation_answer'	=> -4, );
					
					default:
						$operation_answer = array( 'operation_answer'	=> 1, );
						
						switch( $sub ){
							case( 'plans' ):
								header( 'location: /'. $page. '/'. $sub. '/' );
								die();
								break;
							case( 'modules' ):
							case( 'templates' ):
								header( 'location: /'. $page. '/'. $sub. '/' );
								die();
								break;
						}
				}
				break;
			
			case( 'ticket' ):
				$user = session( 'user_info' );
				$last = database( 'read', DB_NAME, array(
					'table_name'			=> 'tickets',
					'order'					=> 'ticket_num DESC LIMIT 1',
				) );
				
				if( $last ){
					$args['ticket_num'] = $last['ticket_num'] + 1;
				}else{
					$args['ticket_num'] = 1;
				}
				
				$columns = 'ticket_num, firstname, lastname, username, email, phone, title, text';
				$values = '"'. $args['ticket_num']. '", "'. $user['firstname']. '", "'. $user['lastname']. '", "'. $user['username']. '", "'. $user['email']. '", "'. $user['phone'];
				$values .= '", "'. $args['title']. '", "'. $args['text']. '"';
				database( 'write', DB_NAME, array(
					'table_name'			=> 'tickets',
					'columns'				=> $columns,
					'values'				=> $values,
				) );
				
				$operation_answer = array( 'operation_answer'	=> 1, );
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'answer' ):
				$user = session( 'user_info' );
				
				$columns = 'ticket_num, firstname, lastname, username, email, phone, title, text';
				$values = '"'. $args['ticket_num']. '", "'. $user['firstname']. '", "'. $user['lastname']. '", "'. $user['username']. '", "'. $user['email']. '", "'. $user['phone'];
				$values .= '", "'. $args['title']. '", "'. $args['text']. '"';
				database( 'write', DB_NAME, array(
					'table_name'			=> 'tickets',
					'columns'				=> $columns,
					'values'				=> $values,
				) );
				
				$operation_answer = array( 'operation_answer'	=> 1, );
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'password' ):
				if( isset( $args['current'] ) ){
					$user = session( 'user_info' );
					
					if( $user['password'] != md5( 'chel'. $args['current']. 'tikkeh' ) ){
						$operation_answer = array( 'operation_answer'	=> -1, );
					}elseif( $args['password'] != $args['password-retype'] ){
						$operation_answer = array( 'operation_answer'	=> -2, );
					}else{
						$new_password = md5( 'chel'. $args['password']. 'tikkeh' );
						database( 'update', DB_NAME, array(
							'table_name'			=> 'users',
							'update_values'			=> 'password="'. $new_password. '"',
							'conditions'			=> 'id="'. $user['id']. '"',
						) );
						$operation_answer = array( 'operation_answer'	=> 1, );
					}
				}else{
					$token = database( 'read', DB_NAME, array(
						'table_name'			=> 'tokens',
						'conditions'			=> 'token="'. $args['token']. '"',
					) );
					$email = $token['email'];
					
					if( !$email ){
						$operation_answer = array( 'operation_answer'	=> -1, );
					}else{
						if( $args['password'] != $args['password-retype'] ){
							$operation_answer = array( 'operation_answer'	=> -2, );
						}else{
							$new_password = md5( 'chel'. $args['password']. 'tikkeh' );
							database( 'update', DB_NAME, array(
								'table_name'			=> 'users',
								'update_values'			=> 'password="'. $new_password. '"',
								'conditions'			=> 'email="'. $email. '"',
							) );
							
							database( 'update', DB_NAME, array(
								'table_name'			=> 'tokens',
								'update_values'			=> 'status="used"',
								'conditions'			=> 'token="'. $args['token']. '"',
							) );
							
							$operation_answer = array( 'operation_answer'	=> 1, );
							
							header( 'location: /login/' );
						}
					}
				}
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'informations' ):
				$user = session( 'user_info' );
				$prefix = $user['site_id']. '_';
				
				$update_values = 'firstname="'. $args['firstname']. '", ';
				$update_values .= 'lastname="'. $args['lastname']. '", ';
				$update_values .= 'email="'. $args['email']. '", ';
				$update_values .= 'phone="'. $args['phone']. '"';
				
				$conditions = 'id="'. $user['id']. '"';
				database( 'update', DB_NAME, array(
					'table_name'			=> 'users',
					'update_values'			=> $update_values,
					'conditions'			=> $conditions,
				) );
				
				$conditions = 'user="'. $user['id']. '"';
				database( 'update', DB_NAME, array(
					'table_name'			=> $prefix. 'informations',
					'update_values'			=> $update_values,
					'conditions'			=> $conditions,
				) );
				
				$update_values = 'title="'. $args['title']. '", ';
				$update_values .= 'description="'. $args['description']. '"';
				
				$conditions = 'id="'. $user['site_id']. '"';
				database( 'update', DB_NAME, array(
					'table_name'			=> 'sites',
					'update_values'			=> $update_values,
					'conditions'			=> $conditions,
				) );
				
				$conditions = 'user="'. $user['id']. '"';
				database( 'update', DB_NAME, array(
					'table_name'			=> $prefix. 'informations',
					'update_values'			=> $update_values,
					'conditions'			=> $conditions,
				) );
				
				$operation_answer = array( 'operation_answer'	=> 1, );
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'save' ):
				$operation_answer = save( $page, $sub, $args );
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'update' ):
				$operation_answer = update( $sub, $args );
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'delete' ):
				$operation_answer = delete( $sub, $args );
				
				if( $operation_answer ){
					header( 'location: /'. $page. '/'. $sub. '/' );
					die();
				}else{
					$output = show( $page, $sub, $operation_answer, $args );
				}
				break;
			
			case( 'new' ):
				$args['operation'] = 'new';
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'edit' ):
				$args['operation'] = 'edit';
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'answer' ):
				$args['operation'] = 'answer';
				
				$output = show( $page, $sub, $operation_answer, $args );
				break;
			
			case( 'list' ):
				$args['operation'] = 'list';
				
			case( 'show' ):
				$output = show( $page, $sub, $operation_answer, $args );
				
				if( $page === 'controlpanel' ){
					switch( $sub ){
						case( 'messages' ):
							if( isset( $args['args_id'] ) ){
								$user = session( 'user_info' );
								$prefix = $user['site_id']. '_';
								database( 'update', DB_NAME, array(
									'table_name'			=> $prefix. 'messages',
									'update_values'			=> 'status="read"',
									'conditions'			=> 'id="'. $args['args_id']. '"',
								) );
							}
							break;
					}
				}
				
				visit( $page, $sub );
				break;
			
			case( 'publish' ):
				save( $page, $sub, $args );
				$operation_answer = publish( $page, $sub, $args );
				
				if( $operation_answer ) header( 'location: /designer/' );
				die();
				break;
			
			default:
				$output = array( 'operation_answer'	=> 0, );
		}
		
		if( isset( $output ) ) return $output;
		return;
	}
	