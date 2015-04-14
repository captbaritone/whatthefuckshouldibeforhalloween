<?php

require_once('SuggestionGenerator.php');

$count = isset($_GET['count']) ? (int)$_GET['count'] : 1;

// Some limitaitons
if($count > 50) die("Please request fewer than 50 suggestions");

$generator = new SuggestionGenerator();

$suggestions = array();
for ($i = 0; $i < $count; $i++) {
    if(isset($_GET['clean']))
    {
        $suggestion[] = $generator->getCleanSuggestion();
    }
    else
    {
        $suggestion[] = $generator->getSuggestion();
    }
}

echo json_encode($suggestion);
