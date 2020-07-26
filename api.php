<?php

include_once 'Graph.php';

$graph = new Graph(true);
$graph->addTerminal("A","", 0, 0);
$graph->addTerminal("B","", 0, 0);
$graph->addTerminal("C","", 0, 0);
$graph->addTerminal("D","", 0, 0);
$graph->addTerminal("E","", 0, 0);
$graph->addTerminal("F","", 0, 0);
$graph->addTerminal("G","", 0, 0);
$graph->addTerminal("H","", 0, 0);
$graph->addTerminal("I","", 0, 0);
// $graph->addTerminal("J","", 0, 0);

$graph->addJalur("A","B",29);
$graph->addJalur("A","D",34);
$graph->addJalur("B","C",32);
$graph->addJalur("C","D",36);
$graph->addJalur("C","F",42);
$graph->addJalur("D","E",35);
$graph->addJalur("D","G",34);
$graph->addJalur("E","H",37);
$graph->addJalur("F","G",29);
$graph->addJalur("F","I",36);
$graph->addJalur("G","H",29);
$graph->addJalur("H","I",36);

// $graph->addJalur("A","B",5);
// $graph->addJalur("A","C",3);
// $graph->addJalur("A","D",10);
// $graph->addJalur("B","E",9);
// $graph->addJalur("C","D",18);
// $graph->addJalur("C","F",4);
// $graph->addJalur("C","G",30);
// $graph->addJalur("D","G",16);
// $graph->addJalur("E","F",10);
// $graph->addJalur("E","H",7);
// $graph->addJalur("F","H",12);
// $graph->addJalur("F","I",27);
// $graph->addJalur("G","I",5);
// $graph->addJalur("H","I",6);
// $graph->addJalur("H","J",2);
// $graph->addJalur("I","J",11);

echo $graph->TabuSearch("A","I");