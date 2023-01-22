@extends('layouts.layout')
@section('title', 'Editar categoria')
@section('content')
    <div class="w-full max-w-sm">
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <h2>Editar Categoria {{$category->name}}</h2>
            </div>
        </div>
    </div>
    <form novalidate class="w-full max-w-lg" action="{{ route('categorias.update', $category->id) }}" method='POST' enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="labelStyle" for="name">Nom</label>
            </div>
            <div class="md:w-2/3">
                <input class="inputStyle" id="inline-full-name" type="text" name="name" value="{{$category->name}}" minlength="5" required>
            </div>
        </div>
        @if ($errors->has('name'))
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="labelStyle">Error</label>
                </div>
                <div class="md:w-2/3">
                    <span class="text-sm bg-red-300 border border-red-500 text-gray-700 py-3 px-4 pr-8 rounded">{{ $errors->first('name') }}</span>
                </div>
            </div>
        @endif
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="labelStyle" for="image">Imatge</label>
            </div>
            <div class="md:w-2/3">
                <input class="inputStyle" type="file" name="image" accept="image/jpeg" required>
            </div>
        </div>
        @if ($errors->has('image'))
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="labelStyle">Error</label>
                </div>
                <div class="md:w-2/3">
                    <span class="text-sm bg-red-300 border border-red-500 text-gray-700 py-3 px-4 pr-8 rounded">{{ $errors->first('image') }}</span>
                </div>
            </div>
        @endif
        <div class="md:flex md:items-center">
            <div class="md:w-1/3">
            </div>
            <div class="md:w-2/3">
                <button class="boton" type="submit">
                    Editar
                </button>
            </div>
        </div>
    </form>
@endsection
