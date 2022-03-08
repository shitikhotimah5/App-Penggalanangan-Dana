<table {{ $attributes->merge(['class' => 'table table-striped mt-3 datatable']) }}>
    @isset($thead)
    <thead class="bg-primary">
        {{ $thead }}
    </thead>
    @endisset

    <tbody>
        {{ $slot }}
    </tbody>

    @isset($tfoot)
    <tfoot>
        {{ $tfoot }}
    </tfoot>
    @endisset
</table>
