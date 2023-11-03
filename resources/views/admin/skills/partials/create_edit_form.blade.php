<form action=" {{ route($route, $skill) }} " method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)

    @if ($errors->any())
    <div class="alert alert-danger">
        Check errors
    </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" minlength="2" maxlength="255" required value="{{ old('name', $skill->name) }}" name="name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" class="form-control @error('name') is-invalid @enderror" {{ $isRequired }} value="{{ old('image', $skill->image) }}" name="image">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="buttons-wrapper d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">{{ $buttonName }}</button>
    </div>
</form>