<script>
    @if (session('message'))
        swal({
            icon: 'success',
            title: 'Success',
            text: `{!! session('message') !!}`,
            showConfirmButton: true, // Show "OK" button

        });
    @endif
</script>
