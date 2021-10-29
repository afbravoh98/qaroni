@extends('layouts.master')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('categories.update', $category->slug)}}">
            @method('PUT')
            @csrf
            <div class="form-control mt-2">
                @foreach(Config::get('constants.default_languages') as $language)
                    <div class="row text-center">
                        <div class="col">
                            <label class="mt-2" for="capacity">
                                {{ __("Name ($language)") }}
                                <input value="{{$category->translation($language)->name}}" class="form-control" type="text" min="1" name="name_{{$language}}"/>
                            </label>
                            @error("name_$language")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                @endforeach
                <div class="row text-center mt-2">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Editar Categoría</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
