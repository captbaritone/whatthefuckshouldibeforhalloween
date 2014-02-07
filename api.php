<?php

require_once('SuggestionGenerator.php');

$generator = new SuggestionGenerator();

$suggestion = $generator->getSuggestion();

$request = substr( $_SERVER['REQUEST_URI'],1 );
$params = explode( "/", $request );

if(isset($params[1]) && $params[1] == 'clean')
{
    foreach ($suggestion as $key => $value) {
        $suggestion->$key = str_ireplace('fuck', 'f**k', $value);
    }
}

echo json_encode($suggestion);
