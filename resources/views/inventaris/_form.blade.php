<div class="form-max">
    <div class="form-grid grid-2">
        <div class="form-group">
            <label class="form-label">Category <span class="required">*</span></label>
            <select name="kategori_id" class="form-control {{ $errors->has('kategori_id') ? 'has-error' : '' }}">
                <option value="">Select a category</option>
                @foreach ($kategoris as $k)
                    <option value="{{ $k->id }}" @selected(old('kategori_id', $item->kategori_id ?? '') == $k->id)>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Condition <span class="required">*</span></label>
            <select name="kondisi_id" class="form-control {{ $errors->has('kondisi_id') ? 'has-error' : '' }}">
                <option value="">Select a condition</option>

                @foreach ($kondisis as $kondisi)
                    <option value="{{ $kondisi->id }}" @selected(old('kondisi_id', $item->kondisi_id ?? '') == $kondisi->id)>
                        {{ $kondisi->nama }}
                    </option>
                @endforeach
            </select>

            @error('kondisi_id')
                <div class="form-error">{{ $message }}</div>
            @enderror
            @error('kondisi') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Item Code <span class="required">*</span></label>
        <input type="text" name="kode_barang" class="form-control {{ $errors->has('kode_barang') ? 'has-error' : '' }}"
            value="{{ old('kode_barang', $item->kode_barang ?? '') }}" placeholder="e.g., LAB-001">
        @error('kode_barang') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Item Name <span class="required">*</span></label>
        <input type="text" name="nama_barang" class="form-control {{ $errors->has('nama_barang') ? 'has-error' : '' }}"
            value="{{ old('nama_barang', $item->nama_barang ?? '') }}" placeholder="e.g., Laptop ASUS">
        @error('nama_barang') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-grid grid-2">
        <div class="form-group">
            <label class="form-label">Brand</label>
            <input type="text" name="merek" class="form-control" value="{{ old('merek', $item->merek ?? '') }}"
                placeholder="e.g., ASUS">
            @error('merek') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Location <span class="required">*</span></label>
            <input type="text" name="lokasi" class="form-control {{ $errors->has('lokasi') ? 'has-error' : '' }}"
                value="{{ old('lokasi', $item->lokasi ?? '') }}" placeholder="e.g., Lab Computer 1">
            @error('lokasi') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="form-grid grid-2">
        <div class="form-group">
            <label class="form-label">Quantity <span class="required">*</span></label>
            <input type="number" name="jumlah" class="form-control {{ $errors->has('jumlah') ? 'has-error' : '' }}"
                min="1" value="{{ old('jumlah', $item->jumlah ?? 1) }}">
            @error('jumlah') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Acquisition Date</label>
            <input type="date" name="tanggal_pengadaan" class="form-control"
                value="{{ old('tanggal_pengadaan', $item->tanggal_pengadaan ?? '') }}">
            @error('tanggal_pengadaan') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="keterangan" class="form-control" rows="4"
            placeholder="Add any additional details about this item...">{{ old('keterangan', $item->keterangan ?? '') }}</textarea>
        @error('keterangan') <div class="form-error">{{ $message }}</div> @enderror
    </div>
</div>