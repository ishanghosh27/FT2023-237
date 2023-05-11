<?php

require_once('nav.php');
require_once('class/DataInsert.php');

$display = new DataInsert();
$display->displayFormData();
$display->displayQueryData();
