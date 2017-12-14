<?php

echo "Add indexes to xhprof ...  \n";
// waiting for mongodb
sleep(5);

$instance = new \MongoDB\Driver\Manager('mongodb://mongodb:27017');

$command = new \MongoDB\Driver\Command([
    'createIndexes' => 'results',
    'indexes' => [
        [
            'name' => 'meta.SERVER.REQUEST_TIME',
            'key' => ['meta.SERVER.REQUEST_TIME' => -1]
        ],
        [
            'name' => 'profile.main().wt',
            'key' => ['profile.main().wt' => -1]
        ],
        [
            'name' => 'profile.main().mu',
            'key' => ['profile.main().mu' => -1]
        ],
        [
            'name' => 'profile.main().cpu',
            'key' => ['profile.main().cpu' => -1]
        ],
        [
            'name' => 'meta.url',
            'key' => ['meta.url' => -1]
        ],
        [
            'name' => 'meta.simple_url',
            'key' => ['meta.simple_url' => -1]
        ],

    ]
]);
$instance->executeCommand('xhprof', $command);

var_dump($instance);