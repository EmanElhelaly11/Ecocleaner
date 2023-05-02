<?php
require_once('../config/database.php');
require_once('../classes/Achievement.php');


$achievement = new Achievement($pdo);
$achievements = $achievement->readAllAchievements();

if($achievements)
print_r($achievements);

?>