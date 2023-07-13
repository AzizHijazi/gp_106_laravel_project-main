@extends('layouts.dashboard.parent')
@section('header_title','Show Desk  ')
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
                <!-- Hub card -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <!-- Hub image -->
                        <div class="image-container">
                            <div class="card card-widget widget-user">
                              <img src="{{url($desks->image)}}" class="img-fluid mb-2"  width="300px"/>
                            </div>
                        </div>
                        <hr>
                        <!-- Hub name and stats -->
                        <h3 class="widget-user-username text-left">{{ $desks->name }}</h3>

                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About {{$desks->desk_code}} Desk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <strong><i class="fa-solid fa-building"></i> Number</strong>
                      <p class="text-muted">{{$desks->desk_code }}</p>
                      <hr>
                          <strong><i class="fa-sharp fa-solid fa-money-bill"></i> Price</strong>
                        <p class="text-muted">{{$desks->price}}</p>
                        <hr>
                        <strong><i class="fa-solid fa-address-card"></i> status</strong>
                        <p class="text-muted">
                            <span class="tag tag-danger">{{$desks->visibilty}}</span>
                        </p>
                        <hr>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            
            <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="activity">
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset($desks->image)}}" alt="User Image">
                            <span class="username">
                              <a href="#">{{$desks->desk_code}}</a>
                            </span>
                            <span class="description">Shared publicly - {{$desks->created_at}}</span>
                          </div>
                          <!-- /.user-block -->
                          <p>{{$desks->desk_code}}</p>
                        </div>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="timeline">
                        <div class="timeline timeline-inverse">
                          <!-- timeline time label -->
                          <div class="time-label">
                            <span class="bg-danger">
                              {{$desks  ->created_at->format('d M. Y')}}
                            </span>
                          </div>
                          <!-- /.timeline-label -->
                          <!-- timeline item -->
                          <div>
                            <i class="fa fa-info bg-blue"></i>
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 12:05</span>
                              <h3 class="timeline-header"><a href="#">New service launched</a></h3>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline item -->
                          <div>
                            <i class="fa fa-user bg-gray"></i>
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 10:20</span>
                              <h3 class="timeline-header"><a href="#">John Doe</a> joined the service</h3>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline item -->
                          <div>
                            <i class="fa fa-comments bg-yellow"></i>
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 09:50</span>
                              <h3 class="timeline-header"><a href="#">Jane Smith</a> commented on <a href="#">your post</a></h3>
                              <div class="timeline-body">
                                Nice one, keep it up!
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->
                        </div>
                        <!-- /.timeline -->
                      </div>
                    </div>
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection



