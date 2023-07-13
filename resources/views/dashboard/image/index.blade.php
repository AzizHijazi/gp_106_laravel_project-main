@extends('layouts.dashboard.parent')

@section('header_title','Index Images')
@section('page_title','Index Images')
@section('home_page')
{{route('home')}}
@endsection

@section('style')
<style>
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .card-tools {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .create-btn {
    margin-left: auto;
  }
 </style>
@endsection

@section('content')
@if ($errors->any())
<div class="card-body">
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
</div>
@endif
<hr>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h4 class="card-title">Images</h4>
          <div class="create-btn">
            <a class="btn btn-success" href="{{route('image.create')}}">إضافة</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            @foreach ($data as $data)
            <div class="col-sm-2">
              <a href="{{url($data->image)}}" data-toggle="lightbox" data-title="{{$loop->index + 1}}" data-gallery="gallery">
                <img src="{{url($data->image)}}" class="img-fluid mb-2"  width="200px"/>
              </a>
              <p>{{$data->gallerys->name}}</p>
              <form action="{{route('image.destroy',$data->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


@endsection

@section('script')

    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Ekko Lightbox -->
    <script src="{{asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- Filterizr-->
    <script src="{{asset('assets/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
    <!-- Page specific script -->
    <script>
      $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox({
            alwaysShowClose: true
          });
        });
    
        $('.filter-container').filterizr({gutterPixels: 3});
        $('.btn[data-filter]').on('click', function() {
          $('.btn[data-filter]').removeClass('active');
          $(this).addClass('active');
        });
      })
  </script>
  
@endsection