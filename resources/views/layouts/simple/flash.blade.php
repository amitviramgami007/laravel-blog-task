<script>

    @if (session('status'))

        Swal.fire({
            title: '{{ session('status') }}',
            icon: '{{ session('statusCode') }}',
            button : 'OK',
        });

    @endif

</script>
