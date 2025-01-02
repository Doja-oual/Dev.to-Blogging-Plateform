<?php

require_once '../config/database.php';
require_once '../routes/web.php';

$path = $_GET['path'] ?? 'home'; 
route($path);
