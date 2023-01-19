@extends('layouts.layout')
@section('title', 'Crear ganga')
@section('content')
    <h2>Nova Ganga</h2>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('gangas.store') }}" method='POST' enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-1 my-1">
            <div class="my-1 mx-2 inline-block">
                <label for="title">T&iacute;tol</label>
                <input type="text" name="title" value="{!! old('title') !!}">
            </div>
            <div class="my-1 mx-2 inline-block">
                <label for='description'>Descripci&oacute;</label>
                <textarea name='description' rows="5" cols="60">{!! old('description') !!}</textarea>
            </div>
            <div class="my-1 mx-2 inline-block">
                <label for="url">Url</label>
                <input type="text" name="url" value="{!! old('url') !!}">
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
                <input type="number" step="0.01" name="price" value="{!! old('price') !!}">
            </div>
            <div class="my-1 mx-2 inline-block">
                <label for="price_sale">Preu ganga</label>
                <input type="number" step="0.01" name="price_sale" value="{!! old('price_sale') !!}">
            </div>
            <div class="my-1 mx-2 inline-block">
                <label for="image">Imatge</label>
                <input type="file" name="image" accept="image/jpeg">
            </div>
            <div>
                <button class="boton" type="submit">Afegir</button>
            </div>
        </div>
    </form>
@endsection
