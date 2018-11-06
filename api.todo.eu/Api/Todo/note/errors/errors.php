<?php

echo \Helpers\Helper::success(
    $data = [],
    [
        'status'            => 'Not held',
        'success'           => false,
        'update time'       => date('l jS \of F Y h:i:s A'),
        'provider'          => 'api.todo.eu',
        'message'           => 'Something went wrong. Unable to complete transaction.'
    ]
);
