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
              <form action="/rate-template/{{ $rateId }}" method="post">
                @csrf
                <div class="form-group">
                  <label>ตั้งชื่อ</label>
                  <input type="text" name="name" class="form-control"  placeholder="ประเภท MacBook" required>
                  <br>
                  <label>เลือกประเภท Input</label>
                  <select class="form-control" name="type" required>
                    <option value="checkbox">Checkbox</option>
                    <option value="select">Select</option>
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
                <button class="btn btn-danger btn-sm" style="float: right" data-toggle="modal" data-target="#create-subtype-modal">
                  Create
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="create-subtype-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/rate-template/{{ $rateId }}/item/create">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">สร้างรายการตัวเลือกใหม่</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>ชื่อ</label>
            <input type="text" name="name" class="form-control"  placeholder="MacBook Pro" required>
          </div>
          <div class="form-group">
            <label>ราคา</label>
            <input type="text" name="price" class="form-control"  placeholder="50,000 - 65,000">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>



</script>
@endsection


