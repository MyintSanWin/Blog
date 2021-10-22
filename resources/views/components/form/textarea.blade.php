@props(['name'])
<x-form.field>
    <x-form.label name="{{$name}}" />
    <textarea class="border border-gray-200 p-2 w-full rounded" name="{{$name}}" id="{{$name}}" rows="3" required
        for="{{$name}}">{{ $slot ?? old($name)}}</textarea>
</x-form.field>