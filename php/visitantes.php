<?php
session_start();
include("conexao.php");

if(isset($_POST['contar'])){
    //obter data e hora
    $data['atual'] = date('Y-m-d H:i:s');

    $data['online'] = strtotime($data['atual'] . " - 20 seconds");
	$data['online'] = date("Y-m-d H:i:s",$data['online']);
   
    if ((isset($_SESSION['visitante'])) AND (!empty($_SESSION['visitante']))) {
        $up_visita = "UPDATE visitas SET
		data_final = '" . $data['atual'] . "'
		WHERE id = '" . $_SESSION['visitante'] . "'";
        $conect = mysqli_query($mysqli,$up_visita);
    }else{
        //Salvar no banco de dados
		$result_visitas = "INSERT INTO visitas (data_inicio, data_final)VALUES ('".$data['atual']."', '".$data['atual']."')";
		
		$resultado_visitas = mysqli_query($mysqli, $result_visitas);
        //pega o utimo id inserido nobanco de dados e atribui a session['visitantes'] o valor do id
        $_SESSION['visitante'] = mysqli_insert_id($mysqli);
        
    }
   
}

