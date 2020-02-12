@extends('layouts.user-aparts')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Insert New Apartment: (create userApartments)</h1>
      </div>
      <div class="col-12">

      </div>
      <div class="col-12">
        <form action="" method="post" id="addApartForm" enctype="multipart/form-data">

          <div class="form-group">
            <input type="file" name="imagefile"><br>
          </div>

          <div class="form-group">
              <label for="description">Title</label>
              <input value="" id="apart-title" class="form-control" name="description" type="text" placeholder="Inserisci un titolo" />
          </div>
          <div class="form-group">
              <label for="address">Address</label>
              <input value="" id="apart-address" class="form-control" name="address" type="text" placeholder="Inserisci un indirizzo" />
          </div>

          <div class="form-group">
              <label for="rooms">rooms</label>
              <input value="" id="apart-rooms" class="form-control" name="rooms" type="text" placeholder="Inserisci un indirizzo" />
          </div>
          <div class="form-group">
              <label for="beds">beds</label>
              <input value="" id="apart-beds" class="form-control" name="beds" type="text" placeholder="Inserisci un indirizzo" />
          </div>
          <div class="form-group">
              <label for="bath">bath</label>
              <input value="" id="apart-bath" class="form-control" name="bath" type="text" placeholder="Inserisci un indirizzo" />
          </div>
          <div class="form-group">
              <label for="square_mt">square_mt</label>
              <input value="" id="apart-square_mt" class="form-control" name="square_mt" type="text" placeholder="Inserisci un indirizzo" />
          </div>

          <div class="form-group">
              <input type="submit" class="btn btn-primary" id="create-apartment" value="Create" />
          </div>
        </form>
      </div>
        
      
    </div>
  </div>
@endsection