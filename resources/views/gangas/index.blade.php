@extends('layouts.layout')
@section('title', 'Índex de gangues')
@section('content')
    <h2>Llistat de gangues</h2>
    <table class="table">
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
            <th>Preu de Ganga</th>
            <th>Usuari</th>
        </tr>
        <tbody>
        @foreach($gangas as $ganga)
            <tr>
                <td>{{$ganga->id}}</td>
                <td>{{$ganga->available ? 'Sí' : 'No'}}</td>
                <td><img src="{{ asset('storage/img/' . $ganga->id . '-ganga-severa.jpeg') }}" alt="ganga{{$ganga->id}}"></td>
                <td>{{ $ganga->title }}</td>
                <td>{{$ganga->description}}</td>
                <td>{{$ganga->url}}</td>
                <td>{{$ganga->category->name}}</td>
                <td>{{$ganga->likes}}</td>
                <td>{{$ganga->unlikes}}</td>
                <td>{{$ganga->price}}</td>
                <td>{{$ganga->price_sale}}</td>
                <td>{{$ganga->user->name}}</td>
                <td>
                    <div class="inline-flex">
                        <form action="{{ route('gangas.show', $ganga->id) }}" method="GET">
                            <button class="boton">Vore</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>
                {{$gangas->links()}}
            </th>
        </tr>
        </tfoot>
    </table>
    @if(Auth::check())
        <a class="boton my-2" href="{{  route('gangas.create') }}">Crear Ganga</a>
        <form method="POST" action="{{route('logout')}}">
            @csrf
            <button class="boton my-2" type="submit">Logout</button>

        </form>
    @else
        <a class="boton my-2" href="{{route('login')}}">Login</a>
        <p>O registrat si encara no ho estàs</p>
        <a class="boton my-2" href="{{route('register')}}">Registre</a>
    @endif
@endsection
