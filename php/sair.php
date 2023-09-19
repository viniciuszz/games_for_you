<?php
//verifica se não a uma session
if(!isset($_SESSION)){
    session_start();
}
//destroi todas as sessions
session_destroy();
//redireciona o usuario até a home
header("Location: ../html/index.php");
?>