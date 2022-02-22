@props(['name', 'placeholder' => ''])
<x-form.input-field>
    <x-form.input-label :name="$name">{{$name}}</x-form.input-label>
    <textarea class="border border-gray-200 p-2 w-full text-sm focus:outline-none focus:ring rounded-md"
              rows="3" name="{{$name}}" id="{{$name}}" required
              placeholder="{{$placeholder}}"
    >{{$slot}}</textarea>
    <x-form.input-error :name="$name"/>
</x-form.input-field>
