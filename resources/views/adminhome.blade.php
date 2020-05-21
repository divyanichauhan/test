@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are Admin.
                    <!-- As a link -->
                        <nav class="navbar navbar-light bg-light m-2">
                          <a class="navbar-brand" href="{{route('category.index')}}">Category</a>
                        </nav>

                        <!-- As a heading -->
                        <nav class="navbar navbar-light bg-light m-2">
                          <span class="navbar-brand mb-0 h1">Product</span>
                        </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection