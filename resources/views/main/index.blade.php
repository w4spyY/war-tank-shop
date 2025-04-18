@extends('layouts.app')

@section('content')
  <!--anuncios-->
  @include('layouts.advertisement')

  <!--listado tanques-->
  @include('main.tanks-list')
@endsection