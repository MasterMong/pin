<?php

namespace App\Http\Controllers;

use App\Models\RelateGroup;
use App\Models\RelateItem;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public static function getProjectActivityFormInput($form): Form
    {
        $relate_groups = RelateGroup::with([
            'relateTypes' => function ($q) {
                $q->with([
                    'relateItems' => function ($qi) {
                        $qi->orderBy('order');
                    }
                ]);
            }
        ])
            ->where('budget_year_id', SettingController::getSetting('budget_year'))
            ->get()
            ->toArray();
//        $relate_form = [];
        foreach ($relate_groups as $relate_group) {
            $relate_form[] = Fieldset::make()
                ->label($relate_group['label'])
                ->schema(
                    function () use ($relate_group) {
                        $select_lists = [];
                        foreach ($relate_group['relate_types'] as $type) {
                            // dd($type);
                            $select_lists[] = Select::make($type['name'])
                                ->options(function () use ($type) {
                                    $items = RelateItem::where('relate_type_id', $type['id'])->orderBy('order')->get();
                                    return $items->pluck('label', 'id');
                                })
                                ->multiple($type['is_single'] === False)
                                ->label($type['label'])
                                ->required(False)
                                ->columnSpanFull();
                        }
                        return $select_lists;
                    }
                );
        }
//        dd($relate_form);
        return $form
            ->schema(
                [
                    Section::make(
                        [
                            Hidden::make('area_id'),
                            Hidden::make('budget_year_id'),
                            TextInput::make('name')
                                ->label('ชื่อกิจกรรม/ผลงานการขับเคลื่อนนโยบายสู่การปฏิบัติ')
                                ->required()
                                ->maxLength(300),
                            Repeater::make('relate_items')
                                ->reorderable(False)
                                // ->addable(False)
                                ->schema($relate_form)
                                ->deletable(False)
                                ->minItems(1)
                                ->maxItems(1)
                                ->columnSpanFull()
                                ->label('ความสอดคล้อง'),
                            Select::make('area_strategy_id')
                                ->relationship('areaStrategy', 'detail', fn(Builder $query) => $query->where('area_id', auth()->user()->area_id)
                                    ->where('budget_year_id', SettingController::getSetting('budget_year'))
                                    ->whereNull('deleted_at')
                                )
                                ->label('กลยุทธ์ สพท.')
                                ->required(),
                            Toggle::make('is_pa_of_manager')
                                ->label('ประเด็นท้าทาย (PA) ของผู้บริหาร')
                                ->required(),
                            Fieldset::make()->schema([
                                Group::make([
                                    DatePicker::make('date_start')
                                        ->native(false)
                                        ->displayFormat('d-m-Y')
                                        ->required()
                                        ->label('วันเริ่มกิจกรรม'),
                                    DatePicker::make('date_end')
                                        ->native(false)
                                        ->displayFormat('d-m-Y')
                                        ->required()
                                        ->label('วันสิ้นสุดกิจกรรม')
                                ]),
                                Group::make()->schema([
                                    Toggle::make('q1')->label('ไตรมาส 1'),
                                    Toggle::make('q2')->label('ไตรมาส 2'),
                                    Toggle::make('q3')->label('ไตรมาส 3'),
                                    Toggle::make('q4')->label('ไตรมาส 4'),
                                ])->columns(1),
                            ])->columns(2)->label('ระยะเวลาดำเนินกิจกรรม'),
                            Textarea::make('objective')->label('วัตถุประสงต์')->required(),
                            RichEditor::make('process')
                                ->toolbarButtons(['blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'underline', 'undo'])
                                ->label('การดำเนินงาน'),
                            Textarea::make('target_area')->label('สถานที่ดำเนินการ'),
                            Repeater::make('beneficiary')->schema([
                                Fieldset::make()->schema([
                                    TextInput::make('people')->label('กลุ่มผู้ได้รับประโยชน์'),
                                    TextInput::make('count')->label('จำนวน (คน/แห่ง)')->numeric(),
                                ])->label('เชิงปริมาณ'),
                                Fieldset::make()->schema([
                                    Textarea::make('qualitative')->label('เชิงคุณภาพ')
                                        ->columnSpanFull()
                                ])->label('เชิงคุณภาพ')
                            ])->label('ผลการดำเนินงาน')->minItems(1),
                            Textarea::make('problem')
                                ->label('ปัญหาอุปสรรค'),
                            Textarea::make('suggestions')
                                ->label('ข้อเสนอแนะ'),
                            FileUpload::make('galleries')
                                ->label('ภาพกิจกรรม')
                                ->multiple()
                                ->image()
                                ->downloadable()
                                ->previewable()
                                ->imageEditor()
                                ->required()
                                ->multiple(),
                            TextInput::make('ถ้ามี')->label('ลิงก์วิดีโอ (ถ้ามี)'),
                            Fieldset::make()->schema([
                                Toggle::make('is_success')->label('เป็นไปตามแผน')
                            ])->label('ประเมินตนเอง')
                        ]
                    )
                ]
            );
    }
}
