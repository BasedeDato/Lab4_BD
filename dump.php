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
$xml->startElement('clientes');
while ($row = mysql_fetch_assoc($res)) {
    $xml->startElement("cliente");
    $xml->writeAttribute('Nombre', $row['Nombre']);
    $xml->writeAttribute('Cuit', $row['Cuit']);
    $xml->writeAttribute('Razon_Social', $row['Razon_Social']);
    $xml->writeAttribute('ID_Ciudad', $row['ID_Ciudad']);
    $xml->writeAttribute('ID_Provincia', $row['ID_Provincia']);
    $xml->writeAttribute('ID_Actividad', $row['ID_Actividad']);
    # agrego maquinas
    $sqly = "select ID_Maquina, Cantidad from Cliente natural join Cliente_Maquina where Cuit = '".$row['Cuit']."'";
    $res2 = mysql_query($sqly);
    while ($row2 = mysql_fetch_assoc($res2)) {
    $xml->startElement("cliente-maquina");
    $xml->writeAttribute('ID_Maquina', $row2['ID_Maquina']);
	$xml->writeAttribute('Cantidad', $row2['Cantidad']);
    $xml->endElement();
    }
    # agrego contact info
    $sqly = "select Nombre_Contacto, Telefono, Cumpleanos, Email, ID_Contacto from Cliente natural join Cliente_Contacto natural join Contacto where Cuit ='".$row['Cuit']."'";
    $res2 = mysql_query($sqly);
    while ($row2 = mysql_fetch_assoc($res2)) {
    $xml->startElement("contacto");
    $xml->writeAttribute('Nombre_Contacto', $row2['Nombre_Contacto']);
    $xml->writeAttribute('ID_Contacto', $row2['ID_Contacto']);
    $xml->writeAttribute('Telefono', $row2['Telefono']);
    $xml->writeAttribute('Cumpleanos', $row2['Cumpleanos']);
    $xml->writeAttribute('Email', $row2['Email']);
    $xml->endElement();
    }
    # agrego vendedores
    $sqly = "select Nombre_Vendedor, ID_Vendedor, ID_Zona from Cliente natural join Cliente_Vendedor natural join Vendedor where Cuit = '".$row['Cuit']."'";
    $res2 = mysql_query($sqly);
    while ($row2 = mysql_fetch_assoc($res2)) {
    $xml->startElement("vendedor");
    $xml->writeAttribute('Nombre_Vendedor', $row2['Nombre_Vendedor']);
    $xml->writeAttribute('ID_Vendedor', $row2['ID_Vendedor']);
    $xml->writeAttribute('ID_Zona', $row2['ID_Zona']);
    $xml->endElement();
    }
$xml->endElement();
}
$xml->endElement();
#header('Content-type: text/xml');
$xml->flush();
$xml->endDocument();
?>
