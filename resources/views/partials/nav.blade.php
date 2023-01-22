<nav class="flex mb-5 px-2 py-2 rounded bg-gray-700 text-lg text-white">
    <a class="px-4" href="{{  route('index') }}">Inici</a>
    <a class="px-4" href="{{  route('latest') }}">Nous</a>
    <a class="px-4" href="{{  route('featured') }}">Destacats</a>
    @if(Auth::check())
        <a class="px-4" href="{{  route('owned') }}">Pàgina de {{Auth::user()->name}}</a>
        <form method="POST" action="{{route('logout')}}">
            @csrf
            <button class="px-4" type="submit">Logout</button>
        </form>
    @else
        <a class="px-4" href="{{route('login')}}">Login</a>
        <a class="px-4" href="{{route('register')}}">Registre</a>
    @endif


</nav>
