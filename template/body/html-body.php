<?php 
	require_once('/template/constants.php');
?>

	<body>
		<div id="body">
		<div id="page">
			<?php 
				include('html-body-header.php'); 
				include('html-body-nav.php'); 
				include('html-body-content.php');
				include('html-body-sidebar.php'); 
			?>
			<div class="separator"> </div>
			<?php include('html-body-footer.php'); ?>
		</div>
		<div id="copyright">&copy; Errol Markland, 2012.</div>
		</div>
	</body>