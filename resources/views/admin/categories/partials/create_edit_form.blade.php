<form action=" {{ route($route, $category) }} " method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)

    @if ($errors->any())
    <div class="alert alert-danger">
        Check errors
    </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" minlength="3" maxlength="255" required value="{{ old('name', $category->name) }}" name="name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="color" class="form-label">Color</label>
        <input type="color" name="color" id="color" value="{{ old('color', $category->color) }}" class="form-control @error('color') is-invalid @enderror">
        @error('color')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="buttons-wrapper d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">{{ $buttonName }}</button>
    </div>
</form>