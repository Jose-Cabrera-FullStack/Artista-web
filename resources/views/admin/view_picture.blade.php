
@extends('layouts.adminLayout.admin_design')
@section('content')
    <div class="container-fluid">
      <hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>View Product</h5>
            </div>
            <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>Picture ID</th>
                    <th>Picture Name</th>
                    <th>Description</th>
                    <th>Image</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pictures as $picture)
                  <tr class="gradeX">
                    <td class="center">{{$picture->id}}</td>
                    <td class="center">{{$picture->name}}</td>
                    <td class="center">{{$picture->description}}</td>
                  <td>
                    @if(!empty($picture->image))
                    <img src="{{ asset('images/'. $picture->image)}}" style="width: 50px">
                    @endif
                  </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection