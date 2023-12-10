<fieldset data-async=""
    x-data='{"inspections" : {{ $inspections }}, "areas": {{ $areas }}, "areaData" : {{ $areaData }}, "inspection_id" : {{ $inspection_id }}, "area_id" : {{ $areaData->id }} }'>
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
                <div class="col-md-3">
                    <p class="text-end m-0 py-2">วิสัยทัศน์</p>
                </div>
                <div class="col-md-9"><input class="form-control" type="text" name="form[vision]"
                        placeholder="ระบุวิสัยทัศน์" /></div>
            </div>
            <div class="row py-1">
                <div class="col-md-3">
                    <p class="text-end m-0 py-2">พันธกิจ</p>
                </div>
                <div class="col-md-9">
                    <textarea class="form-control" rows="6" placeholder="ระบุพันธกิจ" name="form[mission]"></textarea>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-md-3">
                    <p class="text-end m-0 py-2">เป้าประสงค์</p>
                </div>
                <div class="col-md-9">
                    <div>
                        <div class="input-group">
                            <input class="form-control" type="text" name="form[goal[0]name]"
                                placeholder="ระบุเป้าประสงค์" style="display: inline-block !important;" />
                            <span class="btn btn-primary btn-sm">+เพิ่มเป้าประสงค์</span>
                        </div>
                        <div class="row py-1">
                            <div class="col-md-2 pt-2"><span>กลยุทธ์</span></div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="strategy_des"
                                        placeholder="รายละเอียด" />
                                    <span class="btn btn-primary btn-sm" type="button">+เพิ่มเป้าประสงค์</span>
                                </div>
                            </div>
                        </div>
                        <div class="row py-1">
                            <div class="col-md-6 text-center"><span>เป้าหมาย</span></div>
                            <div class="col-md-2 text-center"><span>ตัวชี้วัด</span></div>
                            <div class="col-md-2 text-center"><span>หน่วยนับ</span></div>
                            <div class="col-md-2 text-center"><span>ค่าเป้าหมาย</span></div>
                            <div class="row">
                                <div class="text-end col-md-2 py-2"><span>เป้าหมายที่ 1</span></div>
                                <div class="col-md-4 px-1"><input class="form-control" type="text"
                                        placeholder="ระบุรายละเอียด" name="target_des[]" /></div>
                                <div class="col-md-2 px-1"><input class="form-control text-center" type="text"
                                        placeholder="ระบุ" name="target_Indicator[]" /></div>
                                <div class="col-md-2 px-1"><input class="form-control text-center" type="text"
                                        placeholder="ระบุ" name="target_unitM[]" /></div>
                                <div class="col-md-2 px-1"><input class="form-control text-center" type="text"
                                        placeholder="ระบุ" name="target_target[]" /></div>
                            </div>
                            <div class="py-1">
                                <div class="text-end"><button class="btn btn-primary" type="button">+
                                        เป้าหมาย</button></div>
                            </div>
                        </div>
                        <div class="py-1">
                            <div class="input-group"><span class="input-group-text">กรอบแนวคิดการบริหาร
                                    และแนวทางนำไปสู่การปฏิบัติ</span><input class="form-control" type="file"
                                    name="concept" /></div>
                        </div>
                        <div class="py-1">
                            <div class="input-group"><span class="input-group-text">แผนการปฏิบัติราชการของ
                                    สพฐ.</span><input class="form-control" type="file" name="strategy_obec" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</fieldset>
