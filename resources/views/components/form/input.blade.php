@props(['name'])
<x-form.field>
    <x-form.label name="{{$name}}" />
    <input value="{{old('$name')}}" class="border border-gray-200 p-2 w-full rounded" name="{{$name}}" id="{{$name}}"
        required {{$attributes}}>

    <x-form.error name="{{$name}}" />

</x-form.field>