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
    // Fungsi untuk membuat / Menampilkan Modal Form
    function addForm(url) {
        $('#modal-form').modal('show');
    }
</script>

@endpush
