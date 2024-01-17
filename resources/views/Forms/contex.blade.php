<fieldset data-async=""
    x-data='
    {
        "inspections" : {{ $inspections }},
        "areas": {{ $areas }},
        "current_area" : {{ $current_area }},
        "inspection_id" : {{ $inspection_id }},
        "area_id" : {{ $current_area->id }},
        "disabled" : {{ $disabled ? 'true' : 'false' }},
    }
    '>
    <div class="bg-white rounded shadow-sm mb-3 p-4 py-4 d-flex flex-column">
        <div class="row px-2">
            {{-- #TODO lock when change inspection and reload areas --}}
            <div class="col-md-6 px-1">
                <div class="input-group">
                    <select class="form-select bg-white" x-model="inspection_id" name="inspection_id"
                        :disabled="inspections.length == 1">
                        <template x-for="i in inspections">
                            <option :value="i.id" :selected="i.id == inspection_id" x-html="i.name"></option>
                        </template>
                    </select>
                    <button data-controller="button" data-turbo="true" class="btn btn-primary" type="submit"
                        form="post-form" formaction="{{ route('strategy.contex.form') }}/getArea"
                        x-show="inspection_id !== current_area.inspection_id && inspections.length > 1">
                        <span>ตกลง</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 px-1">
                <div class="input-group">
                    <select class="form-select bg-white" name="area_id"
                        :disabled="inspection_id !== current_area.inspection_id">
                        <template x-for="i in areas">
                            <option :value="i.id" :selected="i.id == area_id" x-html="i.name"></option>
                        </template>
                    </select>
                    <button data-controller="button" data-turbo="true" class="btn btn-primary" type="submit"
                        form="post-form" formaction="{{ route('strategy.contex.form') }}/getArea"
                        x-show="inspection_id == current_area.inspection_id">
                        <span>ตกลง</span>
                    </button>
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
                        placeholder="ระบุวิสัยทัศน์" required @disabled($disabled)
                        value="{{ $vision }}" /></div>
            </div>
            <div class="row py-1">
                <div class="col-md-2">
                    <p class="text-end m-0 py-2">พันธกิจ</p>
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" rows="6" placeholder="ระบุพันธกิจ" name="mission" @disabled($disabled)
                        required>{{ $mission }}</textarea>
                </div>
            </div>
            @php($count_goal = count($goals))
            @foreach ($goals as $i_goal => $goal)
                <div class="row py-1">
                    <div class="col-md-2">
                        <p class="text-end m-0 py-2">เป้าประสงค์ {{ $i_goal + 1 }}.</p>
                    </div>
                    <div class="col-md-10">
                        <div class="col-12">
                            <div class="input-group">
                                <input class="form-control" type="text" name="goal[{{ $i_goal }}][detail]"
                                    placeholder="ระบุเป้าประสงค์" style="display: inline-block !important;" required
                                    value="{{ $goal['detail'] }}" @disabled($disabled) />
                                @if ($count_goal == $i_goal + 1)
                                    <button data-controller="button" data-turbo="true" class="btn btn-primary"
                                        type="submit" form="post-form"
                                        formaction="{{ route('strategy.contex.form') }}/push?type=goal"
                                        x-show="!disabled">เพิ่มเป้าประสงค์ {{ $i_goal + 2 }}</button>
                                @endif
                                <button class="btn btn-danger" data-controller="button" data-turbo="true" type="submit"
                                    form="post-form" formaction="{{ route('strategy.contex.form') }}/del"
                                    x-show="!disabled">ลบ</button>
                            </div>
                            <input type="hidden" value="{{ $goal['id'] }}" name="goal[{{ $i_goal }}][id]">
                        </div>
                        @php($count_strategy = count($goal['strategy']))
                        @foreach ($goal['strategy'] as $i_strategy => $strategy)
                            <div class="row py-1">
                                <div class="col-md-2 pt-2 text-center"><span>กลยุทธ์
                                        {{ $i_goal + 1 }}.{{ $i_strategy + 1 }}.</span></div>
                                <div class="col-md-10">
                                    <div class="input-group"><input class="form-control" type="text"
                                            placeholder="รายละเอียดกลยุทธ์"
                                            name="goal[{{ $i_goal }}][strategy][{{ $i_strategy }}][detail]"
                                            required value="{{ $strategy['detail'] }}" @disabled($disabled) />
                                        @if ($count_strategy == $i_strategy + 1)
                                            <button data-controller="button" data-turbo="true" class="btn btn-info"
                                                type="submit" form="post-form"
                                                formaction="{{ route('strategy.contex.form') }}/push?type=strategy&kg={{ $goal['id'] }}"
                                                x-show="!disabled">เพิ่มกลยุทธ์
                                                {{ $i_goal + 1 }}.{{ $i_strategy + 2 }}.</button>
                                        @endif
                                        <button class="btn btn-danger" data-controller="button" data-turbo="true"
                                            type="submit" form="post-form"
                                            formaction="{{ route('strategy.contex.form') }}/del"
                                            x-show="!disabled">ลบ</button>
                                    </div>
                                    <input type="hidden" value="{{ $strategy['id'] }}"
                                        name="goal[{{ $i_goal }}][strategy][{{ $i_strategy }}][id]">
                                </div>
                                @php($count_target = count($strategy['target']))
                                @foreach ($strategy['target'] as $i_target => $target)
                                    <div class="col-12 py-0">
                                        <div class="row">
                                            <div class="col-md-1 text-center px-md-1">
                                                @if ($i_target == 0)
                                                    <div style="padding: 12px;"></div>
                                                @else
                                                    <div style="padding: 0px;"></div>
                                                @endif
                                                <div class="py-2">
                                                    <span id="noLabel" class="d-md-none">เป้าหมายที่</span>
                                                    <span
                                                        id="no">{{ $i_goal + 1 }}.{{ $i_strategy + 1 }}.{{ $i_target + 1 }}.
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-5 px-md-1">
                                                @if ($i_target == 0)
                                                    <div class="text-md-center"><span
                                                            class=".target_target">เป้าหมาย</span></div>
                                                @endif
                                                <input class="form-control" type="text" placeholder="ระบุเป้าหมาย"
                                                    name="goal[{{ $i_goal }}][strategy][{{ $i_strategy }}][target][{{ $i_target }}][name]"
                                                    value="{{ $target['name'] }}" required
                                                    @disabled($disabled) />
                                            </div>
                                            <div class="col-md-2 px-md-1">
                                                @if ($i_target == 0)
                                                    <div class="text-md-center"><span
                                                            class="target_pointer">ตัวชี้วัด</span></div>
                                                @endif
                                                <input class="form-control text-center" type="text"
                                                    placeholder="ระบุตัวชี้วัด"
                                                    name="goal[{{ $i_goal }}][strategy][{{ $i_strategy }}][target][{{ $i_target }}][indicator]"
                                                    value="{{ $target['indicator'] }}" required
                                                    @disabled($disabled) />
                                            </div>
                                            <div class="col-md-2 px-md-1">
                                                @if ($i_target == 0)
                                                    <div class="text-md-center"><span
                                                            class="target_unit">หน่วยนับ</span></div>
                                                @endif
                                                <input class="form-control text-center" type="text"
                                                    placeholder="ระบุหน่วยนับ"
                                                    name="goal[{{ $i_goal }}][strategy][{{ $i_strategy }}][target][{{ $i_target }}][unit]"
                                                    value="{{ $target['unit'] }}" required
                                                    @disabled($disabled) />
                                            </div>
                                            <div class="col-md-2 px-md-1" style="padding-right: 12px !important;">
                                                @if ($i_target == 0)
                                                    <div class="text-md-center"><span
                                                            class=".target_targetScore">ค่าเป้าหมาย</span>
                                                    </div>
                                                @endif
                                                <div class="input-group">
                                                    <input class="form-control text-center" type="text"
                                                        placeholder="ระบุค่าเป้าหมาย"
                                                        name="goal[{{ $i_goal }}][strategy][{{ $i_strategy }}][target][{{ $i_target }}][target_value]"
                                                        value="{{ $target['target_value'] }}" required
                                                        @disabled($disabled) />
                                                    <button class="btn btn-danger" data-controller="button"
                                                        data-turbo="true" type="submit" form="post-form"
                                                        formaction="{{ route('strategy.contex.form') }}/del"
                                                        x-show="!disabled">ลบ</button>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{ $target['id'] }}"
                                                name="goal[{{ $i_goal }}][strategy][{{ $i_strategy }}][target][{{ $i_target }}][id]">
                                            @if ($count_target == $i_target + 1)
                                                <div class="py-1" x-show="!disabled">
                                                    <div class="text-end">
                                                        <div class="btn-group">
                                                            <button data-controller="button" data-turbo="true"
                                                                class="btn btn-warning" type="submit"
                                                                form="post-form"
                                                                formaction="{{ route('strategy.contex.form') }}/push?type=target&kg={{ $goal['id'] }}&ks={{ $strategy['id'] }}"
                                                                x-show="!disabled">เพิ่มเป้าหมาย
                                                                {{ $i_goal + 1 }}.{{ $i_strategy + 2 }}.{{ $i_target + 2 }}.</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
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
