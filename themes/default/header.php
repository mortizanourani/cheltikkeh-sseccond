<!DOCTYPE html>
<html lang="fa" >
	<head>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-NGXSLT7');</script>
		<!-- End Google Tag Manager -->

		<meta charset="utf-8" />
		<meta name="author" content="ChelTikkeh" />
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<meta name="enamad" content="474806776" />

		<?php if( ( $page['page'] === 'store' ) && isset( $page['args']['args_id'] ) ): ?>
		
			<link href="/themes/default/includes/css/fonts.css" rel="stylesheet" type="text/css" />
		
		<?php elseif( ( $page['page'] === 'designer' ) ): ?>
		
			<link href="/themes/default/includes/css/fonts.css" rel="stylesheet" type="text/css" />
			
			<?php if( !isset( $content['permission'] ) || !isset( $page['args']['args_id'] ) ): ?>
			
			<link href="/themes/default/includes/css/main.css" rel="stylesheet" type="text/css" />
			<link href="/themes/default/includes/css/designer.css" rel="stylesheet" type="text/css" />
			
			<?php elseif( $page['operation'] === 'edit' ): ?>
			
			<link href="/themes/default/includes/css/editor.css" rel="stylesheet" type="text/css" />
		
			<script src="/kernel/scripts/source.js"></script>
			<script src="/kernel/scripts/editor.js"></script>
			<script src="/kernel/scripts/editor-settings.js"></script>
			
			<?php endif; ?>
			
		<?php else: ?>
		
			<?php if( $page['page'] === 'other' ): ?>
			
			<link href="http://cheltikkeh.com/themes/default/includes/css/fonts.css" rel="stylesheet" type="text/css" />
			<link href="http://cheltikkeh.com/themes/default/includes/css/main.css" rel="stylesheet" type="text/css" />
			
			<link href="http://cheltikkeh.com/themes/default/includes/css/home.css" rel="stylesheet" type="text/css" />
			
			<?php elseif( $page['page'] === 'main' ): ?>
			
			<link href="/themes/default/includes/css/fonts.css" rel="stylesheet" type="text/css" />
			<link href="/themes/default/includes/css/main.css" rel="stylesheet" type="text/css" />
			
			<link href="/themes/default/includes/css/home.css" rel="stylesheet" type="text/css" />
			
			<script src="/kernel/scripts/source.js"></script>
			<script src="/themes/default/includes/scripts/scripts.js"></script>
			
			<?php else: ?>
			
			<link href="/themes/default/includes/css/fonts.css" rel="stylesheet" type="text/css" />
			<link href="/themes/default/includes/css/main.css" rel="stylesheet" type="text/css" />
			
			<link href="/themes/default/includes/css/<?php echo $page['page']; ?>.css" rel="stylesheet" type="text/css" />
			
			<script src="/kernel/scripts/source.js"></script>
			<script src="/themes/default/includes/scripts/scripts.js"></script>
			
			<?php endif; ?>
			
		<?php endif; ?>
		
		<?php
		$title = '';
		if( isset( $page['title'] ) )
			$title = ' | '. $page['title'];
		?>
		<title>چل تیکه <?php echo $title; ?></title>
	</head>
	<body>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NGXSLT7"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
