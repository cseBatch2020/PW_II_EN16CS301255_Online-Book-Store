<?php

require_once("recommend.php");
require_once("sample_list.php");
$re = new Recommend();
$R=$re->getRecommendations($data_book, "test1");

print_r($R);

?>