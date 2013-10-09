<?php

$recipe = [];

$recipe['facebookauth'] = [];

$recipe['facebookauth']['name'] = 'Lunr\Spark\Facebook\Authentication';

$recipe['facebookauth']['params'] = [ 'cas', 'logger', 'curl', 'request' ];

$recipe['facebookauth']['singleton'] = TRUE;

?>
