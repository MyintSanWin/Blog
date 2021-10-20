@props(['name'])
<x-form.field>
    <x-form.label name="{{$name}}" />
    <textarea class="border border-gray-400 p-2 w-full" name="{{$name}}" id="{{$name}}" rows="3" required
        for="{{$name}}">{{old($name)}}</textarea>
</x-form.field>