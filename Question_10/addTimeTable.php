<?php

$day = $_GET["day"];
$start = $_GET["start"];
$end = $_GET["end"];
$teach = $_GET["teach"];
$module = $_GET["module"];
$salle = $_GET["salle"];

$dom = new DOMDocument();
$dom->load("question_2.xml");

$seance = $dom->createElement('seance');

$seance->setAttribute('day', $day);
$seance->setAttribute('start', $start);
$seance->setAttribute('end', $end);
$seance->setAttribute('teacher', $teach);
$seance->setAttribute('module', $module);
$seance->setAttribute('salle', $salle);

$dom->documentElement->appendChild($seance);
$dom->save('question_2.xml');
