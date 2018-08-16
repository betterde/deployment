<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Deployment route prefix uri
    |--------------------------------------------------------------------------
    |
    | This is the name of the Redis connection where Horizon will store the
    | meta information required for it to function. It includes the list
    | of supervisors, failed jobs, job metrics, and other information.
    |
    */
    'uri' => 'deployment',
    'enable' => true,
    'token' => env('DEPLOYMENT_TOKEN', false),
    'evnents' => [
        'push' => 'Push Hook',
        'tag' => 'Tag Push Hook',
        'issue' => 'Issue Hook'
    ]
];
