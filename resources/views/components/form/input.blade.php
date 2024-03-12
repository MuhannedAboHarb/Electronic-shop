@props([
    'id' => null,
    'lable' => null,
    'name',
    'type' => 'text',
    'value' => '', 
    'required' => 0 ,
])

@php
    $id = $id ?? $name;
@endphp


@if ($lable)
    <x-form.lable :required="$required" > 
        {{ $lable }} 
    </x-form.lable>
@endif
<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $type == 'password' ? '' :  old($name, $value) }}"
    class="form-control @error($name) is-invalid   @enderror">
@error($name)
    <p class="invalid-feedback">{{ $message }}</p>
@enderror
