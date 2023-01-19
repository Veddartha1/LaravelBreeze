@extends('layouts.layout')
@section('title', 'Editar ganga')
@section('content')
    <h2>Editar Ganga</h2>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('gangas.update', $ganga->id) }}" method='POST' enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="grid grid-cols-1 gap-1 my-1">
            <div class="my-1 mx-2 inline-block">
                <label for="title">T&iacute;tol</label>
                <input type="text" name="title" value="{{$ganga->title}}">
            </div>
            <div class="my-1 mx-2 inline-block">
                <label for='description'>Descripci&oacute;</label>
                <textarea name='description' rows="5" cols="60">{{$ganga->description}}</textarea>
            </div>
            <div class="my-1 mx-2 inline-block">
                <label for="url">Url</label>
                <input type="text" name="url" value="{{$ganga->url}}">
            </div>
            <div class="my-1 mx-2 inline-block">
                <select name="category_id">
                    <option value="" disabled selected>Tria una opci&oacute;</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-1 mx-2 inline-block">
                <label for="price">Preu</label>
                <input type="number" step="0.01" name="price" value="{{$ganga->price}}">
            </div>
            <div class="my-1 mx-2 inline-block">
                <label for="price_sale">Preu ganga</label>
                <input type="number" step="0.01" name="price_sale" value="{{$ganga->price_sale}}">
            </div>
            <div class="my-1 mx-2 inline-block">
                <label for="image">Imatge</label>
                <input type="file" name="image" accept="image/jpeg">
            </div>
            <div class="my-1 mx-2 inline-block">
                <input type="radio" name="available" value="1" id="available">
                <label for="available">Disponible</label>
                <input type="radio" name="available" value="0" id="unavailable">
                <label for="unavailable">No Disponible</label>
            </div>
            <div>
                <button class="boton" type="submit">Editar</button>
            </div>
        </div>
    </form>
@endsection
