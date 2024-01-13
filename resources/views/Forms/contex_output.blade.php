<fieldset data-async=""
    x-data='{"inspections" : {{ $inspections }}, "areas": {{ $areas }}, "areaData" : {{ $areaData }}, "inspection_id" : {{ $inspection_id }}, "area_id" : {{ $areaData->id }} }'>
    <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
        <div class="row px-2">
            {{-- #TODO lock when change inspection and reload areas --}}
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
                    {{-- <button data-controller="button" data-turbo="true" class="btn btn-primary" type="submit"
                        form="post-form" formaction="{{ route('startegy.contex.form') }}/getArea"
                        x-show="inspection_id == areaData.inspection_id">
                        <span>ตกลง</span>
                    </button> --}}
                    {{-- <span class="btn btn-primary">ตกลง</span> --}}
                </div>
            </div>
        </div>
        <hr>
        <div>
            <table class="table">
                <thead class="table-white">
                  <tr>
                    <th style="text-align: center;"><label class="form-label"><strong>รหัส</strong></label></th>
                    <th style="text-align: center;"><label class="form-label"><strong>ชื่อโครงการ</strong></label></th>
                    <th style="text-align: center;"><label class="form-label"><strong>รายละเอียด</strong></label></th>
                  </tr>
                </thead>
                <tbody>
            @php($count_goal = count($goals))
            @foreach ($goals as $i_goal => $goal)

                @php($count_rows = count($goal['rows']))
                @foreach ($goal['rows'] as $i_rows => $rows)
                <tr>
                    @php($count_cols = count($rows['cols1']))
                    @foreach ($rows['cols1'] as $i_cols => $cols)
                        <td style="text-align: center;"><label class="form-label">{{ $cols['code'] }}</label></td>
                        <td style="text-align: center;"><label class="form-label">{{-- $cols['project_name'] --}}</label></td>
                        <td style="text-align: center;"><button class="btn btn-primary" type="button"><span>คลิก</span></button></td>
                    @endforeach
                </tr>
                @endforeach

            @endforeach
                </tbody>
            </table>
        </div>
    </div>

</fieldset>
