<div>
    <table class="table table-hover table-bordered text-left border border-light" id="table_normal">
        <thead>
            <tr>
                <th scope="col">รหัส</th>
                <th scope="col">ชื่อโครงการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td> {{ $project->code }} </td>
                    <td> <a href="{{ route('strategy.project_view', ['id' => $project->id]) }}">{{ $project->name }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
