<fieldset class="mb-3" data-async=""
    x-data='{"inspection" : {{ $inspection }}, "areas": {{ $areas }}, "areaData" : {{ $areaData }} }'>
    <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
        <div class="row"
            x-data='{ "inspection_id" : {{ $areaData->inspection_id }}, "area_id" : {{ $areaData->id }} }'>
            {{-- #todo lock when change inspection and reload areas --}}
            <div class="col-md-6 px-1">
                <div class="input-group">
                    <select class="form-select bg-white" x-model="inspection_id" name="inspection_id">
                        <template x-for="i in inspection">
                            <option :value="i.id" :selected="i.id === inspection_id" x-html="i.name"></option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="col-md-6 px-1">
                <div class="input-group">
                    <select class="form-select bg-white" name="area_id">
                        <template x-for="i in areas">
                            <option :value="i.id" :selected="i.id === area_id" x-html="i.name"></option>
                        </template>
                    </select>
                    <button data-controller="button" data-turbo="true" class="btn btn-primary" type="submit"
                        form="post-form" formaction="{{ route('startegy.contex.form') }}/getArea">
                        <span>ตกลง</span>
                    </button>
                    {{-- <span class="btn btn-primary">ตกลง</span> --}}
                </div>
            </div>
        </div>
        <div class="py-4">
            <h2>{{ $areaData->name }}</h2>

        </div>
    </div>
</fieldset>
