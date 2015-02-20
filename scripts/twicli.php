<?php

use TwiCli\TwiCli;

require_once(__DIR__ . '/../bootstrap.php');

$twiCli = new TwiCli();

do {
    echo '> ';
    $input = trim(fgets(STDIN));
    $twiCli->process($input);
} while ($input != 'quit');
