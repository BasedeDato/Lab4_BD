<html>
	<head></head>
	<body>

		<?php
			$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
			
			$query = "select CC.Nombre, CantidadDeComunicaciones, Numero_De_Maquinas
					from (select Nombre, count(Cuit) as CantidadDeComunicaciones
					from Cliente natural join Cliente_Comunicaciones
					group by Nombre) as CC left outer join (select Nombre, count(ID_Maquina) as Numero_De_Maquinas
					from Cliente natural join Cliente_Maquina
					group by Nombre) as CM ON CC.Nombre = CM.Nombre
					order by CantidadDeComunicaciones desc 
					";
			
			mysql_select_db("db2014_g09", $connection);
			
			$result = mysql_query($query, $connection);
			if (!$result) {
				
				die(mysql_error());
			}

			else {

				echo "<table border='1px solid'>";
				
				// Obtengo todos los nombres de las columnas
				$data = array(); 
				if(mysql_num_rows($result) != 0){
					$aux = Array();
					while($row = mysql_fetch_array($result)) {
						$aux = Array();
						$aux[]= $row["Nombre"];
						$aux[]= $row["CantidadDeComunicaciones"];
						$aux[]= $row["Numero_De_Maquinas"];
						$data[] = $aux;
						unset($aux);
					}
					echo "<tr>Nombre  </tr>";
					echo "<tr>CantidadDeComunicaciones  </tr>";
					echo "<tr>Numero_De_Maquinas</tr>";
					
					// Para cada fila
					foreach ($data as $row) {
					   echo "<tr>";
					   // Recorro cada columna
					   foreach ($row as $column) {
							// y obtengo su valor
						  echo "<td>".$column."</td>";
					   }
					   echo "</tr>";	
					}
					echo "</table>";
					echo ("Total de Datos:");
					echo(sizeof($data));
				}
				
				
				else {
					echo "La consulta no arrojo resultado";
				}
			}

				// Cerramos la conexión 
			mysql_close($connection);
		?>
	</body>
</html>