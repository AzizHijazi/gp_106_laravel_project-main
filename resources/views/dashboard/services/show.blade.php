@extends('layouts.dashboard.parent')
@section('header_title','Show Service')
@section('page_title','Show')
@section('home_page')
  {{route('home')}}
@endsection
@section('content')
@section('style')
<link rel="stylesheet" href="{{asset('assets/plugins/ekko-lightbox/ekko-lightbox.css')}}"> 
@endsection
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="image-container">
                        <div class="text-center">
                            <div class="card card-widget widget-user">
                                <img src="{{url($services->image)}}" class="img-fluid mb-2"  width="300px"/>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3 class="widget-user-username text-left">{{ $services->name }}</h3>
                </div>
            </div>
            <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">About {{ $services->name }} Service</h3>
              </div>
              <div class="card-body">
                  <strong><i class="fa-solid fa-circle-info"></i> Info</strong>
                  <p class="text-muted">{{ $services->info }}</p>
                  <hr>
                  <strong><i class="fa-solid fa-address-card"></i> Status</strong>
                  <p class="text-muted">
                      <span class="tag tag-danger">{{ $services->visibilty }}</span>
                  </p>
                  <hr>
              </div>
          </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

