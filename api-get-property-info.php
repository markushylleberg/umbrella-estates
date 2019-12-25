<?php

$sPropertyId = substr($_GET['id'], 9 );
$sAgentId = $_GET['agent'];

// echo $sPropertyId;
// echo $sAgentId;

$sjData = file_get_contents('data.json');
$jData = json_decode($sjData);

$data = $jData->agents->$sAgentId->properties->$sPropertyId;

echo json_encode($data);
