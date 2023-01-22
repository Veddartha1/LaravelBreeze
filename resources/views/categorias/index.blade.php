@extends('layouts.layout')
@section('title', 'Índex de categories')
@section('content')

    @if(Auth::check())
        @if(Auth::check() && Auth::user()->rols()->first()->pivot->rol_id === 1)
            <div class="flex mb-5 px-2 py-2 rounded bg-gray-100">
                <a class="px-4" href="{{  route('categorias.create') }}">Afegir Categoria</a>
                <a class="px-4" href="{{  route('categorias.index') }}">Vore Categories</a>
            </div>
        @endif
    @endif
    <div>
        <h2 class="my-4">Llistat de categories</h2>
    </div>
    <table class="table-auto table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Imatge</th>
            <th>Accions</th>
        </tr>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>
                    @if(file_exists('storage/img/' . $category->image))
                        <img src="{{ asset('storage/img/' . $category->image)}}" alt="ganga{{$category->id}}">
                    @else
                        <img src="storage/img/default.jpeg" alt="ganga{{$category->id}}">
                    @endif
                </td>
                <td>
                    <div>
                        <div class="my-2 mx-2 inline-block">
                            <form action="{{ route('categorias.destroy', $category->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button  class="boton">Esborrar</button>
                            </form>
                        </div>
                        <div class="my-2 mx-2 inline-block">
                            <button class="boton">
                                <a href="{{ route('categorias.edit', $category->id) }}" >Editar</a>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="my-3">
        {{$categories->links()}}
    </div>
@endsection
