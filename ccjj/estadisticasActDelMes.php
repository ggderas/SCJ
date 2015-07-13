<?php

$e = array();
$e['label'] = 'Realizadas';
$e['value'] = '12';
$e['label'] = 'Pendientes';
$e['value'] = '6';
$e['label'] = 'Incumplidas';
$e['value'] = '2';
$result[] = $e;

//echo json_encode($result);
echo '[{label: "Realizadas",value: 12},{label: "Pendientes",value: 30}, {label: "Incumplidas",value: 20}]';

