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
                <h3 class="box-title" style="float: left">จัดการประเภท {{ $type->name }}</h3>
                <div class="clearfix"></div>
                  <label class="btn btn-primary">
                    อัพโหลดรูปใหม่
                    <input type="file" style="display: none" id="upload-input" accept="image/*" name="file">
                  </label>
                <br>
                <img src="{{ $type->image }}" style="width: 100px; margin-top: 30px;" id="image-preview">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title" style="float: left">รายการตัวเลือก {{ $type->name }}</h3>
                <a href="/rate-template/{{ $type->id }}/create">
                  <button class="btn btn-danger btn-sm" style="float: right">Create</button>
                </a>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Display Type</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section("js")
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#image-preview').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $("#upload-input").change(function() {
    readURL(this);

    var formData = new FormData();
    formData.append('file', $(this)[0].files[0]);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
      url : '/rate/{{$type->id}}',
      type : 'POST',
      data : formData,
      processData: false,  // tell jQuery not to process the data
      contentType: false,  // tell jQuery not to set contentType
      success : function(data) {
        console.log(data);
      }
    });
  });
</script>
@endsection

