@props(['index', 'data'])

<div class="custom-control custom-checkbox"
    v-for="({{$index}}, {{$index. 'indx' . $index}}) in h.d.{{$data}}"
    :key="{{$index. 'indx' . $index}}">
    <input type="checkbox" :id="'{{$index}}_' + {{$index. 'indx' . $index}}"
class="custom-control-input" :indeterminate.prop="{{$index}}.checked" v-model="h.d.selected.{{$data}}" :value="{{$index}}.txt" />
    <label :for="'{{$index}}_' + {{$index. 'indx' . $index}}"
        class="custom-control-label">
        @php
        echo "{{" . $index . ".txt}}"
        @endphp
    </label>
</div>