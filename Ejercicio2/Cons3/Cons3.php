<html>
	<head>
		<script type="text/javascript">
		function toggle_visibilityV(idV,idZ,rbV,rbZ) {
			var eV = document.getElementById(idV);
			var eZ = document.getElementById(idZ);
			var erV = document.getElementById(rbV);
			var erZ = document.getElementById(rbZ);
			
			if(erV.checked){
				eV.style.display = 'block';
				eZ.style.display = 'none';
			}
			if(erZ.checked){
				eZ.style.display = 'block';
				eV.style.display = 'none';
			}
		}
		</script>
		</head>
	<h2>Listar cual es la distribucion en % de cada maquina por vendedor o por zona.</h2>
	<form name = "" action = "Cons3DB.php" method="get"> 
		
			<input type="radio" name="Ordenar" id="VendedorR" value="Vendedor" onclick = "toggle_visibilityV('VendedorD','ZonaD','VendedorR','ZonaR')" >Distribucion por vendedor<br>
			<input type="radio" name="Ordenar" id="ZonaR" value="Zona" onclick = "toggle_visibilityV('VendedorD','ZonaD','VendedorR','ZonaR')">Distribucion por zona<br>
		<div id = "VendedorD" style = "display:none">
			<label> Elegir el Vendedor: </label>
			<select id = "Vendedor" name = "Vendedor">
				<?php
				
				$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
				
				$query = "SELECT Nombre_Vendedor FROM `Vendedor`";
		
				mysql_select_db("db2014_g09", $connection);
				
				$result = mysql_query($query, $connection);
				if (!$result) {
					die(mysql_error());
					echo "<option> No hay Maquinas disponibles </option>";
				}else{
					echo "<option>Seleccione Un Vendedor</option>";
					while ($rs = mysql_fetch_array($result)){
						echo "<option>".$rs['Nombre_Vendedor']."</option>";
					}
				}			
				?>	
			</select>
			<input type="submit" value="Submit">
		</div>
		<div id = "ZonaD" style = "display:none">
			<label> Elegir la Zona: </label>
			<select id = "Zona" name = "Zona">
				<?php
				
				$connection = mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
				
				$query = "SELECT Nombre_Zona FROM `Zona`";
		
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
			<input type="submit" value="Submit">
		
		</div>
	</form>
	<body>
		
	</body>
</html>