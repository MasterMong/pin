<fieldset data-async=""
    x-data='
    {
        "inspections" : {{ $inspections }},
        "areas": {{ $areas }},
        "areaData" : {{ $areaData }},
        "inspection_id" : {{ $inspection_id }},
        "area_id" : {{ $areaData->id }},
    }
    '>
    <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
        <div class="row px-2">
            {{-- #todo lock when change inspection and reload areas --}}
            <div class="col-md-6 px-1">
                <div class="input-group">
                    <select class="form-select bg-white" x-model="inspection_id" name="inspection_id">
                        <template x-for="i in inspections">
                            <option :value="i.id" :selected="i.id == inspection_id" x-html="i.name"></option>
                        </template>
                    </select>
                    <button data-controller="button" data-turbo="true" class="btn btn-primary" type="submit"
                        form="post-form" formaction="{{ route('startegy.contex.form') }}/getArea"
                        x-show="inspection_id !== areaData.inspection_id">
                        <span>ตกลง</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 px-1">
                <div class="input-group">
                    <select class="form-select bg-white" name="area_id"
                        :disabled="inspection_id !== areaData.inspection_id">
                        <template x-for="i in areas">
                            <option :value="i.id" :selected="i.id == area_id" x-html="i.name"></option>
                        </template>
                    </select>
                    <button data-controller="button" data-turbo="true" class="btn btn-primary" type="submit"
                        form="post-form" formaction="{{ route('startegy.contex.form') }}/getArea"
                        x-show="inspection_id == areaData.inspection_id">
                        <span>ตกลง</span>
                    </button>
                    {{-- <span class="btn btn-primary">ตกลง</span> --}}
                </div>
            </div>
        </div>
        <hr>
        <div>
            <div class="row py-1">
                <div class="col-md-2">
                    <p class="text-end m-0 py-2">วิสัยทัศน์</p>
                </div>
                <div class="col-md-10"><input class="form-control" type="text" name="vision"
                        placeholder="ระบุวิสัยทัศน์" required value="{{ $vision }}" /></div>
            </div>
            <div class="row py-1">
                <div class="col-md-2">
                    <p class="text-end m-0 py-2">พันธกิจ</p>
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" rows="6" placeholder="ระบุพันธกิจ" name="mission" required>{{ $mission }}</textarea>
                </div>
            </div>
            @php($count_goal = count($goals))
            @foreach ($goals as $i_goal => $goal)
                <div class="row py-1">
                    <div class="col-md-2">
                        <p class="text-end m-0 py-2">เป้าประสงค์ {{ $i_goal + 1 }}</p>
                    </div>
                    <div class="col-md-10">
                        <div class="col-12">
                            <div class="input-group"><input class="form-control" type="text"
                                    name="goal[{{ $i_goal }}]['detail']" placeholder="ระบุเป้าประสงค์"
                                    style="display: inline-block !important;" required
                                    value="{{ $goal['detail'] }}" /><button class="btn btn-info btn-sm"
                                    type="button"><span> เพิ่มเป้าประสงค์</span></button>
                            </div>
                        </div>
                        @php($count_startegy = count($goal['startegy']))
                        @foreach ($goal['startegy'] as $i_startegy => $startegy)
                            <div class="row py-1">
                                <div class="col-md-2 pt-2 text-center"><span>กลยุทธ์ {{ $i_startegy + 1 }}</span></div>
                                <div class="col-md-10">
                                    <div class="input-group"><input class="form-control" type="text"
                                            placeholder="รายละเอียดกลยุทธ์"
                                            name="goal[{{ $i_goal }}]['startegy'][{{ $i_startegy }}]['detail']"
                                            required value="{{ $startegy['detail'] }}" /><button class="btn btn-info"
                                            type="button">เพิ่ม</button><button class="btn btn-primary"
                                            type="button">ลบ</button></div>
                                </div>
                                @php($count_target = count($startegy['target']))
                                @foreach ($startegy['target'] as $i_target => $target)
                                    <div class="col-12 py-1">
                                        <div class="row">
                                            <div class="col-md-1 text-center px-md-1">
                                                <div style="padding: 12px;"></div>
                                                <div class="py-2"><span id="noLabel"
                                                        class="d-md-none">เป้าหมายที่ </span><span
                                                        id="no">{{ $i_startegy + 1 }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5 px-md-1">
                                                <div class="text-md-center"><span class=".target_target">เป้าหมาย</span>
                                                </div>
                                                <input class="form-control" type="text" placeholder="ระบุเป้าหมาย"
                                                    name="goal[{{ $i_goal }}]['startegy'][{{ $i_startegy }}]['target'][0]['name']"
                                                    value="{{ $target['name'] }}" required />
                                            </div>
                                            <div class="col-md-2 px-md-1">
                                                <div class="text-md-center"><span
                                                        class="target_pointer">ตัวชี้วัด</span>
                                                </div>
                                                <input class="form-control text-center" type="text"
                                                    placeholder="ระบุตัวชี้วัด"
                                                    name="goal[{{ $i_goal }}]['startegy'][{{ $i_startegy }}]['target'][0]['indicator']"
                                                    value="{{ $target['indicator'] }}" required />
                                            </div>
                                            <div class="col-md-2 px-md-1">
                                                <div class="text-md-center"><span class="target_unit">หน่วยนับ</span>
                                                </div>
                                                <input class="form-control text-center" type="text"
                                                    placeholder="ระบุหน่วยนับ"
                                                    name="goal[{{ $i_goal }}]['startegy'][{{ $i_startegy }}]['target'][0]['unit']"
                                                    value="{{ $target['unit'] }}" required />
                                            </div>
                                            <div class="col-md-2 px-md-1" style="padding-right: 12px !important;">
                                                <div class="text-md-center"><span
                                                        class=".target_targetScore">ค่าเป้าหมาย</span>
                                                </div><input class="form-control text-center" type="text"
                                                    placeholder="ระบุค่าเป้าหมาย"
                                                    name="goal[{{ $i_goal }}]['startegy'][{{ $i_startegy }}]['target'][0]['target_value']"
                                                    value="{{ $target['target_value'] }}" required />
                                            </div>
                                            <div class="py-1">
                                                <div class="text-end">
                                                    <div class="btn-group">
                                                        <span class="d-inline-block btn btn-info"> เพิ่มเป้าหมาย</span>
                                                        <span class="d-inline-block btn btn-danger"> ลบเป้าหมาย</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</fieldset>
