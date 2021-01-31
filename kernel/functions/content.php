<?php
	/*
	Content Block
	*/
	
	/* Content Block SubRoutines */
	
	
	/* Content Block Main Routine */
	function content( $page, $sub, $args = array() ){
		$user_db = NULL;
		$conditions = 1;
		$db_name = DB_NAME;
		$prefix = '';
		$permission = array( 'permission'	=> true );
		
		switch( $page ){
			case( 'main' ):
				if( isset( $args['args_id'] ) )
					$conditions = 'id="'. $args['args_id']. '"';
				
				break;
			
			case( 'store' ):
				if( isset( $args['site_id'] ) ){
					$user_db = DB_NAME;
					$prefix = $args['site_id']. '_';
				}
				
				if( isset( $args['args_id'] ) )
					$conditions = 'id="'. $args['args_id']. '"';
				
				break;
			
			case( 'controlpanel' ):
				if( !isset( $args['site_id'] ) ){
					return array( 'permission'	=> NULL );
				}else{
					$db_name = DB_NAME;
					$prefix = $args['site_id']. '_';
					
					switch( $sub ){
						case( 'posts' ):
						case( 'categories' ):
							if( isset( $args['operation'] ) && $args['operation'] === 'new' ) return $permission;
							break;
						
						case( 'transactions' ):
							if( !isset( $args['operation'] ) ){
								$content = database( 'read', $db_name, array(
									'table_name'			=> $prefix. 'transactions',
									'order'					=> 'id DESC LIMIT 1',
								) );
								
								$output = $permission;
								$output += $content;
								return $output;
							}
							break;
						
						case( 'status' ):
							$content = database( 'read', $db_name, array(
								'table_name'			=> $prefix. 'plans',
								'order'					=> 'id DESC',
								'single'				=> false,
							) );
							
							$output = $permission;
							$output += $content;
							return $output;
							break;
						
						case( 'support' ):
							if( isset( $args['args_id'] ) ){
								database( 'update', DB_NAME, array(
									'table_name'			=> 'tickets',
									'update_values'			=> 'status="4"',
									'conditions'			=> 'ticket_num="'. $args['args_id']. '" AND status!="0" AND phone IS NULL',
								) );
				
								$conditions = 'ticket_num="'. $args['args_id']. '"';
								$group = '1';
								$order = 'date DESC';
							}else{
								$conditions = 'username="'. $args['username']. '"';
								$group = 'ticket_num';
								$order = 'ticket_num DESC';
							}
							
							$content = database( 'read', DB_NAME, array(
								'table_name'			=> 'tickets',
								'conditions'			=> $conditions,
								'group'					=> $group,
								'order'					=> $order,
								'single'				=> false,
							) );
							
							for( $c = 1; $c <= $content['nums']; $c++ ){
								$last = database( 'read', DB_NAME, array(
									'table_name'			=> 'tickets',
									'conditions'			=> 'ticket_num="'. $content[$c]['ticket_num']. '"',
									'order'					=> 'id DESC',
									'single'				=> true,
								) );
								$content[$c]['status'] = $last['status'];
								switch( $content[$c]['status'] ){
									case( '0' ):
										$content[$c]['class'] = 'closed';
										$content[$c]['status'] = 'بسته شده';
										break;
									case( '1' ):
										$content[$c]['class'] = 'agent-waiting';
										$content[$c]['status'] = 'در انتظار بررسی پشتیبانی';
										break;
									case( '2' ):
										$content[$c]['class'] = 'in-process';
										$content[$c]['status'] = 'در حال اقدام';
										break;
									case( '3' ):
										$content[$c]['class'] = 'user-waiting';
										$content[$c]['status'] = 'در انتظار بررسی کاربر';
										break;
									case( '4' ):
										$content[$c]['class'] = 'read';
										$content[$c]['status'] = 'در انتظار پاسخ کاربر';
										break;
								}
							}
							
							$output = $permission;
							$output += $content;
							return $output;
							break;
						
					}
				}
				
				if( isset( $args['args_id'] ) )
					$conditions = 'id="'. $args['args_id']. '"';
				
				if( isset( $args['category_id'] ) )
					$conditions = 'category="'. $args['category_id']. '"';
				
				break;
			
			case( 'designer' ):
				if( !isset( $args['site_id'] ) ){
					return array( 'permission'	=> NULL );
				}else{
					$db_name = DB_NAME;
					$prefix = $args['site_id']. '_';
				}
				
				if( isset( $args['args_id'] ) )
					$conditions = 'id="'. $args['args_id']. '"';
				
				break;
			
			default:
				die( "CONTENT_ERROR" );
		}
		
		$content = NULL;
		
		$table_name = strtolower( $sub );
		
		if( $page != 'store' )
			$table_name = $prefix. strtolower( $sub );
		
		$table_exists = database( 'table_exists', $db_name, array(
			'table_name'			=> $table_name,
		) );
		
		if( $table_exists ){
			$num_rows = database( 'num_rows', $db_name, array(
				'table_name'			=> $table_name,
				'conditions'			=> $conditions,
			) );
			
			if( $num_rows ){
				if( $num_rows > 1 ){
					$content = database( 'read', $db_name, array(
						'table_name'			=> $table_name,
						'conditions'			=> $conditions,
						'single'				=> false,
					) );
					
					if( $page === 'designer' ){
						switch( strtolower( $sub ) ){
							case( 'modules' ):
							case( 'templates' ):
								for( $c = 1; $c <= $content['nums']; $c++ ){
									$conditions = 'title="'. $content[$c]['title']. '"';
									
									$origin[$c] = database( 'read', $db_name, array(
										'table_name'			=> strtolower( $sub ),
										'conditions'			=> $conditions,
									) );
								}
								
								$origin['nums'] = $content['nums'];
								$content = $origin;
								
								break;
						}
					}
				}else{
					$content = database( 'read', $db_name, array(
						'table_name'			=> $table_name,
						'conditions'			=> $conditions,
					) );
					
					if( $page === 'designer' ){
						switch( strtolower( $sub ) ){
							case( 'modules' ):
							case( 'templates' ):
								$conditions = 'title="'. $content['title']. '"';
								
								$origin = database( 'read', $db_name, array(
									'table_name'			=> strtolower( $sub ),
									'conditions'			=> $conditions,
								) );
								
								$content = $origin;
								
								break;
						}
					}
				}
				
				if( $user_db ){
					$table_name = $prefix. strtolower( $sub );
					if( $num_rows > 1 ){
						for( $c = 1; $c <= $num_rows; $c++ ){
							$content[$c]['owned'] = false;
							
							if( $sub === 'plans' ){
								$condition = 'title="'. $content[$c]['title']. '" AND expired > "'. date('Y-m-d') . '"';
							}else{
								$condition = 'title="'. $content[$c]['title']. '"';
							}
							
							$exist = database( 'num_rows', $user_db, array(
								'table_name'			=> $table_name,
								'conditions'			=> $condition,
							) );
							
							if( $exist ) $content[$c]['owned'] = true;
						}
					}else{
						$content['owned'] = false;
						
						if( $sub === 'plans' ){
							$condition = 'title="'. $content['title']. '" AND LENGTH( expired ) > "'. date . '"';
						}else{
							$condition = 'title="'. $content['title']. '"';
						}
						
						$exist = database( 'num_rows', $user_db, array(
							'table_name'			=> $table_name,
							'conditions'			=> $condition,
						) );
						
						if( $exist ) $content['owned'] = true;
					}
				}else{
					if( $num_rows > 1 ){
						for( $c = 1; $c <= $num_rows; $c++ )
							$content[$c]['owned'] = false;
					}else{
						$content['owned'] = false;
					}
				}
			}
		}
		
		$output = $permission;
		if( $content )
			$output += $content;
			
		return $output;
	}
	