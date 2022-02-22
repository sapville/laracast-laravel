@props(['name', 'required' => 'required'])
<x-form.input-field>
    <x-form.input-label :name="$name">{{Str::headline($name)}}</x-form.input-label>
    <input class="border border-gray-200 p-2 w-full rounded-md"
           name="{{$name}}" id="{{$name}}" {{$required}}
           {{$attributes}}
           value="{{old($name)}}"
    >
    <x-form.input-error :name="$name"/>
</x-form.input-field>
