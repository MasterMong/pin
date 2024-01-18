<fieldset data-async="">
    <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
        <div class="row">
            <h3> {{$areaData->inspection->name}} {{$areaData->type->name}} {{$areaData->name}}</h3>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="row py-1">
                    <div class="col-md-3">
                        <p class="text-end m-0 py-2">ชื่อโครงการ</p>
                    </div>
                    <div class="col-md-9"><input class="form-control" type="text" name="project_name"
                            placeholder="ระบุชื่อโครงการ" /></div>
                </div>
                <div class="row py-1">
                    <div class="col-md-3">
                        <p class="text-end m-0 py-2">รหัสโครงการ</p>
                    </div>
                    <div class="col-md-9"><input class="form-control" type="text" name="project_code"
                            placeholder="ระบุรหัสโครงการ" /></div>
                </div>
                <div class="row py-1">
                    <div class="col-md-3">
                        <p class="text-end m-0 py-2">วัตถุประสงค์โครงการ</p>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" name="project_objective"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-md-3">
                        <p class="text-end m-0 py-2">ตัวชี้วัดความสำเร็จ</p>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" name="project_indicator"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-md-3">
                        <p class="text-end m-0 py-2">ระยะเวลาตลอดโครงการ</p>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col">
                                <div class="input-group date" data-provide="datepicker">
                                    <span class="input-group-text">วันที่เริ่ม</span>
                                    <input type="text" class="form-control" name="project_start">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                {{-- <div class="input-group"><span class="input-group-text">วันที่เริ่ม</span><input class="form-control" type="date" placeholder="dd-mm-yyyy" name="project_start" /></div> --}}
                            </div>
                            <div class="col">
                                <div class="input-group date" data-provide="datepicker">
                                    <span class="input-group-text">วันสิ้นสุด</span>
                                    <input type="text" class="form-control" name="project_end">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-md-3">
                        <p class="text-end m-0 py-2">งบประมาณ</p>
                    </div>
                    <div class="col-md-9"><input class="form-control" type="text" name="project_budget"
                            placeholder="ระบุงบประมาณ" /></div>
                </div>
            </div>
            <div class="col-md-12">
                <h5>ความสอดคล้อง</h5>
                <hr />
                @foreach ($relates as $ri => $relate)
                    <div>
                        <span>{{ $ri + 1 }}. {{ $relate->label }}</span>
                        @foreach ($relate->types as $rti => $type)
                            <div class="row" x-data="{ {{ $type->name }}: '{{ $type->items[0]->ref }}' }">
                                <div class="text-end col-3 py-2"><span>{{ $type->label }}</span></div>
                                <div class="col-9">
                                    <select class="form-select" x-model="{{ $type->name }}"
                                        name="relate_type[{{ $type->name }}]">
                                        @foreach ($type->items as $i => $item)
                                            <option value="{{ $item->ref }}" {{ $i == 1 ? ' selcted' : '' }}>
                                                {{ $item->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @isset($relate_sub_group[$type->name]->items)
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9 py-2">
                                        @foreach ($relate_sub_group[$type->name]->items as $item)
                                            <template x-if="{{ $type->name }} == '{{ $item->parent_item_ref }}'">
                                                <div class="form-check">
                                                    <input id="formCheck-{{ $item->ref }}" class="form-check-input"
                                                        name="relate_item[{{ $item->parent_item_ref }}][items][{{ $item->ref }}]"
                                                        type="checkbox" />
                                                    <div class="form-check-label" for="formCheck-{{ $item->ref }}">
                                                        {{ $item->label }}</div>
                                                </div>
                                            </template>
                                        @endforeach
                                    </div>
                                @endisset
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <input type="hidden" name="count_relate" value="{{count($relate_sub_group)}}">
        </div>
    </div>
</fieldset>
