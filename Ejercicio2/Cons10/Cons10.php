<html>
	<head>
	</head>
		<h2>Clientes que no poseen determinada maquina y se dedican a cierta actividad</h2>
		<form name = "" action = "Cons10DB.php" method="get">
			<label> Elija la maquina que no posee el cliente: </label>
			<select id = "Maquina" name = "Maquina">
				<?php
				
				$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
				
				$query = "SELECT Nombre_Maquina FROM `Maquina`";
		
				mysql_select_db("db2014_g09", $connection);
				
				$result = mysql_query($query, $connection);
				if (!$result) {
					die(mysql_error());
					echo "<option> No hay Maquinas disponibles </option>";
				}else{
					echo "<option>Seleccione Una Maquina</option>";
					while ($rs = mysql_fetch_array($result)){
						echo "<option>".$rs['Nombre_Maquina']."</option>";
					}
				}			
				?>	
			</select>
			<br><label> Elija la actividad del cliente: </label>
			<select id = "Actividad" name = "Actividad">
				<?php
				
				$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
				
				$query = "SELECT Nombre_Actividad FROM `Actividad`";
		
				mysql_select_db("db2014_g09", $connection);
				
				$result = mysql_query($query, $connection);
				if (!$result) {
					die(mysql_error());
					echo "<option> No hay Actividades disponibles </option>";
				}else{
					echo "<option>Seleccione Una Actividad</option>";
					while ($rs = mysql_fetch_array($result)){
						echo "<option>".$rs['Nombre_Actividad']."</option>";
					}
				}			
				?>	
			</select>
			<br><input type="submit" value="Submit">
		</form>
</html>