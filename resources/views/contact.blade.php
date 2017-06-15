@extends('layouts.app')

@section('content')

  <h1>Contact Page Nueva</h1>

  @if (count($people))

  <ul>
    @foreach($people as $person)
      <li>{{$person}}</li>
    @endforeach
  </ul>
  @endif

@stop

@section('footer')

  <script>alert("Hola loco");

  </script>

@stop
