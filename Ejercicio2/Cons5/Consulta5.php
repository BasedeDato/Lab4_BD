<html>
	<head></head>
	<h2>Listado de Maquinas que pertenecen a una zona y no a otra/otras</h2>
	<form name = "" action = "Consulta5DB.php" method="get"> 
		Pertenece: 
		<select id = "Zona" name = "Zona">
			<?php
			
			$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
			
			$query = "SELECT Nombre_Zona FROM `zona`";
	
			mysql_select_db("db2014_g09", $connection);
			
			$result = mysql_query($query, $connection);
			if (!$result) {
				die(mysql_error());
				echo "<option> No hay Zonas disponibles </option>";
			}else{
				echo "<option>Seleccione Una Zona</option>";
				while ($rs = mysql_fetch_array($result)){
					echo "<option>".$rs['Nombre_Zona']."</option>";
				}
			}			
			?>	
		</select>
		
		No pertenecen: 
		<select id = "Zona" name = "Zona"  multiple>
			<?php
			
			$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
			
			$query = "SELECT Nombre_Zona FROM `zona`";
	
			mysql_select_db("db2014_g09", $connection);
			
			$result = mysql_query($query, $connection);
			if (!$result) {
				die(mysql_error());
				echo "<option> No hay Zonas disponibles </option>";
			}else{
				while ($rs = mysql_fetch_array($result)){
					echo "<option>".$rs['Nombre_Zona']."</option>";
				}
			}			
			?>	
		</select>
		<input type="submit" value="Submit">
	</form>
	<body>
		
	</body>
</html>