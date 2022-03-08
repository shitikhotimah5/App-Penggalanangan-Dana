@push('css_vendor')
<!-- Select2 Bootstrap -->
<link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts_vendor')
<!-- Select2 Bootstrap -->
<script src="{{ asset('/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
@endpush


<!-- Initialize Select2 Elements-->
@push('scripts')
<script>
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: 'Pilih',
        closeOnSelect: true,
        allowClear: true,
    });
</script>
@endpush
