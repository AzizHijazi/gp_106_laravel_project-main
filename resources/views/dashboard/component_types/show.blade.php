@extends('layouts.dashboard.parent')
@section('header_title','Show Component Type')
@section('page_title','Show')
@section('home_page')
  {{route('home')}}
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('assets/plugins/ekko-lightbox/ekko-lightbox.css')}}"> 
@endsection
@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="image-container">
                        <div class="text-center">
                            <div class="card card-widget widget-user">
                                <img src="{{url($component_types->image)}}" class="img-fluid mb-2"  width="300px"/>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3 class="widget-user-username text-left">{{ $component_types->name }}</h3>
                </div>
            </div>
            <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">About {{ $component_types->name }} Component</h3>
              </div>
              <div class="card-body">
                  <strong><i class="fa-solid fa-circle-info"></i> {{$component_types->name}} Description:</strong>
                  <p class="text-muted">{{ $component_types->description }}</p>
                  <hr>
                  <strong><i class="fa-solid fa-address-card"></i> {{$component_types->name}} Count:</strong>
                  <p class="text-muted">
                      <span class="tag tag-danger">{{ $component_types->count }}</span>
                  </p>
                  <hr>
                  <strong><i class="fa-sharp fa-solid fa-money-bill"></i> {{$component_types->name}}  Price:</strong>
                  <p class="text-muted">
                      <span class="tag tag-danger">{{ $component_types->price }}</span>
                  </p>
                  <hr>
                  <strong><i class="fa-solid fa-building"></i>  Hub Name</strong>
                  <p class="text-muted">
                      <span class="tag tag-danger">{{ $component_types->hub->name }}</span>
                  </p>
                  <hr>
              </div>
          </div>
      </div>
        <!-- /.col -->
    </div>
  </section>
@endsection

