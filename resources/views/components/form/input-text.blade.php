@props(['name', 'type' => 'text'])
<x-form.input-field>
    <x-form.input-label name="$name">{{ucwords($name)}}</x-form.input-label>
    <input class="border border-gray-400 p-2 w-full"
           type="{{$type}}" name="{{$name}}" id="{{$name}}" required
           value="{{ old($name)}}"
    >
    <x-form.input-error name="$name"/>
</x-form.input-field>
