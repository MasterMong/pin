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

                <div class="row">
                    <div class="col-md-6">
                        <div class="row py-1">
                            <div class="col-md-3">
                                <p class="text-end m-0 py-2">ชื่อโครงการ</p>
                            </div>
                            <div class="col-md-9"><input class="form-control" type="text" name="project_name" placeholder="ระบุชื่อโครงการ" /></div>
                        </div>
                        <div class="row py-1">
                            <div class="col-md-3">
                                <p class="text-end m-0 py-2">รหัสโครงการ</p>
                            </div>
                            <div class="col-md-9"><input class="form-control" type="text" name="project_code" placeholder="ระบุรหัสโครงการ" /></div>
                        </div>
                        <div class="row py-1">
                            <div class="col-md-3">
                                <p class="text-end m-0 py-2">วัตถุประสงค์โครงการ</p>
                            </div>
                            <div class="col-md-9"><textarea class="form-control" rows="3" name="project_objective"></textarea></div>
                        </div>
                        <div class="row py-1">
                            <div class="col-md-3">
                                <p class="text-end m-0 py-2">ตัวชี้วัดความสำเร็จ</p>
                            </div>
                            <div class="col-md-9"><textarea class="form-control" rows="3" name="project_indicator"></textarea></div>
                        </div>
                        <div class="row py-1">
                            <div class="col-md-3">
                                <p class="text-end m-0 py-2">ระยะเวลาตลอดโครงการ</p>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group"><span class="input-group-text">วันที่เริ่ม</span><input class="form-control" type="date" name="project_start" /></div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group"><span class="input-group-text">วันสิ้นสุด</span><input class="form-control" type="date" name="project_end" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row py-1">
                            <div class="col-md-3">
                                <p class="text-end m-0 py-2">งบประมาณ</p>
                            </div>
                            <div class="col-md-9"><input class="form-control" type="text" name="project_budget" placeholder="ระบุงบประมาณ" /></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>ความสอดคล้อง</h5>
                        <hr />
                        <div><span>1. ยุทธศาสตร์ชาติ</span>
                            <div class="row">
                                <div class="text-end col-4 py-2"><span>ยุทธศาสตร์ชาติ</span></div>
                                <div class="col-8"><select class="form-select" name="ac[national]ns">
                                        <option value="x">x</option>
                                    </select></div>
                            </div>
                            <div class="row">
                                <div class="text-end col-4 py-2"><span>แผนแม่บท</span></div>
                                <div class="col-8"><select class="form-select" name="ac[national]s">
                                        <optgroup label="This is a group">
                                            <option value="12" selected>This is item 1</option>
                                        </optgroup>
                                    </select></div>
                            </div>
                        </div>
                        <div><span>2. นโยบายและจุดเน้น สพฐ.</span>
                            <div class="row">
                                <div class="text-end col-4 py-2"><span>Education Policy</span></div>
                                <div class="col-8"><select class="form-select" name="ac[policy]ec">
                                        <option value="14">This is item 3</option>
                                    </select></div>
                            </div>
                            <div class="row">
                                <div class="text-end col-4 py-2"><span>Quick Win</span></div>
                                <div class="col-8"><select class="form-select" name="ac[policy]qw">
                                        <option value="14">This is item 3</option>
                                    </select></div>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="text-start col-4 py-2"><span>3. กลยุทธ์ สพท.</span></div>
                                <div class="col-8"><select class="form-select" value="ac[tactics]tactics">
                                        <option value="14">This is item 3</option>
                                    </select></div>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="text-start col-4 py-2"><span>4. วPA ผู้อำนวยการ สพท.</span></div>
                                <div class="col-8"><select class="form-select" name="ac[pa]pa">
                                        <option value="14">This is item 3</option>
                                    </select></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end py-1">
                    <div></div><button class="btn btn-success" type="submit"><svg class="bi bi-save" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"></path>
                        </svg> บันทึก</button>
                </div>

        </div>
    </div>

</fieldset>
