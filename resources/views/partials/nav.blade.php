<nav class="flex mb-5 px-2 py-2 rounded bg-gray-700 text-lg text-white">
    <a class="px-4" href="{{  route('index') }}">Inici</a>
    <a class="px-4" href="{{  route('latest') }}">Nous</a>
    <a class="px-4" href="{{  route('featured') }}">Destacats</a>
    @if(Auth::check())
        <a class="px-4" href="{{  route('owned') }}">Gangues de {{Auth::user()->name}}</a>
    @endif
</nav>
