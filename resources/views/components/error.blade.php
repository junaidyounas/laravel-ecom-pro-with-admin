<script>
    @if (session('error'))
        swal({
            icon: 'danger',
            title: 'Error',
            text: `{!! session('error') !!}`,
            showConfirmButton: true, // Show "OK" button

        });
    @endif
</script>
