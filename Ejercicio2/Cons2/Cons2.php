<html>
	<head></head>
	<body>
		<form id="form1" name="form1" method="get" action="Cons2DB.php">
			<table width="600" border="5">
				<tr>
				  <td><label>Seleccione las Maquinas de la Campana: </label></td>
				  <td><select name="maq[]" id="maquina[]" size="10" multiple tabindex="1">
					<?php
						 $connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
				
						$query = "SELECT Nombre_Maquina FROM `Maquina`";
	
						mysql_select_db("db2014_g09", $connection);
						
						$result = mysql_query($query, $connection);
						if (!$result) {
							die(mysql_error());
							echo "<option> No hay Zonas disponibles </option>";
						}else{
							while ($rs = mysql_fetch_array($result)){
								echo "<option>".$rs['Nombre_Maquina']."</option>";
							}
						}			
					?>	
				  </select>
				  </td>
				</tr>
				<tr>
				  <td><label>Seleccione las Actividades de la Campana: </label></td>
				  <td><select name="act[]" id="act[]" size="10" multiple tabindex="1">
					<?php
						 $connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
				
						$query = "SELECT Nombre_Actividad,Id_Actividad FROM `Actividad`";
	
						mysql_select_db("db2014_g09", $connection);
						
						$result = mysql_query($query, $connection);
						if (!$result) {
							die(mysql_error());
							echo "<option> No hay Actividades disponibles </option>";
						}else{
							while ($rs = mysql_fetch_array($result)){
								echo "<option>".$rs['Nombre_Actividad']."</option>";
							}
						}			
					?>	
				  </select>
				  </td>
				</tr>
				<tr>
					<td><label>Seleccione la fecha de la Campana: </label></td>
					<td>
						Fin del Evento<input name="event_endDate" type="text" id="event_endDate" size="17" value = <?php echo date('Y-m-d'); ?>>
						<center><input name="SUBMIT"  type="submit" id="submit" value="Anadir Evento"></center>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>