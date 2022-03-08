@extends('layouts.app')

@section('title', 'Projek')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Projek</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <x-card>
            <x-slot name="header">
                <button onclick="addForm(`{{ route('campaign.store') }}`)" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus-circle"></i>
                    Tambah</button>
            </x-slot>

            <x-table>
                <x-slot name="thead">
                    <th width="5%">No</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Tgl Publish</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th width="15%"><i class="fas fa-cog"></i></th>
                </x-slot>
            </x-table>

        </x-card>
    </div>
</div>

{{-- Modal Form --}}
@includeIf('campaign.form')
@endsection

<x-toast />
@includeIf('includes.datatable')
@includeIf('includes.select2')
@includeIf('includes.summernote')
@includeIf('includes.datepicker')


@push('scripts')
<script>
    let modal = '#modal-form';
    let table;

   table = $('.datatable').DataTable();



    function addForm(url, title = 'Tambah') {
        $(modal).modal('show');
        $(`${modal} .modal-title`).text(title);
        $(`${modal} form`).attr('action', url);

        // Reset Form
        resetForm(`${modal} form`);
    }

    function editForm(url, title = 'Edit') {
        $.get(url)
            .done(response => {
                $(modal).modal('show');
                $(`${modal} .modal-title`).text(title);
                $(`${modal} form`).attr('action', url);

                // Reset Form
                resetForm(`${modal} form`);
                loopForm(response.data);
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    function submitForm(originalForm) {
        $.post({
            url: $(originalForm).attr('action'),
            data: new FormData(originalForm),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
        })
        .done(response => {
            $(modal).modal('hide');
            showAlert(response.message, 'success');
            table.ajax.reload();
        })
        .fail(errors => {
            if (errors.status == 422) {
                loopErrors(errors.responseJSON.errors);
                return;
            }
            showAlert(errors.responseJSON.message, 'danger');
        });
    }

    function deleteData(url) {
        if (confirm('Yakin data akan dihapus?')) {
            $.post(url, {
                '_method': 'delete',
            })
            .done(response => {
                showAlert(response.message, 'success');
                table.ajax.reload();
            })
            .fail(errors => {
                showAlert('Tidak Dapat Menghapus Data');
                return;
            });
        }
    }

    function resetForm(selector) {
        $(selector)[0].reset();

        $('.select2').trigger('change');
        $('.form-control, .custom-select, .custom-checkbox, .custom-radio, .select2').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    }

    function loopForm(originalForm) {
        for (field in originalForm) {
            if ($(`[name=${field}]`).attr('type') != 'file') {

                if ($(`[name=${field}]`).hasClass('summernote')) {
                    $(`[name=${field}]`).summernote('code', originalForm[field]);
                }


                $(`[name=${field}]`).val(originalForm[field]);
                $('select').trigger('change');
            }
        }
    }

    function loopErrors(errors) {
        $('.invalid-feedback').remove();

        if (errors == undefined) {
            return;
        }

        for (error in errors) {
            $(`[name=${error}]`).addClass('is-invalid');

            // Menghandel select 2
            if ($(`[name=${error}]`).hasClass('select2')) {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`).next());
            } else if ($(`[name=${error}]`).hasClass('summernote')) {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`).next());
            } else if ($(`[name=${error}]`).hasClass('custom-control-input')) {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                .insertAfter($(`[name=${error}]`).next());
            }
             else {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`));
            }
        }
    }

    function showAlert(message, type) {
        let title = '';

        switch (type) {
            case 'success':
                title = 'Success';
                break;

            case 'danger':
                    title = 'Failed';
                    break;
            default:
                break;
        }

        $(document).Toasts('create', {
            class: `bg-${type}`,
            title: title,
            body: message
        });

        setTimeout(() => {
            $('.toasts-top-right').remove();
        }, 3000);
    }
</script>

@endpush
