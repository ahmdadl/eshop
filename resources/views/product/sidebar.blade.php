<div class="card">
    <div class="card-header">
        <span class="float-left">{{$title}}</span>
        <span class="float-right">
            <button class="btn btn-primary" type="button" data-toggle="collapse"
                data-target="#collabse{{$title}}List" aria-expanded="true"
                aria-controls="collabse{{$title}}List">
                -
            </button>
        </span>
    </div>
    <div class="collapse @if(isset($show)) show @endif"
        id="collabse{{$title}}List">
        <div class="card card-body">
            <div class="custom-control custom-checkbox"
                v-for="({{$index}}, {{$index. 'indx' . $index}}) in h.d.{{$data}}"
                :key="{{$index. 'indx' . $index}}">
                <input type="checkbox"
                    :id="'{{$index}}_' + {{$index. 'indx' . $index}}"
                    class="custom-control-input"
                    :indeterminate.prop="{{$index}}.checked" />
                <label :for="'{{$index}}_' + {{$index. 'indx' . $index}}"
                    class="custom-control-label">
                    @php
                    echo "{{" . $index . ".txt}}"
                    @endphp
                </label>
            </div>
        </div>
    </div>
</div>