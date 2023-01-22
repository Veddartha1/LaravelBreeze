@extends('layouts.layout')
@section('title', 'Veure ganga')
@section('content')
    <h1>Fitxa de la ganga {{ $ganga->titol }}</h1>
    <table class="table-auto table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Imatge</th>
            <th>Titol</th>
            <th>Descripci&oacute;</th>
            <th>Url</th>
            <th>Categoria</th>
            <th>Likes</th>
            <th>Dilikes</th>
            <th>Preu</th>
            <th>Ganga</th>
            <th>Usuari</th>
            <th>Data de creaci&oacute;</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$ganga->id}}</td>
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
            <td>{{$ganga->likes}}</td>
            <td>{{$ganga->unlikes}}</td>
            <td>{{$ganga->price}}€</td>
            <td>{{$ganga->price_sale}}€</td>
            <td>{{$ganga->user->name}}</td>
            <td>{{Carbon\Carbon::parse($ganga->created_at)->format('d/m/Y')}}</td>
        </tr>
        </tbody>
    </table>
    @if((Auth::check() && Auth::id() === $ganga->user->id) || (Auth::check() && Auth::user()->rols()->first()->pivot->rol_id === 1))
        <div>
            <div class="my-2 mx-2 inline-block">
                <form action="{{ route('gangas.destroy', $ganga->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button  class="boton">Esborrar</button>
                </form>
            </div>
            <div class="my-2 mx-2 inline-block">
                <button class="boton">
                    <a href="{{ route('gangas.edit', $ganga->id) }}" >Editar</a>
                </button>
            </div>
        </div>
    @endif
@endsection
