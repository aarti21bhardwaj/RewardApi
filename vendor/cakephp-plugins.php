<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'ADmad/JwtAuth' => $baseDir . '/vendor/admad/cakephp-jwt-auth/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Integrateideas/Invoice' => $baseDir . '/vendor/integrateideas/invoice/',
        'Josegonzalez/Upload' => $baseDir . '/vendor/josegonzalez/cakephp-upload/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Muffin/Trash' => $baseDir . '/vendor/muffin/trash/',
        'Integrateideas/Peoplehub' => $baseDir . '/vendor/integrateideas/peoplehub/'
    ]
];