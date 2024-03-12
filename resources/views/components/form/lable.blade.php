@props([
    'required'=> false ,
    'lable'
])

<label {{ $attributes-> class(['form-lable', 'required'=> $required]) }} >
    {{ $slot }}
</label>