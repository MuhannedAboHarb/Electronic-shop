@props([
    'name' => 'success',
    'class' => 'success',
])

@if (Session::has($name))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let icon = 'success';
            let title = 'Attention please';
            let message = "{{ Session::get($name) }}";

            Swal.fire({
                position: 'end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: true,
                showCloseButton: true,
                timer: false
            })
        });
    </script>
@endif

@push('scripts')
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $('.success').alert('close')
            }, 7000);
        });
    </script>
@endpush
