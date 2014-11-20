<html>
	<head></head>
	<h2>Listar los clientes con la cantidad de maquinarias que se tienen registradas ordenados de mayor a menor de un determinado vendedor</h2>
	<form name = "" action = "Cons1DB.php" method="get"> 
		Elija el Vendedor: 
		<select id = "Vendedor" name = "Vendedor">
			<?php
			
			$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
			
			$query = "SELECT Nombre_Vendedor FROM `Vendedor`";
	
			mysql_select_db("db2014_g09", $connection);
			
			$result = mysql_query($query, $connection);
			if (!$result) {
				die(mysql_error());
				echo "<option> No hay Vendedores disponibles </option>";
			}else{
				echo "<option>Seleccione un vendedor</option>";
				while ($rs = mysql_fetch_array($result)){
					echo "<option>".$rs['Nombre_Vendedor']."</option>";
				}
			}			
			?>	
		</select>
		<input type="submit" value="Submit">
	</form>
	<body>
		
	</body>
</html>