<form action=" {{ route($route, $project->id) }} " method="POST">
    @csrf
    @method($method)

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error )
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="mb-3">
        <label class="form-label">title</label>
        <input type="text" class="form-control" value="{{ old('title', $project->title) }}" name="title">
    </div>
    <div class="mb-3">
        <label class="form-label">technologies</label>
        <input type="text" class="form-control" value="{{ old('technologies', $project->technologies) }}" name="technologies">
    </div>
    <div class="mb-3">
        <label class="form-label">description</label>
        <textarea class="form-control" name="description" rows="5" cols="33">{{ old('description', $project->description) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">date</label>
        <input type="date" class="form-control" value="{{ old('date', $project->date) }}" name="date">
    </div>
    <button type="submit" class="btn btn-primary">{{ $buttonName }}</button>
</form>