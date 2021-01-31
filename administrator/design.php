<?php
	$sub = ( isset( $_GET['sub'] ) ) ? strtolower( $_GET['sub'] ) : NULL;
	if( $sub ){
		$site = database( 'read', DB_NAME, array(
			'table_name'			=> 'users',
			'conditions'			=> 'username="'. $_GET['sub']. '"',
			'single'				=> true,
		) );
		
		$design = database( 'read', DB_NAME, array(
			'table_name'			=> $site['id']. '_designs',
			'conditions'			=> 'id="1"',
			'single'				=> true,
		) );
		
		if( $design )
			echo base64_decode( $design['html'] );
	}
?>
<script>
	$(document).ready( function(){
		$(".header").remove();
		
		$(".module-row").removeClass();
		$(".module-column").removeClass();
		$(".module-place").removeClass();
		$(".module").removeClass();
		$(".module-place-menu").remove();
	});
</script>

