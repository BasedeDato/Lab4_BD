<html>
	<head></head>
	<body>	
		<?php 
			$enddate = $_GET['event_endDate'];
			$edate = explode("-",$enddate);
			if(!checkdate($edate[1],$edate[2],$edate[0])){
				echo "Formato Fecha Fin de Campana Incorrecto<br>" ;
				return;
			}else{
				echo "End Date: ".$enddate."<br>";
				return;
			}
			
			$maq_list = array();
			if(isset($_GET['maq'])){
				if(isset($_GET['actividad'])){
					foreach( $_GET['maq'] as $maquina){
						foreach ($_GET['act'] as $actividad){
							$query = "insert into Campana( Fecha_Inicio, Fecha_Fin, ID_Actividad, ID_Maquina) values(date(now()),
									date('".$enddate."'),(Select ID_Maquina from Maquina Where ID_Maquina = '".$maquina."'),
									(Select ID_Maquina from Maquina Where ID_Maquina = '".$actividad."'))";
						echo $query;
						}
					}
				}else{
					echo "No se seleccionaron actividades";
					return;
				}
			}else
			{
				echo "No se seleccionaron maquinas";
				return;
			}
			}
			
				
		?>
	</body>
</html>