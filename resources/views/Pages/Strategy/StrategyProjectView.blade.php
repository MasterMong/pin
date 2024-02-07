<div class="bg-white rounded shadow-sm mb-3 p-4 py-4 d-flex flex-column">
    <div class="row">
        <div class="col-md-8">
            <h6>ชื่อโครงการ : {{ $project->name }}</h6>
        </div>
        <div class="col-md-4">
            <h6>รหัสโครงการ : {{ $project->code }}</h6>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div>
                <h6>วัตถุประสงค์โครงการ</h6>
                <p style="padding-left: 10px">{{ $project->objective }}</p>
            </div>
            <div>
                <h6>ตัวชี้วัดความสำเร็จ</h6>
                <p style="padding-left: 10px">{{ $project->indicator }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div>
                <h6>ระยะเวลาตลอดโครงการ</h6>
                <p style="padding-left: 10px">{{ $project->objective }}</p>
            </div>
            <div>
                <h6>งบประมาณ</h6>
                <p style="padding-left: 10px">{{ $project->indicator }}</p>
            </div>
            <div>
                <h6>ผู้รับผิดชอบโครงการ</h6>
                <p style="padding-left: 10px">{{ $project->indicator }}</p>
            </div>
        </div>
        <div class="col-md-4">
            @foreach ($relate_groups as $relate_group)
                <div>
                    <h6>ความสอดคล้องกับ{{ $relate_group->label }}</h6>
                    @foreach ($relate_group->types as $type)
                        <div style="padding-left: 10px;">
                            {{ $type->label }}
                            @if ($type->is_parent == true)
                                <div style="padding-left: 10px">
                                    {{ json_encode($project->relate_items['by_type'][$type->name]) }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
            <div>
                <h6>ความสอดคล้องกับกลยุทธ์ สพท.</h6>
                <p style="padding-left: 10px">{{ $project->strategy->detail }}</p>
            </div>
            <div>
                <h6>ว.PA</h6>
                <p style="padding-left: 10px">{{ $project->is_pa_of_manager == 1 ? 'ใช่' : 'ไม่' }}</p>
            </div>
        </div>
    </div>
    <div class="pintable">
        <table class="table table-hover align-middle table-warning table-bordered text-center">
            <thead class="thead-dark">
            </thead>
            <tbody>
                <tr class="table-active">
                    <td scope="col" rowspan="2">ชื่อกิจกรรม</td>
                    <td scope="col" rowspan="2">กลุ่มเป้าหมาย</td>
                    <td scope="col" colspan="3">ไตรมาส 1</td>
                    <td scope="col" colspan="3">ไตรมาส 2</td>
                    <td scope="col" colspan="3">ไตรมาส 3</td>
                    <td scope="col" colspan="3">ไตรมาส 4</td>
                    <td scope="col" rowspan="2">ผลที่คาดว่าจะได้รับ</td>
                </tr>
                <tr class="table-active">
                    <td>ต.ค.</td>
                    <td>พ.ย.</td>
                    <td>ธ.ค.</td>
                    <td>ม.ค.</td>
                    <td>ก.พ.</td>
                    <td>มี.ค.</td>
                    <td>เม.ย.</td>
                    <td>พ.ค.</td>
                    <td>มิ.ย.</td>
                    <td>ก.ค.</td>
                    <td>ส.ค.</td>
                    <td>ก.ย.</td>
                </tr>
                <tr>
                    <td>กิจกรรมที่ 1</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
