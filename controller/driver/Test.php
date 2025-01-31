<?php

global $routes;
require '../../routes.php';


require_once __DIR__ . '/../../model/CalculationRepo.php';
require_once __DIR__ . '/../../view/Data_Provider.php';


@session_start();


echo '<br><h1><center>'.'Welcome to Testing Page. Here we test different functionalities with static values'.'</center></h1><br>';



echo '<br>'.'Driver NAME = '.getDriverName(4).'<br>';
echo '<br>'.'Generated TOKEN = '.generateToken("Rampura", "Uttara").'<br>';
echo '<br>'.'Current Date-Time = '.date("Y-m-d H:i:s").'<br>';
//echo '<br>All TOKENS = <pre>';
//print_r(findAllTokensByUser_id(1));
//echo '</pre><br>';
echo '<br>'.'Next Trip TOKEN = '.getNextToken(1).'<br>';
echo '<br>'.'Previous Trip TOKEN = '.getPreviousToken(1)['token'].'<br>';

