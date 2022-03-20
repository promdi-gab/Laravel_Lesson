@extends('layouts.base')
@section('body')
<div class="container">
  <br />
  @if ( Session::has('success'))
  <div class="alert alert-success">
    <p>{{ Session::get('success') }}</p>
  </div><br />
  @endif
  <table class="table table-striped">
    <tr>{{ link_to_route('listener.create', 'Add new listener:')}}</tr>
    <thead>
      <tr>
        <th>listener ID</th>
        <th>listener Name</th>
        <th>Albums</th>
        <th colspan="2">Action</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($listeners as $listener)
      <td>{{$listener->id}}</td>
      <td>{{$listener->listener_name}}</td>
      <td>
        <li>{{$listener->album_name}} </li>
      </td>
      <td align="center"><a href="{{route('listener.edit',$listener->id)}}">
          <i class="fa-regular fa-pen-to-square" aria-hidden="true" style="font-size:24px"></i></a>
      </td>
      <td align="center">{!! Form::open(array('route' => array('listener.destroy', $listener->id),'method'=>'DELETE'))
        !!}
        <button><i class="fa-solid fa-trash-can" style="font-size:24px; color:red"></i></button>
        {!! Form::close() !!}
      </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection