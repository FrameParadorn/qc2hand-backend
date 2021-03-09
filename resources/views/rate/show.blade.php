@extends('layouts.app')

@section('content')

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Rate Management</h4> 
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title" style="float: left">จัดการรูปภาพตัวเลือก {{ $type->name }}</h3>
                <div class="clearfix"></div>
                  <label class="btn btn-primary">
                    อัพโหลดรูปใหม่
                    <input type="file" style="display: none" id="upload-input" accept="image/*" name="file">
                  </label>
                <br>
                <img src="{{ $type->image }}" style="width: 100px; margin-top: 30px;" id="image-preview">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title" style="float: left">จัดการตัวเลือก</h3>
                <a href="/rate-template/{{ $type->id }}/create" style="float: right">
                  <button class="btn btn-danger btn-sm" >สร้างรายการตัวเลือกใหม่</button>
                </a>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อตัวเลือก</th>
                                <th>ประเภทตัวเลือก</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($rate AS $key => $item)
                          <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->display_type }}</td>
                            <td>
                              <a href="/rate-template/{{ $type->id }}/edit/{{ $item->id }}">
                                <button class="btn btn-danger btn-sm">Manage</button>
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

