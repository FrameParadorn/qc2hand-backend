@extends('layouts.app')

@section('content')

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Blog</h4> 
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
              <h3 class="box-title" style="float: left">Blog list</h3>
              <a href="/blog/create">
                <button class="btn btn-primary" style="float: right">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                  New blog
                </button>
              </a>
              <div class="clearfix"></div>
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th class="text-center" style="width: 100px;">Cover</th>
                              <th>Title</th>
                              <th class="text-center">Create at</th>
                              <th class="text-center">Update at</th>
                              <th class="text-center">Options</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php $no = sizeof($blogs) @endphp
                        @foreach($blogs AS $i => $blog)
                        <tr>
                          <td>{{ $no - $i }}</td>
                          <td style="text-align: center">
                            <img src="/storage/image/{{ $blog->cover }}" style="width: 50px">
                          </td>
                          <td>{{ $blog->title }}</td>
                          <td class="text-center">{{ date('d/m/Y H:i', strtotime($blog->created_at)) }}</td>
                          <td class="text-center">{{ date('d/m/Y H:i', strtotime($blog->updated_at)) }}</td>
                          <td class="text-center" style="width: 150px;">
                            <form action="/blog/{{ $blog->id }}" method="POST">
                              @csrf
                              @method('delete')
                              <a href="/blog/{{ $blog->id }}/edit">
                                <button class="btn btn-warning" type="button">Edit</button>
                              </a>
                              <button class="btn btn-danger">Delete</button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  {{ $blogs->links() }}
              </div>
            </div>
        </div>
    </div>
</div>


@endsection


