@props([
    'id' => null,
    'lable' => null,
    'name',
    'type' => 'text',
    'value' => '',
])

@php
    $id = $id ?? $name;
@endphp


@if ($lable)
    <label for="{{ $id }}">{{ $lable }}</label>
@endif
<textarea type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" 
    class="form-control @error($name) is-invalid   @enderror"> {{ old($name, $value) }} </textarea>
@error($name)
    <p class="invalid-feedback">{{ $message }}</p>
@enderror
