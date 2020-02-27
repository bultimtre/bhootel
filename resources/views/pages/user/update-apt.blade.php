@extends('layouts.user-aparts')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Aggiorna appartamento</h1>
      </div>
      <div class="col-12">

      </div>
      <div class="col-12">
        <form action="" class="addApartForm" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label for="formControlFile1">Inserisci immagine</label>
            <input type="file" class="form-control-file" name="imagefile" id="formControlFile1">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" value="{{$apartment->id}}" name="id" style="display:none">
          </div>

          <div class="form-group">
              <label for="description">Titolo</label>
          <input value="{{$apartment->title}}" id="apart-title" class="form-control" name="title" type="text" placeholder="Inserisci titolo"
          required data-parsley-maxlength="80" data-parsley-trigger="keyup"/>
          </div>
          
          <div class="form-group">
              <label for="description">Descrizione</label>
          <input value="{{$apartment->description}}" id="apart-title" class="form-control" name="description" type="text" placeholder="Inserisci descrizione"
          required data-parsley-maxlength="850" data-parsley-trigger="keyup"/>
          </div>

          <div class="form-group">
              <label for="address">Address</label>
              <input value="{{$apartment->address}}" id="apart-address" class="form-control" name="address" type="text" placeholder="Inserisci un indirizzo"
              required data-parsley-maxlength="255" data-parsley-trigger="keyup"/>
          </div>

          <div class="form-group">
              <label for="rooms">rooms</label>
              <input value="{{$apartment->rooms}}" id="apart-rooms" class="form-control" name="rooms" type="text" placeholder="Inserisci il numero di stanze"
              required data-parsley-type="integer" data-parsley-range="[1, 200]" data-parsley-trigger="keyup"
              data-parsley-range-message="exceed the maximum limit" />
          </div>
          <div class="form-group">
              <label for="beds">beds</label>
              <input value="{{$apartment->beds}}" id="apart-beds" class="form-control" name="beds" type="text" placeholder="Inserisci il numero di letti"
              required data-parsley-type="integer" data-parsley-range="[1, 200]" data-parsley-trigger="keyup"
              data-parsley-range-message="exceed the maximum limit" />
          </div>
          <div class="form-group">
              <label for="bath">bath</label>
              <input value="{{$apartment->bath}}" id="apart-bath" class="form-control" name="bath" type="text" placeholder="Inserisci il numero di bagni"
              required data-parsley-type="integer" data-parsley-range="[1, 200]" data-parsley-trigger="keyup"
              data-parsley-range-message="exceed the maximum limit" />
          </div>
          <div class="form-group">
              <label for="square_mt">square_mt</label>
              <input value="{{$apartment->square_mt}}" id="apart-square_mt" class="form-control" name="square_mt" type="text" placeholder="Inserisci i metri quadrati"
              required data-parsley-type="integer" data-parsley-range="[1, 10000]" data-parsley-trigger="keyup"
              data-parsley-range-message="exceed the maximum limit" />
          </div>

          <div class="form-group">
            @foreach ($configs as $config)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" class="config-check" name="configs_id[]" value="{{ $config->id }}"
                    @if ($apartment -> configs() ->find($config ->id)) checked @endif>
                    <label class="form-check-label" for="config-check">
                        {{ $config->service }}
                    </label>
                </div>
            @endforeach
          </div>

          <div class="form-group">
            <label for="show">Rendi l'annuncio visibile a tutti?</label>
            <select class="form-control" name="show">
                <option {{ $apartment -> show == "1" ? 'selected' : '' }} value="1">Si</option>
                <option {{ $apartment -> show == "0" ? 'selected' : '' }} value="0">No</option>
            </select>
          </div>

          <div class="form-group">
              <input type="submit" class="btn btn-primary apartment-submit" value="Aggiorna"/>
          </div>
        </form>
      </div>


    </div>
  </div>
@endsection
