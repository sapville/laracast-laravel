@props(['name', 'checked'])
<input
    class="checked:bg-blue-500 mr-2"
    type="checkbox" name="{{$name}}" id="{{$name}}"
    {{$checked ? 'checked' : ''}}
>
<label class="{{$attributes->get('class')}}" for="{{$name}}" >{{$slot}}</label>
