<?php
include("config/config.php");

// create a LoopController
$loopController = new LoopController();
// take the right route for given user input
$loopController->route();
?>