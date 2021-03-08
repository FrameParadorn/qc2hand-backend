@extends('layouts.app')

@section('content')

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Rate Management</h4> 
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">รายการประเภทอุปกรณ์ทั้งหมด</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($types AS $i => $type)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td><img src="{{ $type->image }}" style="width: 50px;"></td>
                                <td>{{ $type->name }}</td>
                                <td>
                                  <a href="/rate/{{ $type->id }}">
                                    <button class="btn btn-danger btn-sm">
                                      Manage
                                    </button>
                                  </a>
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

@endsection


