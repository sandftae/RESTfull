<?php

echo \Helpers\Helper::success(
    $data,
    [
        'status'            => 'Options',
        'removal time'      => date('l jS \of F Y h:i:s A'),
        'provider'          => 'api.todo.eu'
    ]
);
