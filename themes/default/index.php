<?php

	define( 'P404_FILE', THEME. '/404.php' );
	define( 'PERMISSION_FILE', THEME. '/permission.php' );
	define( 'HEAD_FILE', THEME. '/header.php' );
	define( 'FOOTER_FILE', THEME. '/footer.php' );
	
	switch( $page['page'] ){
		case( 'main' ):
			require_once( HEAD_FILE );
			
			require_once( THEME. '/pages/'. $page['sub']. '.php' );
			
			require_once( FOOTER_FILE );
			
			break;
		
		case( 'store' ):
			require_once( HEAD_FILE );
			switch( $page['sub'] ){
				case( 'plans' ):
					require_once( THEME. '/pages/store/'. $page['sub']. '.php' );
					break;
				case( 'modules' ):
				case( 'templates' ):
					require_once( THEME. '/pages/store/'. $page['sub']. '.php' );
					if( !isset( $content['nums'] ) ) die();
					break;
			}
			require_once( FOOTER_FILE );
			break;
		
		case( 'controlpanel' ):
			require_once( HEAD_FILE );
			if( !isset( $content['permission'] ) ){
				require_once( PERMISSION_FILE );
				require_once( FOOTER_FILE );
			}else{
				require_once( THEME. '/pages/controlpanel/'. $page['sub']. '.php' );
			}
			break;
		
		case( 'designer' ):
			require_once( HEAD_FILE );
			if( !isset( $content['permission'] ) ){
				require_once( PERMISSION_FILE );
				require_once( FOOTER_FILE );
			}else{
				if( empty( $page['args'] ) ){
					require_once( THEME. '/pages/designer/designer.php' );
				}else{
					switch( $page['operation'] ){
						case( 'show' ):
							require_once( THEME. '/pages/designer/show.php' );
							break;
						
						case( 'edit' ):
						case( 'save' ):
							require_once( THEME. '/pages/designer/edit.php' );
							break;
						
						default:
							require_once( THEME. '/pages/designer/designer.php' );
					}
				}
			}
			break;
		
		default:
			require_once( HEAD_FILE );
			switch( $page['sub'] ){
				case( 'offline' ):
					require_once( THEME. '/user-offline.php' );
					break;
				
				case( 'notfound' ):
					require_once( THEME. '/user-notfound.php' );
					break;
				
				case( '404' ):
					require_once( THEME. '/404.php' );
					require_once( FOOTER_FILE );
					break;
			}
	}
