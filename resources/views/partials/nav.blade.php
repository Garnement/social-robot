<nav>
  <div class="nav-wrapper blue darken-1">
    <a href="{{route('home')}}" class="brand-logo">FB Robot</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      @foreach ($categories as $category)
      <li><a href="{{ route('category', [$category->id, $category->slug]) }}">{{$category->title}}</a></li>
      @endforeach
      
      @if (auth()->check())
        <li><a href="{{ url('dashboard/profile') }}">Profil</a></li>
        <li><a href="{{route('logout')}}">Sign out</a></li>
      @else
        <li><a href="{{url('login')}}">Sign in</a></li>
      @endif
  
    </ul>

    <ul class="side-nav" id="mobile-demo">
      @foreach($categories as $category)
      <li><a href="/category/{{$category->id}}/{{$category->slug}}">{{$category->title}}</a></li>
      @endforeach
      @if (auth()->check())
        <li><a href="{{ url('dashboard/profile') }}">Sign out</a></li>
      @else
        <li><a href="{{url('login')}}">Sign in</a></li>
      @endif
    </ul>
  </div>
</nav>
