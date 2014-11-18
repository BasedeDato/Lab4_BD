<html>
  <head></head>
  <h2>Proyecto 4 Base de Datos</h2>
  <body>
  <form name = "" action ="Principal.php" method="post">
      Ingrese la consulta xpath: <input type="text" name="consulta"><br>
       <button type="submit" >Ver los resultados de la Consulta!!!</button> 
  </form>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $consulta = $_POST['consulta'];
  if (file_exists('datos.xml')) {
    $xml = new SimpleXMLElement('datos.xml', 0, true);
    $result = $xml->xpath($consulta);
    foreach ($result as $key => $value) {
          echo htmlspecialchars((string)$value->asXml())." <br>";
        }
    // while(list( , $nodo) = each($result)) {
    //   echo 'LA CONSULTA ES: ',$nodo,"\n";
    // }
  }
  else {
    exit('Error abriendo datos.xml.');
  }
}
?>
    </body>
</html>
