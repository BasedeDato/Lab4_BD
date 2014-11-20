<html>
	<h2>Listado de Vendedores segun indice de cumplimiento de comunicaciones (pendientes/realizadas) en un periodo dado.</h2>
	
	<form name = "" action = "Cons9DB.php" method="get">
		<label>Seleccione desde cuando: </label><br>
			<br>Inicio del Periodo<input name="event_startDate" type="text" id="event_startDate" size="17" value = <?php echo date('d-m-Y'); ?>><br>
		<br><br><label>Seleccione hasta cuando: </label><br>
			<br>Fin del Periodo<input name="event_endDate" type="text" id="event_endDate" size="17" value = <?php echo date('d-m-Y'); ?>><br>
		<br><input name="SUBMIT"  type="submit" id="submit" value="Listar Vendedores">
					
	</form>

	
</html>
