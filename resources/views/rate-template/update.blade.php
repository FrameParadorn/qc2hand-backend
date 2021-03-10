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
              <h3 class="box-title">หัวข้อตัวเลือก</h3>
              <form action="/rate-template/{{ $rateId }}/update/{{ $type->id }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="form-group">
                  <label>ตั้งชื่อ</label>
                  <input 
                    type="text" 
                    name="name" 
                    class="form-control"  
                    placeholder="ประเภท MacBook" 
                    value="{{ $type->name }}"
                    required>
                  <br>
                  <label>เลือกประเภท Input</label>
                  <select class="form-control" name="type" required>
                    <option 
                      value="checkbox" 
                      {{ $type->display_type === "checkbox" ? "selected" : "" }}
                    >
                      Checkbox
                    </option>
                    <option 
                      value="select"
                      {{ $type->display_type === "select" ? "selected" : "" }}
                    >
                      Select
                    </option>
                  </select>
                  <br>
                  <button class="btn btn-success btn-sm" style="float: right">Save</button>
                </div>
              </form>
          </div>
        </div>
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title" style="float: left">รายการตัวเลือกย่อย</h3>
                <button 
                  class="btn btn-danger btn-sm" 
                  style="float: right" 
                  data-toggle="modal" 
                  data-target="#create-subtype-modal"
                >
                  สร้างรายการตัวเลือกย่อยใหม่
                </button>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($items AS $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="item-subtype-name">{{ $item->name }}</td>
                                <td class="item-subtype-price">{{ empty($item->price) ? "N/A" : $item->price }}</td>
                                <td style="width: 300px">
                                  <button 
                                    class="btn btn-warning btn-sm update-subtype-btn" 
                                    data-id="{{ $item->id }}"
                                  >
                                    แก้ไข
                                  </button>
                                  <button 
                                    class="btn btn-warning btn-sm delete-subtype-btn" 
                                    data-id="{{ $item->id }}"
                                  >
                                   ลบ
                                  </button>
                                  <a href="/rate-template/{{ $rateId }}/create/{{ $type->id }}/{{ $item->id }}">
                                    <button class="btn btn-danger btn-sm">
                                      ประเภทย่อย
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


<div class="modal fade" id="create-subtype-modal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/rate-template/{{ $rateId }}/type/{{ $type->id }}/item/create" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">สร้างรายการตัวเลือกใหม่</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>ชื่อ</label>
            <input type="text" id="subtype-name" name="name" class="form-control"  placeholder="MacBook Pro" required>
          </div>
          <div class="form-group">
            <label>ราคา</label>
            <input type="text" id="subtype-price" name="price" class="form-control"  placeholder="50,000 - 65,000">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $(".update-subtype-btn").on("click", function() {
    let name = $(this).parent().parent().find(".item-subtype-name").text();
    let price = $(this).parent().parent().find(".item-subtype-price").text();
    let id = $(this).attr("data-id");

    $("#subtype-name").val(name)
    $("#subtype-price").val(price === "N/A" ? "" : price)
    $("#create-subtype-modal .modal-title").text("แก้ไขรายการตัวเลือก")
    $("#create-subtype-modal form").attr("action", "/rate-template/{{ $rateId }}/type/{{ $type->id }}/item/update/" + id)
    $("#create-subtype-modal").modal("show")
  })


  $("#create-subtype-modal").on("hidden.bs.modal", function() {
    $("#create-subtype-modal .modal-title").text("สร้างรายการตัวเลือกใหม่")
    $("#create-subtype-modal form").attr("action", "/rate-template/{{ $rateId }}/type/{{ $type->id }}/item/create")
    $("#subtype-name").val("")
    $("#subtype-price").val("")
  })


  $(".delete-subtype-btn").on("click", function() {
    let id = $(this).attr("data-id");
    let isConfirm = confirm("Are you sure");
    if(isConfirm) {
        let url = "/rate-template/{{ $rateId }}/type/{{ $type->id }}/item/delete/" + id
        $.post(url, function(data, status) {
          location.reload();
        })
      }
  })

</script>
@endsection


