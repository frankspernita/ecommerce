<?php
/*
	? >
	<script>
		alert('< ?php echo $_SERVER['SERVER_NAME'];? >');
	</script>
	< ?php
*/
	header('Location: http://'. $_SERVER['SERVER_NAME'] .'/paqueteria/tarifario/nuevo.php');
	
?>