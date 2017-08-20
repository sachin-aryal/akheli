@extends('layouts.app')

@section('content')

    <div class="inner-wrapper">
        <div class="title-wrapper">
            <h2>Create the project</h2>
            <div class="title-bottom-dash"></div>
        </div>
        <div class="box-body">
            <form enctype="multipart/form-data" action="/product" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" id="category" name="category">
                </div>
                <div class="form-group">
                    <label for="size">Size:</label>
                    <input type="text" class="form-control" id="size" name="size">
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="form-group">
                    <label for="min_order">Min-order:</label>
                    <input type="text" class="form-control" id="min_order" name="min_order">
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
                <div class="form-group">

                    <input type="file" id="image" name="image">
                </div>
                <button type="submit" class="btn primary-btn">Submit</button>
            </form>
        </div>
    </div>
@endsection