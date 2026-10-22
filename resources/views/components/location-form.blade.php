@props(['location' => null, 'statuses' => ['active', 'pending', 'suspended']])

<div class="row g-3">
    <!-- Name -->
    <div class="col-12">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $location?->name) }}"
               placeholder="Location name" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- Latitude -->
    <div class="col-md-6">
        <label class="form-label">Latitude</label>
        <input type="number" name="latitude" step="0.0000001"
               class="form-control @error('latitude') is-invalid @enderror"
               value="{{ old('latitude', $location?->latitude) }}"
               placeholder="e.g. 1.3000000">
        @error('latitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- Longitude -->
    <div class="col-md-6">
        <label class="form-label">Longitude</label>
        <input type="number" name="longitude" step="0.0000001"
               class="form-control @error('longitude') is-invalid @enderror"
               value="{{ old('longitude', $location?->longitude) }}"
               placeholder="e.g. 103.8000000">
        @error('longitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- Status -->
    <div class="col-md-6">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            @foreach($statuses as $s)
                <option value="{{ $s }}" {{ old('status', $location?->status ?? 'active') === $s ? 'selected' : '' }}>
                    {{ ucfirst($s) }}
                </option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
