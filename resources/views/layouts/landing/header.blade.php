<header class="bg-light">
  <div class="container ">
      <nav class="navbar navbar-expand-lg navbar-light p-4" style="min-height:135px;">
          <a class="navbar-brand" href="#"><h2><strong>LinkBuilding</strong></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('services') }}"><span class="text-dark"><strong>DOMÆNERNE</strong></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('priser') }}"><span class="text-dark"><strong>PRISER</strong></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{  route('kontakt') }}"><span class="text-dark"><strong>KONTAKT</strong></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}"><strong class="border py-2 px-3 text-primary">LOGIN</strong></a>
              </li>

            </ul>
          </div>
      </nav>
      <div class="title">
        <h2 class="text-center text-dark pt-3 pb-5"><b>@yield('title')</b></h2>
      </div>
    </div>
</header>