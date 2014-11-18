<html>
    <head></head>
    <h2>Proyecto 3 Base de Datos</h2>
    <body>
    <form name = "" action ="Principal.php" method="post">
        Ingrese la consulta xpath: <input type="text" name="cons"><br>
         <button type="submit" >Ver los resultados de la Consulta!!!</button> 
    </form>
	
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$consulta = $_POST['cons'];
		if (file_exists('datos.xml')) {
			
			$xml = simplexml_load_file('datos.xml');
			$namespaces = $xml->getDocNamespaces();
			var_dump($namespaces);

			//realizo la consulta
			$result = $xml->xpath("atom:Cliente");
			var_dump($consulta);
			var_dump($result);
			
			//Convierto el codigo XML a texto para que se imprima bien en HTML
			foreach ($result as $key => $value) {
						echo htmlspecialchars((string)$value->asXml())." <br>";
					}
		} else {
			exit('Error abriendo datos .xml.');
		}
	}
    ?>
    </body>
</html>
