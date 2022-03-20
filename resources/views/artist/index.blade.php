{{-- @extends('layouts.base') --}}
@extends('layouts.app')
@section('content')
<div class="container">
  <br />
  @if ( Session::has('success'))
  <div class="alert alert-success">
    <p>{{ Session::get('success') }}</p>
  </div><br />
  @endif
  <table class="table table-striped">
    <tr>{{ link_to_route('artist.create', 'Add new artist:')}}</tr>
    <thead>
      <tr>
        <th>Artist ID</th>
        <th>Artist Name</th>
        <th>Album Name</th>
        <th>Img</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      {{-- dd($artists) --}}
      @foreach($artists as $artist)
      <tr>
        <td>{{$artist->id}}</td>
        <td>{{$artist->artist_name}}</td>
        <td>{{$artist->album_name}}</td>
        <td>
          <img src="{{ asset('storage/'.$artist->img_path)}}" alt="I am A Pic" width="75" height="75">
        </td>
        <td>
         
        <td>
          {{-- @foreach($artist->albums as $art)
          <ul>{{ $art->id . $art->name}}</ul>
          @endforeach --}}
        </td>
        <td><a href="{{ route('artist.show', $artist->id ) }}" class="btn btn-warning">show</a></td>
        <td>
        <td align="center"><a href="{{route('artist.edit',$artist->id)}}">
            <i class="fa-regular fa-pen-to-square" aria-hidden="true" style="font-size:24px"></i></a>
        </td>
        <td align="center">{!! Form::open(array('route' => array('artist.destroy', $artist->id),'method'=>'DELETE')) !!}
          <button><i class="fa-solid fa-trash-can" style="font-size:24px; color:red"></i></button>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection