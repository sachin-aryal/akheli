@extends('layouts.app')

@section('content')

    <div class="col-lg-offset-4 col-lg-4l">
        <h1>View Products</h1>
        <a href='/product/create' class="btn btn-success">Add product</a>
        <ul></ul>
            @foreach($products as $product)

            <section class="row new-post">
                <div class="col-md-6 col-md-offset-3">
                    <a href="{{'product/'.$product->id}}"><img src="{{Storage::url($product->image)}}" alt="" class="img-responsive"></a>
                </div>
            </section>
                <li>{{$product->size}}</li>
                <li>{{$product->color}}</li>
            @endforeach
    </div>
@endsection