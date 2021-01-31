<?php
	$sub = ( isset( $_GET['sub'] ) ) ? strtolower( $_GET['sub'] ) : NULL;
	if( $sub ){
		$file = ROOT. '/users/'. $sub. '/index.php';
		if( file_exists( $file ) ) require_once( $file );
	}
?>
<script>
	$(document).ready( function(){
		$("header").remove();
	});
</script>
