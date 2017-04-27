<nav>
  <div class="nav-wrapper blue darken-1">
    <a href="{{route('home')}}" class="brand-logo">FB Robot</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      @foreach ($categories as $category)
      <li><a href="{{ route('category', [$category->id, $category->slug]) }}">{{$category->title}}</a></li>
      @endforeach
      <li><a href="{{url('login')}}">Sign out</a></li>
    </ul>

    <ul class="side-nav" id="mobile-demo">
      @foreach($categories as $category)
      <li><a href="/category/{{$category->id}}/{{$category->slug}}">{{$category->title}}</a></li>
      @endforeach
      <li><a href="{{route('home')}}">Sign in</a></li>
    </ul>
  </div>
</nav>