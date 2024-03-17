<?php

return [

    'title' => 'ลงทะเบียน',

    'heading' => 'สมัครสมาชิก',

    'actions' => [

        'login' => [
            'before' => 'หรือ',
            'label' => 'เข้าสู่ระบบ',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'ที่อยู่ Email',
        ],

        'name' => [
            'label' => 'ชื่อ',
        ],

        'password' => [
            'label' => 'รหัสผ่าน',
            'validation_attribute' => 'password',
        ],

        'password_confirmation' => [
            'label' => 'ยืนยันรหัสผ่าน',
        ],

        'actions' => [

            'register' => [
                'label' => 'สมัครสมาชิก',
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'ลงทะเบียนบ่อยครั้งเกินไป',
            'body' => 'ลองใหม่อีกครั้งใน :seconds วินาที.',
        ],

    ],

];
