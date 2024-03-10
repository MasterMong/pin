<?php

return [

    'column_toggle' => [

        'heading' => 'คอลัมน์',

    ],

    'columns' => [

        'text' => [

            'actions' => [
                'collapse_list' => 'แสดงน้อยลง',
                'expand_list' => 'แสดงมากขึ้น',
            ],

            'more_list_items' => 'and :count more',

        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'เลือก/ยกเลิกการเลือกรายการทั้งหมดสำหรับการดำเนินการแบบกลุ่ม',
        ],

        'bulk_select_record' => [
            'label' => 'เลือก/ยกเลิกการเลือกรายการกุญแจสำหรับการดำเนินการแบบกลุ่ม',
        ],

        'bulk_select_group' => [
            'label' => 'เลือก/ยกเลิกการเลือกรายการหัวข้อสำหรับการดำเนินการแบบกลุ่ม',
        ],

        'search' => [
            'label' => 'ค้นหา',
            'placeholder' => 'ค้นหา',
            'indicator' => 'ค้นหา',
        ],

    ],

    'summary' => [

        'heading' => 'สรุป',

        'subheadings' => [
            'all' => 'All :label',
            'group' => ':กลุ่ม สรุป',
            'page' => 'หน้านี้',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'เฉลี่ย',
            ],

            'count' => [
                'label' => 'นับ',
            ],

            'sum' => [
                'label' => 'รวม',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'เสร็จสิ้นการเรียงลำดับบันทึกใหม่',
        ],

        'enable_reordering' => [
            'label' => 'จัดลำดับบันทึกใหม่',
        ],

        'filter' => [
            'label' => 'ตัวกรอง',
        ],

        'group' => [
            'label' => 'กลุ่ม',
        ],

        'open_bulk_actions' => [
            'label' => 'การดำเนินการเป็นกลุ่ม',
        ],

        'toggle_columns' => [
            'label' => 'สลับคอลัมน์',
        ],

    ],

    'empty' => [

        'heading' => 'ไม่มีข้อมูลที่จะแสดง',

        'description' => 'เพิ่มข้อมูลเพื่อเริ่มต้น',

    ],

    'filters' => [

        'actions' => [

            'apply' => [
                'label' => 'ใช้ตัวกรอง',
            ],

            'remove' => [
                'label' => 'ลบตัวกรอง',
            ],

            'remove_all' => [
                'label' => 'ลบตัวกรองทั้งหมด',
                'tooltip' => 'ลบตัวกรองทั้งหมด',
            ],

            'reset' => [
                'label' => 'รีเซ็ต',
            ],

        ],

        'heading' => 'ตัวกรอง',

        'indicator' => 'ตัวกรองที่ใช้งานอยู่',

        'multi_select' => [
            'placeholder' => 'ทั้งหมด',
        ],

        'select' => [
            'placeholder' => 'ทั้งหมด',
        ],

        'trashed' => [

            'label' => 'บันทึกที่ถูกลบ',

            'only_trashed' => 'เฉพาะบันทึกที่ถูกลบ',

            'with_trashed' => 'รวมบันทึกที่ถูกลบ',

            'without_trashed' => 'ไม่รวมบันทึกที่ถูกลบ',

        ],

    ],

    'grouping' => [

        'fields' => [

            'group' => [
                'label' => 'จัดกลุ่มตาม',
                'placeholder' => 'จัดกลุ่มตาม',
            ],

            'direction' => [

                'label' => 'ทิศทางของกลุ่ม',

                'options' => [
                    'asc' => 'จากน้อยไปมาก',
                    'desc' => 'จากมากไปน้อย',
                ],

            ],

        ],

    ],

    'reorder_indicator' => 'ลากและวางบันทึกตามลำดับ',

    'selection_indicator' => [

        'selected_count' => '1 record selected|:count records selected',

        'actions' => [

            'select_all' => [
                'label' => 'เลือกทั้งหมด',
            ],

            'deselect_all' => [
                'label' => 'ยกเลิกการเลือกทั้งหมด',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'เรียงตาม',
            ],

            'direction' => [

                'label' => 'ทิศทางการจัดเรียง',

                'options' => [
                    'asc' => 'จากน้อยไปมาก',
                    'desc' => 'จากมากไปน้อย',
                ],

            ],

        ],

    ],

];
