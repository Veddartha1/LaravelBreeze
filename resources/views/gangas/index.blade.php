@extends('layouts.layout')
@section('title', 'Índex de gangues')
@section('content')

    @if(Auth::check())
        @if(Auth::check() && Auth::user()->rols()->first()->pivot->rol_id === 1)
            <div class="flex mb-5 px-2 py-2 rounded bg-gray-100">
                <a class="px-4" href="{{  route('categorias.create') }}">Afegir Categoria</a>
                <a class="px-4" href="{{  route('categorias.index') }}">Vore Categories</a>
            </div>
        @endif
        <div class="my-4">
            <a class="boton my-4" href="{{  route('gangas.create') }}">Crear Ganga</a>
        </div>
    @endif
    <div>
        <h2 class="my-4">Llistat de gangues</h2>
    </div>
    <table class="table-auto table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Disponible</th>
            <th>Imatge</th>
            <th>Titol</th>
            <th>Descripci&oacute;</th>
            <th>Url</th>
            <th>Categoria</th>
            <th>Likes</th>
            <th>Dislikes</th>
            <th>Preu</th>
            <th>Ganga</th>
            <th>Usuari</th>
            <th>Accions</th>
        </tr>
        <tbody>
        @foreach($gangas as $ganga)
            <tr>
                <td>{{$ganga->id}}</td>
                <td>{{$ganga->available ? 'Sí' : 'No'}}</td>
                <td>
                    @if(file_exists('storage/img/' . $ganga->id . '-ganga-severa.jpeg'))
                        <img src="{{ asset('storage/img/' . $ganga->id . '-ganga-severa.jpeg')}}" alt="ganga{{$ganga->id}}">
                    @else
                        <img src="storage/img/default.jpeg" alt="ganga{{$ganga->id}}">
                    @endif
                </td>
                <td>{{ $ganga->title }}</td>
                <td>{{$ganga->description}}</td>
                <td><a href="{{$ganga->url}}">{{$ganga->url}}</a></td>
                <td>{{$ganga->category->name}}</td>
                <td>
                    <form method="POST" action="{{route('gangas.like', $ganga->id)}}">
                        @method('PUT')
                        @csrf
                        <button class="boton-like my-2" type="submit">{{$ganga->likes}}</button>
                    </form>
                    </td>
                <td>
                    <form method="POST" action="{{route('gangas.unlike', $ganga->id)}}">
                        @method('PUT')
                        @csrf
                        <button class="boton-unlike my-2" type="submit">{{$ganga->unlikes}}</button>
                    </form>
                    </td>
                <td>{{$ganga->price}}€</td>
                <td>{{$ganga->price_sale}}€</td>
                <td>{{$ganga->user->name}}</td>
                <td>
                    <div>
                        <form action="{{ route('gangas.show', $ganga->id) }}" method="GET">
                            <button class="boton">Vore</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="my-3">
        {{$gangas->links()}}
    </div>
@endsection
