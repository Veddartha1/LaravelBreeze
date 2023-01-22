@extends('layouts.layout')
@section('title', 'Editar ganga')
@section('content')
    <div class="w-full max-w-sm">
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <h2>Editar Ganga {{$ganga->name}}</h2>
            </div>
        </div>
    </div>
    <form novalidate class="w-full max-w-lg" action="{{ route('gangas.update', $ganga->id) }}" method='POST' enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="labelStyle" for="title">T&iacute;tol</label>
            </div>
            <div class="md:w-2/3">
                <input class="inputStyle" id="inline-full-name" type="text" name="title" value="{{$ganga->title}}" minlength="5" required>
            </div>
        </div>
        @if ($errors->has('title'))
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="labelStyle">Error</label>
                </div>
                <div class="md:w-2/3">
                    <span class="text-sm bg-red-300 border border-red-500 text-gray-700 py-3 px-4 pr-8 rounded">{{ $errors->first('title') }}</span>
                </div>
            </div>
        @endif
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="labelStyle" for='description'>Descripci&oacute;</label>
            </div>
            <div class="md:w-2/3">
                <textarea class="inputStyle" name='description' rows="5" cols="60" minlength="10" required>{{$ganga->description}}</textarea>
            </div>
        </div>
        @if ($errors->has('description'))
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="labelStyle">Error</label>
                </div>
                <div class="md:w-2/3">
                    <span class="text-sm bg-red-300 border border-red-500 text-gray-700 py-3 px-4 pr-8 rounded">{{ $errors->first('description') }}</span>
                </div>
            </div>
        @endif
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="labelStyle" for="url">Url</label>
            </div>
            <div class="md:w-2/3">
                <input class="inputStyle" pattern="/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/" type="text" name="url" value="{{$ganga->url}}" required>
            </div>
        </div>
        @if ($errors->has('url'))
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="labelStyle">Error</label>
                </div>
                <div class="md:w-2/3">
                    <span class="text-sm bg-red-300 border border-red-500 text-gray-700 py-3 px-4 pr-8 rounded">{{ $errors->first('url') }}</span>
                </div>
            </div>
        @endif
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label for="category_id" class="labelStyle">
                    Categor&iacute;a
                </label>
            </div>
            <div class="relative">
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="category_id" id="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id === $ganga->category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if ($errors->has('category_id'))
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="labelStyle">Error</label>
                </div>
                <div class="md:w-2/3">
                    <span class="text-sm bg-red-300 border border-red-500 text-gray-700 py-3 px-4 pr-8 rounded">{{ $errors->first('category_id') }}</span>
                </div>
            </div>
        @endif
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="labelStyle" for="price">Preu</label>
            </div>
            <div class="md:w-2/3">
                <input class="inputStyle" type="number" step="0.01" name="price" value="{{$ganga->price}}" min="1" required>
            </div>
        </div>
        @if ($errors->has('price'))
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="labelStyle">Error</label>
                </div>
                <div class="md:w-2/3">
                    <span class="text-sm bg-red-300 border border-red-500 text-gray-700 py-3 px-4 pr-8 rounded">{{ $errors->first('price') }}</span>
                </div>
            </div>
        @endif
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="labelStyle" for="price_sale">Preu ganga</label>
            </div>
            <div class="md:w-2/3">
                <input class="inputStyle" type="number" step="0.01" min="1" name="price_sale" value="{{$ganga->price_sale}}"required>
            </div>
        </div>
        @if ($errors->has('price_sale'))
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="labelStyle">Error</label>
                </div>
                <div class="md:w-2/3">
                    <span class="text-sm bg-red-300 border border-red-500 text-gray-700 py-3 px-4 pr-8 rounded">{{ $errors->first('price_sale') }}</span>
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
        <div class="md:flex md:items-center mb-6 form-check">
            <div class="md:w-1/3">
                <label class="labelStyle" for="available">Available</label>
            </div>
            <div>
                <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-gray-600 checked:border-gray-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                       type="checkbox" name="available" {{$ganga->available ? 'checked' : ''}}>
            </div>
        </div>
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
