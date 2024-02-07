<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
    <div class="row">
        <div class="col-md-3">
            <div>
                <h6>จำนวนโครงการที่รายงาน</h6>
            </div>
            <div>
                <h6>จำนวนผู้ได้รับประโยชน์</h6>
            </div>
            <div>
                <h6>จำนวนกิจกรรมที่ดำเนินงาน</h6>
            </div>
            <div>
                <h6>จำนวนนวัตกรรม</h6>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <h6>จำนวน สพท. ที่รายงานความก้าวหน้า</h6>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-center">
                <h6>%รายงานโครงการตามนโยบาย</h6>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <table class="table align-middle table-hover table-warning table-bordered table-striped">
            <thead class="thead-dark">
                <tr class="table-active">
                    <th scope="col" class="text-dark text-center">ชื่อโครงการ</th>
                    <th scope="col" class="text-dark text-center">ผลการดำเนินการ</th>
                    <th scope="col" class="text-dark text-center">ความก้าวหน้า</th>
                    <th scope="col" class="text-dark text-center">นวัตกรรม</th>
                    <th scope="col" class="text-dark text-center">รายงาน</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    <td class="text-left">{{$project->name}}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
