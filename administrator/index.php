<?php
	require_once( '/initialize.php' );
	
	if( !isset( $_SESSION ) ) session_start();
	
	if( isset( $_POST['submit'] ) ){
		switch( $_POST['submit'] ){
			case( 'login' ):
				$admin = database( 'read', DB_NAME, array(
					'table_name'			=> 'administrators',
					'conditions'			=> 'username="'. $_POST['username']. '" AND password="'. md5( 'chel'. $_POST['password']. 'tikkeh' ). '"',
				) );
				if( $admin ){
					$_SESSION['login_admin'] = $_POST['username'];
					$redirect = $_GET['user'] ? '/visits/' : '/administrators/visits/';
				}else{
					$_SESSION['login_fail'] = true;
					$redirect = $_GET['user'] ? '/' : '/administrators/';
				}
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'logout' ):
				if( isset( $_SESSION['login_admin'] ) ) unset( $_SESSION['login_admin'] );
				
				$redirect = $_GET['user'] ? '/' : '/administrators/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'saveplan' ):
				database( 'write', DB_NAME, array(
					'table_name'			=> 'plans',
					'columns'				=> 'title, host, bandwidth, credit, price, off',
					'values'				=> '"'. $_POST['title']. '", "'. $_POST['host']. '", "'. $_POST['bandwidth']. '", "'. $_POST['credit']. '", "'. $_POST['price']. '", "'. $_POST['off']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/plans/' : '/administrators/plans/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'updateplan' ):
				$update_values = 'title="'. $_POST['title']. '", ';
				$update_values .= 'host="'. $_POST['host']. '", ';
				$update_values .= 'bandwidth="'. $_POST['bandwidth']. '", ';
				$update_values .= 'credit="'. $_POST['credit']. '", ';
				$update_values .= 'price="'. $_POST['price']. '", ';
				$update_values .= 'off="'. $_POST['off']. '"';
				database( 'update', DB_NAME, array(
					'table_name'			=> 'plans',
					'update_values'			=> $update_values,
					'conditions'			=> 'id="'. $_POST['id']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/plans/' : '/administrators/plans/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'deleteplan' ):
				database( 'delete', DB_NAME, array(
					'table_name'			=> 'plans',
					'conditions'			=> 'id="'. $_POST['id']. '"',
				) );

				$redirect = $_GET['user'] ? '/plans/' : '/administrators/plans/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'savemodule' ):
				database( 'write', DB_NAME, array(
					'table_name'			=> 'modules',
					'columns'				=> 'title, type, image, html, css, script, price, off',
					'values'				=> '"'. $_POST['title']. '", "'. $_POST['type']. '", "'. $_POST['image']. '", "'. base64_encode( $_POST['html'] ). '", "'. base64_encode( $_POST['css'] ). '", "'. base64_encode( $_POST['script'] ). '", "'. $_POST['price']. '", "'. $_POST['off']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/modules/' : '/administrators/modules/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'updatemodule' ):
				$update_values = 'title="'. $_POST['title']. '", ';
				$update_values .= 'type="'. $_POST['type']. '", ';
				$update_values .= 'image="'. $_POST['image']. '", ';
				$update_values .= 'html="'. base64_encode( $_POST['html'] ). '", ';
				$update_values .= 'css="'. base64_encode( $_POST['css'] ). '", ';
				$update_values .= 'script="'. base64_encode( $_POST['script'] ). '", ';
				$update_values .= 'price="'. $_POST['price']. '", ';
				$update_values .= 'off="'. $_POST['off']. '"';
				database( 'update', DB_NAME, array(
					'table_name'			=> 'modules',
					'update_values'			=> $update_values,
					'conditions'			=> 'id="'. $_POST['id']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/modules/' : '/administrators/modules/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'deletemodule' ):
				database( 'delete', DB_NAME, array(
					'table_name'			=> 'modules',
					'conditions'			=> 'id="'. $_POST['id']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/modules/' : '/administrators/modules/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'savetemplate' ):
				database( 'write', DB_NAME, array(
					'table_name'			=> 'templates',
					'columns'				=> 'title, image, html, script, sponsor, sponsor_link, price, off',
					'values'				=> '"'. $_POST['title']. '", "'. $_POST['image']. '", "'. base64_encode( $_POST['html'] ). '", "'. base64_encode( $_POST['script'] ). '", "'. $_POST['sponsor']. '", "'. $_POST['sponsor_link']. '", "'. $_POST['price']. '", "'. $_POST['off']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/templates/' : '/administrators/templates/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'updatetemplate' ):
				$update_values = 'title="'. $_POST['title']. '", ';
				$update_values .= 'image="'. $_POST['image']. '", ';
				$update_values .= 'html="'. base64_encode( $_POST['html'] ). '", ';
				$update_values .= 'script="'. base64_encode( $_POST['script'] ). '", ';
				$update_values .= 'sponsor="'. $_POST['sponsor']. '", ';
				$update_values .= 'sponsor_link="'. $_POST['sponsor_link']. '", ';
				$update_values .= 'price="'. $_POST['price']. '", ';
				$update_values .= 'off="'. $_POST['off']. '"';
				database( 'update', DB_NAME, array(
					'table_name'			=> 'templates',
					'update_values'			=> $update_values,
					'conditions'			=> 'id="'. $_POST['id']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/templates/' : '/administrators/templates/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'deletetemplate' ):
				database( 'delete', DB_NAME, array(
					'table_name'			=> 'templates',
					'conditions'			=> 'id="'. $_POST['id']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/templates/' : '/administrators/templates/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'deletemessage' ):
				database( 'delete', DB_NAME, array(
					'table_name'			=> 'messages',
					'conditions'			=> 'id="'. $_POST['id']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/messages/' : '/administrators/messages/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'ticket' ):
				database( 'write', DB_NAME, array(
					'table_name'			=> 'tickets',
					'columns'				=> 'ticket_num, firstname, lastname, username, title, text, status',
					'values'				=> '"'. $_POST['no']. '", "'. $_POST['firstname']. '", "'. $_POST['lastname']. '", "'. $_POST['post']. '", "'. $_POST['title']. '", "'. $_POST['answer']. '", "3"',
				) );
				
				$redirect = $_GET['user'] ? '/tickets/' : '/administrators/tickets/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'closeticket' ):
				database( 'update', DB_NAME, array(
					'table_name'			=> 'tickets',
					'update_values'			=> 'status="0"',
					'conditions'			=> 'ticket_num="'. $_POST['no']. '"',
				) );
				
				$redirect = $_GET['user'] ? '/tickets/' : '/administrators/tickets/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			case( 'password' ):
				$admin = database( 'read', DB_NAME, array(
					'table_name'			=> 'administrators',
					'conditions'			=> 'username="'. $_SESSION['login_admin']. '"',
				) );
				
				if( $admin['password'] != md5( 'chel'. $_POST['current']. 'tikkeh' ) ){
					$_SESSION['wrong_password'] = true;
				}else{
					if( $_POST['password'] != $_POST['password-retype'] ){
						$_SESSION['different_password'] = true;
					}else{
						database( 'update', DB_NAME, array(
							'table_name'			=> 'administrators',
							'update_values'			=> 'password="'. md5( 'chel'. $_POST['password']. 'tikkeh' ). '"',
							'conditions'			=> 'username="'. $_SESSION['login_admin']. '"',
						) );
						
						$_SESSION['password_changed'] = true;
					}
				}
				
				$redirect = $_GET['user'] ? '/password/' : '/administrators/password/';
				
				header( 'location: '. $redirect );
				die();
				break;
			
			default:
				
		}
	}
	
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<link href="/themes/default/includes/css/fonts.css" rel="stylesheet" type="text/css">
		<link href="/themes/default/includes/css/main.css" rel="stylesheet" type="text/css">
		<link href="/themes/default/includes/css/administrators.css" rel="stylesheet" type="text/css">
		
		<script src="/kernel/scripts/source.js"></script>
		
		<title>مدیریت سامانه « چل تیکه »</title>
	</head>
	<body>
		<header class="header">
			<a class="header-logo" href="http://cheltikkeh.com/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
			<menu class="main-menu">
				<a href="http://cheltikkeh.com/store/plans/" title="طرح ها"><button class="button">طرح ها</button></a>
				<a href="http://cheltikkeh.com/store/modules/" title="ماژول ها"><button class="button">ماژول ها</button></a>
				<a href="http://cheltikkeh.com/store/templates/" title="قالب ها"><button class="button">قالب ها</button></a>
				<?php if( !isset( $_SESSION ) ) session_start(); ?>
				<?php if( isset( $_SESSION['login_admin'] ) ): ?>
					<form method="POST"><button class="button" name="submit" value="logout">خروج</button></form>
				<?php endif; ?>
			</menu>
		</header>
		
		<content class="body">
			<?php
				if( ! isset( $_SESSION['login_admin'] ) ){
					$page = ( $_GET['page'] ? $_GET['page'] : 'login' ). '.php';
					if( $page === 'login.php' ){
						require_once( dirname( __FILE__ ). '/'. $page );
					}else{
						$redirect = $_GET['user'] ? '/' : '/administrators/';
						header( 'location: '. $redirect );
						die();
					}
					
				}else{
					$page = ( ( isset( $_GET['page'] ) ) ? $_GET['page'] : '' ). '.php';
					
					$page = dirname( __FILE__ ). '/'. $page;
					
					if( file_exists( $page ) ){
						require_once( $page );
					}else{
						$redirect = $_GET['user'] ? '/visits/' : '/administrators/visits/';
						header( 'location: '. $redirect );
						die();
					}
				
				}
			?>
		</content>
	</body>
</html>