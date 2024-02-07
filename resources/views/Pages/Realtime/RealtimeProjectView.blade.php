<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 text-end fw-bold">ชื่อโครงการ</div>
                <div class="col-md-6">{{ $project->name }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end fw-bold">รหัสโครงการ</div>
                <div class="col-md-6">{{ $project->code }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end fw-bold">วัตถุประสงค์โครงการ</div>
                <div class="col-md-6">{{ $project->objective }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end fw-bold">ระยะเวลาตลอดโครงการ</div>
                <div class="col-md-6">{{ $project->duration }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end fw-bold">งบประมาณทั้งโครงการ</div>
                <div class="col-md-6">{{ $project->budget }} บาท</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end fw-bold">ผู้รับผิดชอบโครงการ</div>
                <div class="col-md-6">{{ $project->handler_name }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end fw-bold">ความคืบหน้า</div>
                <div class="col-md-6">
                    <div class="progress mt-2">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end fw-bold">ดำเนินการแล้ว</div>
                <div class="col-md-6">x</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end fw-bold">ผู้ได้รับประโยชน์</div>
                <div class="col-md-6">x</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end fw-bold">นวัตกรรม/โครงการ</div>
                <div class="col-md-6">{{count($project->activity) + count($project->innovation)}}</div>
            </div>
        </div>
        <div class="col-md-4">
            @foreach ($relate_groups as $relate_group)
                <div>
                    <div class="fs-6 fw-bold">ความสอดคล้องกับ{{ $relate_group->label }}</div>
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
                <div class="fs-6 fw-bold">ความสอดคล้องกับกลยุทธ์ สพท.</div>
                <div style="padding-left: 10px">{{ $project->strategy->detail }}</div>
            </div>
            <div>
                <div class="fs-6 fw-bold">ว.PA</div>
                <div style="padding-left: 10px">{{ $project->is_pa_of_manager == 1 ? 'ใช่' : 'ไม่' }}</div>
            </div>
        </div>
    </div>
</div>
