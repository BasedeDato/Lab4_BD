<html>
	<?php
		$startdate = $_GET['event_startDate'];
		$enddate = $_GET['event_endDate'];
		$sdate = explode("-",$startdate);
		$edate = explode("-",$enddate);
		if(!checkdate($sdate[1],$sdate[2],$sdate[0])){
			echo "Formato de la fecha de inicio del periodo incorrecto<br>";
			echo "Vuelva y elija una fecha correcta<br>";
			return;
		}
		if(!checkdate($edate[1],$edate[2],$edate[0])){
			echo "Formato de la fecha de inicio del periodo incorrecto<br>";
			echo "Vuelva y elija una fecha correcta<br>";
			return;
		}
		
		$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
			$query = "select ID_Vendedor, Realizada/Pendiente as Indice
					from
					(
					(select ID_Vendedor, count(Comunicacion_Realizada) as Realizada
					from Comunicaciones
					WHERE Comunicacion_Realizada BETWEEN '".$startdate."' AND '".$enddate."'
					group by ID_Vendedor) as table1
					natural join
					(select ID_Vendedor, count(Comunicacion_Realizada) as Pendiente
					from Comunicaciones
					where Comunicacion_Realizada not between '1009-06-25' and '2009-07-01'
					group by ID_Vendedor) as table2
					) natural join Vendedor
					group by ID_Vendedor";
			
			mysql_select_db("db2014_g09", $connection);
			
			$result = mysql_query($query, $connection);
			if (!$result) {
				
				die(mysql_error());
			}

			else {

				echo "<table border='1px solid'>";

				// Obtengo todos los nombres de las columnas
				$data = array(); 
				if(mysql_fetch_assoc($result)){
					
					while($row = mysql_fetch_assoc($result)) {
						$data[] = $row;
					}
					
					$colNames = array_keys(reset($data));
					foreach ($colNames as $colName) {
						echo "<th> $colName </th>";
					}
					
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
</html>