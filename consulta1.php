<?php

$doc = new DOMDocument;
$doc->Load('datos.xml');
$xpath = new DOMXpath($doc);

$clientes = 'Clientes/Cliente_Maquina[Cantidad>2]';

$consulta = $xpath->query ($clientes);

echo "Clientes:\n";
foreach ($clientes as $Cuit) {
 	$nombre = $Cuit->nodeValue;
 	echo "nombre\n"

}

?>