<html>
	<head></head>
	<body>

		<?php
			$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
			$zona = $_GET['Zona'];
			$vendedor = $_GET['Vendedor'];
			if($zona != "Seleccione Una Zona" && $zona){
				$query = "select ID_Zona,ID_Maquina, (count(ID_Maquina)*100 / totals.Numero_De_Maquinas) as promedio
						from Cliente_Maquina natural join Cliente_Zona natural join (select ID_Maquina, count(ID_Maquina) as Numero_De_Maquinas
						from Cliente_Maquina
						group by(ID_Maquina)) as totals
						where ID_Zona = (Select ID_Zona from Zona where Nombre_Zona = '".$zona."')
						group by ID_Maquina
						";
			}
			else if($vendedor != "Selecione Un Vendedor" && $vendedor){
				$query = "select ID_Vendedor,ID_Maquina, (count(ID_Maquina)*100 / totals.Numero_De_Maquinas) as promedio
						from Cliente_Maquina natural join Cliente_Vendedor natural join (select ID_Maquina, count(ID_Maquina) as Numero_De_Maquinas
						from Cliente_Maquina
						group by(ID_Maquina)) as totals
						where ID_Vendedor = (Select ID_Vendedor from Vendedor where Nombre_Vendedor = '".$vendedor."')
						group by ID_Maquina
						";
			}			
			mysql_select_db("db2014_g09", $connection);
			
			$result = mysql_query($query, $connection);
			if (!$result) {
				
				die(mysql_error());
			}

			else {
				if($vendedor != "Seleccione Un Vendedor" && $vendedor){
					echo "<table border='1px solid'>";
					
					// Obtengo todos los nombres de las columnas
					$data = array(); 
					if(mysql_num_rows($result) != 0){
						$aux = Array();
						while($row = mysql_fetch_array($result)) {
							$aux = Array();
							$aux[]= $row["ID_Vendedor"];
							$aux[]= $row["ID_Maquina"];
							$aux[]= $row["promedio"];
							$data[] = $aux;
							unset($aux);
						}
						echo "<td>ID_Vendedor</td>";
						echo "<td>ID_Maquina</td>";
						echo "<td>Porcentaje de Maquinas</td>";
						
						
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
				}else if($zona != "Seleccione Una Zona" && $zona){
					echo "<table border='1px solid'>";
					
					// Obtengo todos los nombres de las columnas
					$data = array(); 
					if(mysql_num_rows($result) != 0){
						$aux = Array();
						while($row = mysql_fetch_array($result)) {
							$aux = Array();
							$aux[]= $row["ID_Zona"];
							$aux[]= $row["ID_Maquina"];
							$aux[]= $row["promedio"];
							$data[] = $aux;
							unset($aux);
						}
						echo "<td>ID_Zona</td>";
						echo "<td>ID_Maquina</td>";
						echo "<td>Porcentaje de Maquinas</td>";
						
						
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
			}

				// Cerramos la conexión 
			mysql_close($connection);
		?>
	</body>
</html>
 