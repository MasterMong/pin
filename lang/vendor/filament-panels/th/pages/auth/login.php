<?php

return [

    'title' => 'เข้าสู่ระบบ',

    'heading' => 'เข้าสู่ระบบ',

    'actions' => [

        'register' => [
            'before' => 'หรือ',
            'label' => 'ลงทะเบียนสมาชิก',
        ],

        'request_password_reset' => [
            'label' => 'ลืมรหัสผ่าน?',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'ที่อยู่ Email',
        ],

        'password' => [
            'label' => 'รหัสผ่าน',
        ],

        'remember' => [
            'label' => 'บันทึกการเข้าสู่ระบบครั้งนี้',
        ],

        'actions' => [

            'authenticate' => [
                'label' => 'เข้าสู่ระบบ',
            ],

        ],

    ],

    'messages' => [

        'failed' => 'ไม่พบผุ้ใช้งาน',

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'คุณเข้าสุ่ระบบผิดบ่อยครั้งเกินไป',
            'body' => 'ลองอีกครั้งภายหลังใน :seconds วินาที',
        ],

    ],

];
