<?php

return [
    'languages' => [
        ['id' => 0, 'dbName' => 'tm', 'flagName' => 'tkm', 'fullName' => 'Türkmen', 'langName' => 'Türkmençe'],
        ['id' => 1, 'dbName' => 'en', 'flagName' => 'eng', 'fullName' => 'English', 'langName' => 'English'],
    ],
    'orderStatuses' => [
        ['id' => 0, 'color' => 'warning', 'name' => 'pending'],
        ['id' => 1, 'color' => 'info', 'name' => 'accepted'],
        ['id' => 2, 'color' => 'primary', 'name' => 'sent'],
        ['id' => 3, 'color' => 'success', 'name' => 'completed'],
        ['id' => 4, 'color' => 'danger', 'name' => 'canceled'],
    ],
    'orderPlatforms' => [
        ['id' => 0, 'name' => 'Web'],
        ['id' => 1, 'name' => 'Android'],
        ['id' => 2, 'name' => 'iOS'],
    ],
    'orderPayments' => [
        ['id' => 0, 'type' => 'cash', 'name' => 'cashPayment'],
        ['id' => 1, 'type' => 'terminal', 'name' => 'terminalPayment'],
        ['id' => 2, 'type' => 'online', 'name' => 'onlinePayment'],
    ],
    'ordering' => [
        'a' => ['nameAsc', 'nameDesc', 'priceLow', 'priceHigh', 'newest', 'oldest'],
        'b' => [
            'nameAsc' => ['name_tm', 'asc'],
            'nameDesc' => ['name_tm', 'desc'],
            'priceLow' => ['price', 'asc'],
            'priceHigh' => ['price', 'desc'],
            'oldest' => ['created_at', 'asc'],
            'newest' => ['created_at', 'desc'],
        ]
    ]
];
