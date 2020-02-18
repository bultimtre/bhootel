<div class="container search">
  <form class="form-inline mt-2 mt-md-0" action="{{route(Auth::user()?'user.search':'guest.search')}}" method="post">
      @csrf
      @method('POST')
      <label for="search_field"></label>
      <input class="form-control mr-sm-2" name='search_field' type="text">

      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Cerca </button>
  </form>
</div>