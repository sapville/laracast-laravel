@props(['name', 'placeholder' => ''])
<x-form.input-field>
    <x-form.input-label name="$name">{{$name}}</x-form.input-label>
    <textarea class="border border-gray-400 p-2 w-full text-sm focus:outline-none focus:ring"
              rows="3" name="{{$name}}" id="{{$name}}" required
              placeholder="{{$placeholder}}"
    >{{ old($name) }}</textarea>
    <x-form.input-error name="$name"/>
</x-form.input-field>
