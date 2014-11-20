<html>
	<head></head>
	<body>

		<?php
			$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
			
			$vendedor = $_GET['Vendedor'];
			
			$query = "Select Nombre, Cantidad from (Cliente natural join (Cliente_Maquina natural Join (
						Cliente_Vendedor natural Join Vendedor))) where Nombre_Vendedor = '".$vendedor."' order by Cantidad asc";

			mysql_select_db("db2014_g09", $connection);
			
			$result = mysql_query($query, $connection);
			if (!$result) {
				
				die(mysql_error());
			}
			else {
				if(mysql_num_rows($result) != 0){
					$aux = Array();
					while($row = mysql_fetch_array($result)) {
						$aux = Array();
						$aux[]= $row["Nombre"];
						$aux[]= $row["1"];
						$data[] = $aux;
						unset($aux);
					}
					
					echo "<tr>Nombre  </tr>";
					echo "<tr>Numero_De_Maquinas</tr><br>";
					
					foreach ($data as $row) {
					   echo "<tr>";
					   // Recorro cada columna
					   foreach ($row as $column) {
							// y obtengo su valor
						  echo "<td>  ".$column."</td>";
					   }
					   echo "</tr>";	
					}
					
					echo "</table>";
					echo ("<br>Total de Datos:");
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