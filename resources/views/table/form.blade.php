<form action="{{ route('events.add') }}" method="post" class="vstack gap-2">
    @csrf

    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control @error("nom_evenement") is-invalid @enderror" id="nom_evenement" name="nom_evenement" value="{{ old('nom_evenement', $evenement->nom_evenement) }}">
        @error("title")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control @error("slug") is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $evenement->slug) }}">
        @error("slug")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button class="btn btn-primary">

        @if($evenement->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
