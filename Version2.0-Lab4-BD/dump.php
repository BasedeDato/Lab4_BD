<?php
//mysql_connect("kali", "db2014_g09", "margarita88", "");
mysql_connect("localhost", "root", "", "db2014_g09") or die("¡Error al conectarse!".mysql_error());
mysql_select_db('db2014_g09');
$sql = "SELECT * FROM Cliente order by Nombre";
$res = mysql_query($sql);
$xml = new XMLWriter();
$xml->openURI("datos.xml");
$xml->startDocument('1.0', 'UTF-8', 'yes');
$xml->setIndent(true);
$xml->startElement('Clientes');
while ($row = mysql_fetch_assoc($res)) {
    $xml->startElement("Cliente");
    $xml->writeAttribute('Nombre', $row['Nombre']);
    $xml->writeAttribute('Cuit', $row['Cuit']);
    $xml->writeAttribute('Razon_Social', $row['Razon_Social']);
    $xml->writeAttribute('Id_Zona', $row['Id_Zona']);
    $xml->writeAttribute('Telefono', $row['Telefono']);
    $xml->writeAttribute('Id_Vendedor', $row['Id_Vendedor']);
	$xml->writeAttribute('Id_Ciudad', $row['Id_Ciudad']);
	$xml->writeAttribute('Id_Maquina', $row['Id_Maquina']);
    # agrego maquinas
    $sqly = "select Nombre_Maquina, Cantidad, Cuit from Cliente natural join Maquina where Id_Maquina = '".$row['Id_Maquina']."'";
    $res2 = mysql_query($sqly);
	$row2 = mysql_fetch_assoc($res2);
    #while ($row2 = mysql_fetch_assoc($res2)) {
    $xml->startElement("Maquina");
    $xml->writeAttribute('Nombre_Maquina', $row2['Nombre_Maquina']);
	$xml->writeAttribute('Id_Maquina', $row['Id_Maquina']);
	$xml->writeAttribute('Cuit', $row2['Cuit']);
	$xml->writeAttribute('Cantidad', $row2['Cantidad']);
    $xml->endElement();
    #}
    # agrego vendedores
    $sqly = "select Nombre_Vendedor from Cliente natural join Vendedor where Id_Vendedor = '".$row['Id_Vendedor']."'";
    $res2 = mysql_query($sqly);
	$row2 = mysql_fetch_assoc($res2);
    #while ($row2 = mysql_fetch_assoc($res2)) {
    $xml->startElement("Vendedor");
    $xml->writeAttribute('Nombre_Vendedor', $row2['Nombre_Vendedor']);
    $xml->writeAttribute('Id_Vendedor', $row['Id_Vendedor']);
    $xml->endElement();
    #}
	# agrego Ciudad
    $sqly = "select Nombre_Ciudad from Cliente natural join Ciudad where Id_Ciudad = '".$row['Id_Ciudad']."'";
    $res2 = mysql_query($sqly);
	$row2 = mysql_fetch_assoc($res2);
    #while ($row2 = mysql_fetch_assoc($res2)) {
    $xml->startElement("Ciudad");
    $xml->writeAttribute('Nombre_Ciudad', $row2['Nombre_Ciudad']);
    $xml->writeAttribute('Id_Ciudad', $row['Id_Ciudad']);
    $xml->endElement();
    #}
	# agrego Zona
    $sqly = "select Nombre_Zona from Cliente natural join Zona where Id_Zona = '".$row['Id_Zona']."'";
    $res2 = mysql_query($sqly);
	$row2 = mysql_fetch_assoc($res2);
    #while ($row2 = mysql_fetch_assoc($res2)) {
    $xml->startElement("Zona");
    $xml->writeAttribute('Nombre_Zona', $row2['Nombre_Zona']);
    $xml->writeAttribute('Id_Zona', $row['Id_Zona']);
    $xml->endElement();
    #}
	
$xml->endElement();
}
$xml->endElement();
#header('Content-type: text/xml');
$xml->flush();
$xml->endDocument();
?>
