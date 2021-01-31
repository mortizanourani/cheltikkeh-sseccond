<content class="body">
	<div class="main">
		<?php
			if( isset( $content['html'] ) ){
				$html = base64_decode( $content['html'] );
				$replacements = 'ondragover="dragover( event, $(this) )"';
				$html = str_replace( $replacements, "", $html );
				echo $html;
			}
		?>
	</div>
</content>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
	$(document).ready( function(){
		$(".module-row").removeClass();
		$(".module-column").removeClass();
		$(".module-place").removeClass();
		$(".module").removeClass();
		$(".module-place-menu").remove();
	});
</script>
