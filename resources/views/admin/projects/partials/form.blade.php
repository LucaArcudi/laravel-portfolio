<form action=" {{ route($route, $project) }} " method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)

    @if ($errors->any())
    <div class="alert alert-danger">
        Check errors
    </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" minlength="3" maxlength="255" required value="{{ old('title', $project->title) }}" name="title">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" minlength="5" maxlength="1000" required name="description" rows="5" cols="33">{{ old('description', $project->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" {{ $htmlAttribute }} value="{{ old('image', $project->image) }}" name="image">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Visibility</label>
        <input type="checkbox" value="1" @checked(old('is_visible', $project->is_visible))  name="is_visible">
    </div>

    <button type="submit" class="btn btn-primary">{{ $buttonName }}</button>
</form>