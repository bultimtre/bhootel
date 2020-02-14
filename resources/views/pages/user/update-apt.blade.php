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
        <form action="{{ route('index.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
          {{-- <div class="form-group">
            <input type="file" name="imagefile"><br>
          </div> --}}

          <div class="form-group">
              <label for="description">Title</label>
          <input value="{{$apartment->description}}" id="apart-title" class="form-control" name="description" type="text" placeholder="Inserisci un titolo" />
          </div>
          <div class="form-group">
              <label for="address">Address</label>
              <input value="{{$apartment->address}}" id="apart-address" class="form-control" name="address" type="text" placeholder="Inserisci un indirizzo" />
          </div>

          <div class="form-group">
              <label for="rooms">rooms</label>
              <input value="{{$apartment->rooms}}" id="apart-rooms" class="form-control" name="rooms" type="text" placeholder="Inserisci un indirizzo" />
          </div>
          <div class="form-group">
              <label for="beds">beds</label>
              <input value="{{$apartment->beds}}" id="apart-beds" class="form-control" name="beds" type="text" placeholder="Inserisci un indirizzo" />
          </div>
          <div class="form-group">
              <label for="bath">bath</label>
              <input value="{{$apartment->bath}}" id="apart-bath" class="form-control" name="bath" type="text" placeholder="Inserisci un indirizzo" />
          </div>
          <div class="form-group">
              <label for="square_mt">square_mt</label>
              <input value="{{$apartment->square_mt}}" id="apart-square_mt" class="form-control" name="square_mt" type="text" placeholder="Inserisci un indirizzo" />
          </div>

          <div class="form-group">
            @foreach ($configs as $config)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="config-check" name="configs_id[]" value="{{ $config->id }}"
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
              <input type="submit" class="btn btn-primary" value="Aggiorna"/>
          </div>
        </form>
      </div>


    </div>
  </div>
@endsection
