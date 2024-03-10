<?php

return [

    'builder' => [

        'actions' => [

            'clone' => [
                'label' => 'โคลน',
            ],

            'add' => [
                'label' => 'เพิ่มไปที่ :label',
            ],

            'add_between' => [
                'label' => 'แทรกระหว่างบล็อก',
            ],

            'delete' => [
                'label' => 'ลบ',
            ],

            'reorder' => [
                'label' => 'ย้าย',
            ],

            'move_down' => [
                'label' => 'ย้ายลง',
            ],

            'move_up' => [
                'label' => 'ย้ายขึ้น',
            ],

            'collapse' => [
                'label' => 'ยุบ',
            ],

            'expand' => [
                'label' => 'ขยาย',
            ],

            'collapse_all' => [
                'label' => 'ยุบทั้งหมด',
            ],

            'expand_all' => [
                'label' => 'ขยายทั้งหมด',
            ],

        ],

    ],

    'checkbox_list' => [

        'actions' => [

            'deselect_all' => [
                'label' => 'ยกเลิกการเลือกทั้งหมด',
            ],

            'select_all' => [
                'label' => 'เลือกทั้งหมด',
            ],

        ],

    ],

    'file_upload' => [

        'editor' => [

            'actions' => [

                'cancel' => [
                    'label' => 'ยกเลิก',
                ],

                'drag_crop' => [
                    'label' => 'โหมดลาก "ตัด"',
                ],

                'drag_move' => [
                    'label' => 'โหมดลาก "ย้าย"',
                ],

                'flip_horizontal' => [
                    'label' => 'พลิกภาพในแนวนอน',
                ],

                'flip_vertical' => [
                    'label' => 'พลิกภาพในแนวตั้ง',
                ],

                'move_down' => [
                    'label' => 'ย้ายภาพลง',
                ],

                'move_left' => [
                    'label' => 'ย้ายภาพไปทางซ้าย',
                ],

                'move_right' => [
                    'label' => 'ย้ายภาพไปทางขวา',
                ],

                'move_up' => [
                    'label' => 'ย้ายภาพขึ้น',
                ],

                'reset' => [
                    'label' => 'รีเซ็ต',
                ],

                'rotate_left' => [
                    'label' => 'หมุนภาพไปทางซ้าย',
                ],

                'rotate_right' => [
                    'label' => 'หมุนภาพไปทางขวา',
                ],

                'set_aspect_ratio' => [
                    'label' => 'ตั้งค่าอัตราส่วนภาพเป็น:อัตราส่วน',
                ],

                'save' => [
                    'label' => 'บันทึก',
                ],

                'zoom_100' => [
                    'label' => 'ขยายภาพ 100%',
                ],

                'zoom_in' => [
                    'label' => 'ขยายภาพ',
                ],

                'zoom_out' => [
                    'label' => 'ย่อภาพ',
                ],

            ],

            'fields' => [

                'height' => [
                    'label' => 'ความสูง',
                    'unit' => 'px',
                ],

                'rotation' => [
                    'label' => 'การหมุน',
                    'unit' => 'องศา',
                ],

                'width' => [
                    'label' => 'ความกว้าง',
                    'unit' => 'px',
                ],

                'x_position' => [
                    'label' => 'X',
                    'unit' => 'px',
                ],

                'y_position' => [
                    'label' => 'Y',
                    'unit' => 'px',
                ],

            ],

            'aspect_ratios' => [

                'label' => 'อัตราส่วนภาพ',

                'no_fixed' => [
                    'label' => 'อิสระ',
                ],

            ],

            'svg' => [

                'messages' => [
                    'confirmation' => 'Editing SVG files is not recommended as it can result in quality loss when scaling.\n Are you sure you want to continue?',
                    'disabled' => 'Editing SVG files is disabled as it can result in quality loss when scaling.',
                ],

            ],

        ],

    ],

    'key_value' => [

        'actions' => [

            'add' => [
                'label' => 'เพิ่มแถว',
            ],

            'delete' => [
                'label' => 'ลบแถว',
            ],

            'reorder' => [
                'label' => 'เรียงลำดับแถวใหม่',
            ],

        ],

        'fields' => [

            'key' => [
                'label' => 'คีย์',
            ],

            'value' => [
                'label' => 'ค่า',
            ],

        ],

    ],

    'markdown_editor' => [

        'toolbar_buttons' => [
            'attach_files' => 'แนบไฟล์',
            'blockquote' => 'บล็อกคำพูด',
            'bold' => 'ตัวหนา',
            'bullet_list' => 'รายการหัวข้อย่อย',
            'code_block' => 'บล็อกโค๊ด',
            'heading' => 'หัวเรื่อง',
            'italic' => 'ตัวเอียง',
            'link' => 'ลิงค์',
            'ordered_list' => 'ลำดับตัวเลข',
            'redo' => 'ทำซ้ำ',
            'strike' => 'ขีดทับ',
            'table' => 'ตาราง',
            'undo' => 'เลิกทำ',
        ],

    ],

    'radio' => [

        'boolean' => [
            'true' => 'ใช่',
            'false' => 'ไม่ใช่',
        ],

    ],

    'repeater' => [

        'actions' => [

            'add' => [
                'label' => 'เพิ่มไปที่ :label',
            ],

            'add_between' => [
                'label' => 'แทรกระหว่าง',
            ],

            'delete' => [
                'label' => 'ลบ',
            ],

            'clone' => [
                'label' => 'โคลน',
            ],

            'reorder' => [
                'label' => 'ย้าย',
            ],

            'move_down' => [
                'label' => 'ย้ายลง',
            ],

            'move_up' => [
                'label' => 'ย้ายขึ้น',
            ],

            'collapse' => [
                'label' => 'ยุบ',
            ],

            'expand' => [
                'label' => 'ขยาย',
            ],

            'collapse_all' => [
                'label' => 'ยุบทั้งหมด',
            ],

            'expand_all' => [
                'label' => 'ขยายทั้งหมด',
            ],

        ],

    ],

    'rich_editor' => [

        'dialogs' => [

            'link' => [

                'actions' => [
                    'link' => 'ลิ้งค์',
                    'unlink' => 'ยกเลิกลิ้งค์',
                ],

                'label' => 'URL',

                'placeholder' => 'Enter a URL',

            ],

        ],

        'toolbar_buttons' => [
            'attach_files' => 'แนบไฟล์',
            'blockquote' => 'บล็อกคำพูด',
            'bold' => 'ตัวหนา',
            'bullet_list' => 'รายการหัวข้อย่อย',
            'code_block' => 'บล็อกโค๊ด',
            'h1' => 'หัวข้อ',
            'h2' => 'หัวเรื่อง',
            'h3' => 'หัวเรื่องย่อย',
            'italic' => 'ตัวเอียง',
            'link' => 'ลิงค์',
            'ordered_list' => 'ลำดับตัวเลข',
            'redo' => 'ทำซ้ำ',
            'strike' => 'ขีดทับ',
            'underline' => 'ขีดเส้นใต้',
            'undo' => 'เลิกทำ',
        ],

    ],

    'select' => [

        'actions' => [

            'create_option' => [

                'modal' => [

                    'heading' => 'เพิ่ม',

                    'actions' => [

                        'create' => [
                            'label' => 'เพิ่ม',
                        ],

                        'create_another' => [
                            'label' => 'บันทึกและเพิ่มอีก',
                        ],

                    ],

                ],

            ],

            'edit_option' => [

                'modal' => [

                    'heading' => 'แก้ไข',

                    'actions' => [

                        'save' => [
                            'label' => 'บันทึก',
                        ],

                    ],

                ],

            ],

        ],

        'boolean' => [
            'true' => 'ใช่',
            'false' => 'ไม่ใช่',
        ],

        'loading_message' => 'กำลังโหลด...',

        'max_items_message' => 'Only :count can be selected.',

        'no_search_results_message' => 'ไม่มีตัวเลือกที่ตรงกับการค้นหาของคุณ',

        'placeholder' => 'เลือกตัวเลือก',

        'searching_message' => 'ค้นหา...',

        'search_prompt' => 'เริ่มพิมพ์เพื่อค้นหา...',

    ],

    'tags_input' => [
        'placeholder' => 'New tag',
    ],

    'text_input' => [

        'actions' => [

            'hide_password' => [
                'label' => 'ซ่อนรหัสผ่าน',
            ],

            'show_password' => [
                'label' => 'แสดงรหัสผ่าน',
            ],

        ],

    ],

    'toggle_buttons' => [

        'boolean' => [
            'true' => 'ใช่',
            'false' => 'ไม่ใช่',
        ],

    ],

    'wizard' => [

        'actions' => [

            'previous_step' => [
                'label' => 'ย้อนกลับ',
            ],

            'next_step' => [
                'label' => 'ถัดไป',
            ],

        ],

    ],

];
