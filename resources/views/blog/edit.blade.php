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
              <div class="clearfix"></div>
              <form method="POST" action="/blog/{{ $blog->id }}" enctype="multipart/form-data" class="form-blog">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <button class="btn btn-success btn-save" style="float: right" type="button">
                  <i class="fa fa-floppy-o" aria-hidden="true"></i>
                  Save 
                </button>
								<div class="form-row">
										<div class="col-md-12 mb-3">
												<label for="validationServer01">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
										</div>
										<div class="col-md-12 mb-3" style="margin-top: 15px">
												<label>Image cover</label>
												<input type="file" name="cover" class="form-control" value=""required>
                        <img src="/storage/image/{{ $blog->cover }}" style="width: 100px; margin-top: 10px">
										</div>
										<div class="col-md-12 mb-3" style="margin-top: 20px">
												<label>Content Web</label>
                        <br>
                        <button class="btn add-image" style="margin-bottom: 5px" type="button" ck="editor_web">
                          Add Image
                        </button>
                        <br>
                        <textarea id="editor_web" name="content_web" cols="80" rows="10">{{ $blog->content_web }}</textarea>
										</div>
										<div class="col-md-6 mb-3" style="margin-top: 15px">
												<label for="validationServer02">Content Mobile</label>
                        <br>
                        <button class="btn add-image" style="margin-bottom: 5px" type="button" ck="editor_mobile">
                          Add Image
                        </button>
                        <br>
                        <textarea id="editor_mobile" name="content_mobile" cols="80" rows="20">{{ $blog->content_mobile }}</textarea>
										</div>
                    <script src="/plugins/ckeditor/ckeditor.js"></script>
                </div>
                <div class="clearfix"></div>
							</form>
            </div>
        </div>
    </div>
</div>

<input type="file" class="input-upload" style="display: none">

@endsection


