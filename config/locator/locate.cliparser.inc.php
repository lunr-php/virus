<?php

$recipe = [];

$recipe['cliparser'] = [];

$recipe['cliparser']['name'] = 'Lunr\Shadow\GetoptCliParser';

$recipe['cliparser']['params'] = [ 'c:m:p:', [ 'controller:', 'method:', 'param:', 'post:', 'get:', 'cookie:' ] ];

$recipe['cliparser']['singleton'] = TRUE;

?>
