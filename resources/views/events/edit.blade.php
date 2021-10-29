@extends('layouts.master')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('events.update',$event->slug)}}">
            @method('PUT')
            @csrf
        <div class="form-control mt-2">
            <div class="row text-center">
            <div class="col">
                <label class="mt-2" for="capacity">
                    {{ __('Capacity') }}
                    <input class="form-control" type="number" min="1" name="capacity" value="{{ $event->capacity }}"/>
                </label>
                @error('capacity')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="row text-center">
            <div class="col">
                <label class="mt-2" for="date">
                    {{ __('Date') }}
                    <input
                        class="form-control"
                        type="date"
                        id="date"
                        name="date"
                        value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}"
                        min="{{ now()->format('Y-m-d') }}"
                        max="{{ now()->addYears(2)->format('Y-m-d') }}"
                    >
                </label>
                @error('date')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror

            </div>
        </div>
        @foreach(Config::get('constants.default_languages') as $language)
            <div class="row text-center">
                <div class="col">
                    <label class="mt-2" for="capacity">
                        {{ __("Name ($language)") }}
                        <input value="{{$event->translation($language)->name}}" class="form-control" type="text" min="1" name="name_{{$language}}"/>
                    </label>
                    @error("name_$language")
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        @endforeach
        <div class="row text-center">
            <div class="col">
                <div class="form-group">
                    <label class="mt-2" for="categoryId">
                        {{ __('Category') }}
                        <select  id="categoryId" name="categoryId" class="form-control">
                            @foreach($categories as $category)
                                <option
                                    @if ($event->category->id == $category->id)
                                    selected
                                    @endif
                                    value={{ $category->id }} >
                                    {{$category->translation($lang)->name}}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    @error('categoryId')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row text-center mt-2">
            <div class="col">
                <button type="submit" class="btn btn-primary">Editar Evento</button>
            </div>
        </div>
        </div>
        </form>

    </div>
@endsection
