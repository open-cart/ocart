<?php

use Ocart\Core\Enums\BaseStatusEnum;

return [
    'statuses' => [
        BaseStatusEnum::DRAFT     => 'Draft',
        BaseStatusEnum::PENDING   => 'Pending',
        BaseStatusEnum::PUBLISHED => 'Published',
    ]
];
