<?php
	/*
	DataBase Block
	*/
	
	/* DataBase Block SubRoutines */
	
	/* Connect to mysql server */
	function connect( $db_name ){
		$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASS, $db_name );
		if( !$connection )
			die( mysqli_connect_error() );
		return $connection;
	}
	
	/* DataBase Block Main Routine */
	function database( $routine, $db_name, $args = array() ){
		switch( strtolower( $routine ) ){
			case( 'create_user' ):
				$default_args = array(
					'username'			=> '',
					'password'			=> '',
				);
				$args = array_merge( $default_args, $args );
				$connection = connect( DB_NAME );
				$sql = "CREATE USER '". $args['username']. "'@'". DB_HOST. "' IDENTIFIED BY '". $args['password']. "'";
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				mysqli_close( $connection );
				break;
				
			case( 'grant_privileges' ):
				$default_args = array(
					'username'			=> '',
					'privileges'		=> 'ALL',
				);
				$args = array_merge( $default_args, $args );
				$connection = connect( DB_NAME );
				$sql = "GRANT ". $args['privileges']. " PRIVILEGES ON ". $db_name. ".* TO '". $args['username']. "'@'". DB_HOST. "' WITH GRANT OPTION";
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				mysqli_close( $connection );
				break;
				
			case( 'password_change' ):
				$default_args = array(
					'username'			=> '',
					'password'			=> '',
				);
				$args = array_merge( $default_args, $args );
				$connection = connect( DB_NAME );
				$username = $args['username'];
				$password = $args['password'];
				$sql = "UPDATE mysql.user SET Password = PASSWORD('$password') WHERE User = '$username' AND Host='". DB_HOST. "'";
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				$sql = "FLUSH PRIVILEGES";
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				mysqli_close( $connection );
				break;
				
			case( 'create_database' ):
				$connection = connect( DB_NAME );
				$sql = 'CREATE DATABASE IF NOT EXISTS '. $db_name. ' CHARACTER SET '. DB_CHARSET. ' COLLATE '. DB_CHARSET. '_bin';
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				mysqli_close( $connection );
				break;
				
			case( 'create_table' ):
				$default_args = array(
					'table_name'		=> '',
					'rows_definitions'	=> '',
				);
				$args = array_merge( $default_args, $args );
				$connection = connect( $db_name );
				$sql = 'SET CHARACTER SET '. DB_CHARSET;
				mysqli_query( $connection, $sql );
				$sql = 'CREATE TABLE IF NOT EXISTS '. $db_name. '.'. $args['table_name']. ' ( '. $args['rows_definitions']. ' ) ENGINE = MYISAM CHARSET=utf8 COLLATE utf8_bin';
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				mysqli_close( $connection );
				break;
				
			case( 'table_exists' ):
				$default_args = array(
					'table_name'		=> '',
				);
				$args = array_merge( $default_args, $args );
				$connection = connect( $db_name );
				$sql = 'SHOW TABLES LIKE "'. $args['table_name']. '"';
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				$exist = mysqli_num_rows( $query );
				mysqli_close( $connection );
				$output = $exist;
				break;
				
			case( 'num_rows' ):
				$default_args = array(
					'table_name'		=> '',
					'conditions'		=> '1',
					'group'				=> '1',
					'order'				=> '1',
				);
				$args = array_merge( $default_args, $args );
				$connection = connect( $db_name );
				$sql = 'SELECT * FROM '. $db_name. '.'. $args['table_name']. ' WHERE '. $args['conditions']. ' GROUP BY '. $args['group']. ' ORDER BY '. $args['order'];
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				$nums =  mysqli_num_rows( $query );
				mysqli_close( $connection );
				$output = $nums;
				break;
				
			case( 'read' ):
				$default_args = array(
					'table_name'		=> '',
					'columns'			=> '*',
					'conditions'		=> '1',
					'order'				=> '1',
					'group'				=> '1',
					'single'			=> true,
				);
				$args = array_merge( $default_args, $args );
				$connection = connect( $db_name );
				$sql = 'SET CHARACTER SET '. DB_CHARSET;
				mysqli_query( $connection, $sql );
				$sql = 'SELECT '. $args['columns']. ' FROM '. $db_name. '.'. $args['table_name']. ' WHERE '. $args['conditions']. ' GROUP BY '. $args['group']. ' ORDER BY '. $args['order'];
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				if( $args['single'] ){
					$object = mysqli_fetch_array( $query, MYSQLI_ASSOC );
				}else{
					$object['nums'] = mysqli_num_rows( $query );
					for ( $c = 1; $c <= $object['nums']; $c++ ){
						$object[$c] = mysqli_fetch_array( $query, MYSQLI_ASSOC );
					}
				}
				mysqli_close( $connection );
				$output = $object;
				break;
				
			case( 'write' ):
				$default_args = array(
					'table_name'		=> '',
					'columns'			=> '',
					'values'			=> '',
				);
				$args = array_merge( $default_args, $args );
				
				$connection = connect( $db_name );
				$sql = 'SET CHARACTER SET '. DB_CHARSET;
				mysqli_query( $connection, $sql );
				if( !isset( $args['default_value'] ) ){
					$sql = 'INSERT INTO '. $db_name. '.'. $args['table_name']. ' ('. $args['columns']. ') VALUES ('. $args['values']. ')';
				}else{
					$sql = 'INSERT INTO '. $db_name. '.'. $args['table_name']. ' ('. $args['columns']. ') SELECT * FROM (SELECT '. $args['values']. ') AS tmp WHERE NOT EXISTS ( SELECT * FROM '. $db_name. '.'. $args['table_name']. ' WHERE 1 )';
				}
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				
				mysqli_close( $connection );
				break;
				
			case( 'update' ):
				$default_args = array(
					'table_name'		=> '',
					'update_values'		=> '',
					'conditions'		=> '1',
				);
				$args = array_merge( $default_args, $args );
				
				$connection = connect( $db_name );
				$sql = 'SET CHARACTER SET '. DB_CHARSET;
				mysqli_query( $connection, $sql );
				$sql = 'UPDATE '. $db_name. '.'. $args['table_name']. ' SET '. $args['update_values']. ' WHERE '. $args['conditions'];
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				mysqli_close( $connection );
				break;
				
			case( 'delete' ):
				$default_args = array(
					'table_name'		=> '',
					'conditions'		=> '1',
				);
				$args = array_merge( $default_args, $args );
				$connection = connect( $db_name );
				$sql = 'DELETE FROM '. $args['table_name']. ' WHERE '. $args['conditions'];
				$query = mysqli_query( $connection, $sql );
				if( !$query )
					die( mysqli_error( $connection ) );
				mysqli_close( $connection );
				break;
				
			default:
				die( "DATABASE_ERROR" );
		}
		
		if( isset( $output ) ) return $output;
		return;
	}
