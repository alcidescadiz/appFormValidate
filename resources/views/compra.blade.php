@extends('layouts.app')
@section('title', __('Welcome'))
@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{URL::to('/compra')}}" method="post" style="width: 350PX">
        {!! csrf_field() !!}

        <div class="form-group">
        <label for="">Cliente</label>
        <input type="text" class="form-control" name="cliente" placeholder="Ingrese nombre del cliente">
        

        </div>
        <div class="form-group">
        <label for=""></label>
        <input type="text" class="form-control" step="0.01" name="monto" id="monto" aria-describedby="helpId" placeholder="">

        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    <BR>
    <div class="container">
        @foreach ($compras as $item)
            <li>{{$item->id.'--'.$item->cliente.'--'.$item->monto}} </li>
            <br>
        @endforeach 
    </div>
       















</div>
</div>
@endsection