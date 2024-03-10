<?php

return [

    'label' => 'การนำทางการแบ่งหน้า',

    'overview' => '{1} Showing 1 result|[2,*] Showing :first to :last of :total results',

    'fields' => [

        'records_per_page' => [

            'label' => 'จำนวนต่อหน้า',

            'options' => [
                'all' => 'ทั้งหมด',
            ],

        ],

    ],

    'actions' => [

        'first' => [
            'label' => 'ลำดับแรก',
        ],

        'go_to_page' => [
            'label' => 'ไปที่หน้า:หน้า',
        ],

        'last' => [
            'label' => 'ลำดับสุดท้าย',
        ],

        'next' => [
            'label' => 'ถัดไป',
        ],

        'previous' => [
            'label' => 'ก่อนหน้า',
        ],

    ],

];
