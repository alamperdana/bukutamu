<x-form.modal title="Tambah/Edit Pagu" action="{{ $action ?? null }}">
    <div id="pagu_items">
        @foreach ($paguItems as $index => $pagu)
            <div class="row mb-3 pagu-item" id="pagu_item_{{ $index }}">
                <div class="col-md-5">
                    <x-form.input name="pagu[{{ $index }}][amount]" value="{{ number_format($pagu->pagu, 2, ',', '.') }}" label="Pagu (Rp)" data-format="currency" 
                    />
                </div>
                <div class="col-md-5">
                    <x-form.input 
                        name="pagu[{{ $index }}][description]" 
                        value="{{ $pagu->keterangan }}" 
                        label="Keterangan" 
                    />
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger mt-4 remove-pagu" 
                        href="{{ route('master-data.rekening.paguDelete', ['id' => $pagu->id]) }}"
                        data-id="{{ $pagu->id }}" 
                        data-target="#pagu_item_{{ $index }}">
                        Hapus
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-primary mt-2" id="add_pagu_item">Tambah Pagu</button>
</x-form.modal>