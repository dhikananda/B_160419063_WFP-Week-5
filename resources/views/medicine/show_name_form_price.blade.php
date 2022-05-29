@extends('layouts.conquer')
@section('content')
<div class="container">
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <div class="note note-success" id='pesan' style='display:none'>

  </div>
  
  <h2>List Medicines</h2>

  <a href='#modalCreate' data-toggle='modal' class='btn btn-info'>
    + New Medicine
  </a>

  <!-- modal create new medicine -->
  <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" >
      <form method="post" class="form-horizontal" action="{{route('medicine.store')}}">
        <div class="modal-header">
          <button type="button" class="close" 
            data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Add New Medicine</h4>
        </div>

        <div class="modal-body">
  		   <!-- FORM CREATE -->
          @csrf
          <div class="form-group">
            <label class="control-label col-sm-2" for="generic_name">Generic Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="generic_name" placeholder="Enter Generic Name" name="generic_name">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="form">Formula:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="form" placeholder="Enter Formula" name="form">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="restriction_form">Restriction Formula: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="restriction_form" placeholder="Enter Restriction Formula" name="restriction_form">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="price">Price: Rp. </label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="price" placeholder="Enter Price (Rp)" name="price">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description: </label>
            <div class="col-sm-10">          
              <textarea rows="4" cols="64" name="description" placeholder="Enter Description"></textarea>
            </div>
          </div>

          <div class="form-group">
            @if($category)

              <label class="control-label col-sm-2" for="description">Category: </label>
              <select id="category" name="category_id">
                @foreach ($category as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
              </select>

            @endif
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for='faskes1'>Faskes 1: </label>
            <input type="radio" id="faskes1" name="faskes1" value="1">
            <label for="faskes1">Yes</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" id="faskes_1_no" name="faskes1" value="0">
            <label for="faskes1">No</label>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for='faskes2'>Faskes 2: </label>
            <input type="radio" id="faskes2" name="faskes2" value="1">
            <label for="faskes2">Yes</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" id="faskes2" name="faskes2" value="0">
            <label for="faskes2">No</label>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for='faskes3'>Faskes 3: </label>
            <input type="radio" id="faskes3" name="faskes3" value="1">
            <label for="faskes3">Yes</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" id="faskes3" name="faskes3" value="0">
            <label for="faskes3">No</label>
          </div>

       </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Create</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- modal edit type A -->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id='modalContent'>
        <!-- <div style='text-align:center'> -->
          <!-- <img src='{{asset("conquer2/img/loading.gif")}}'/>
        </div> -->
      </div>
    </div>
  </div>
  
  <br>
  <div class="modal fade" id="disclaimer" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">DISCLAIMER</h4>
        </div>
        <div class="modal-body">
          Pictures shown are for illustration purpose only.Actual product may vary due to product enhancement.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- <a class="btn btn-default" data-toggle="modal" href="#disclaimer">Disclaimer</a> -->
  <a data-toggle="modal" href="#disclaimer">Readme First!</a>
  
  @if($alldata_medicine)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Generic Name</th>
        <th>Formulas</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($alldata_medicine as $li)
      <tr id='tr_{{$li->id}}'>
        <td id='td_gn_{{$li->id}}'>{{ $li->generic_name }}</td>
        <td id='td_form_{{$li->id}}'>{{ $li->form }}</td>
        <td id='td_price_{{$li->id}}'>{{ $li->price }}</td>
        <td>
          <a href="{{ route('medicine.edit', $li->id) }}" class="btn btn-xs btn-info">edit</a>
          
          <a href='#modalEdit' data-toggle='modal' 
          class="btn btn-xs btn-warning" onclick='getEditFormMedic({{$li->id}})'>edit A</a>

          <a href='#modalEdit' data-toggle='modal' 
          class="btn btn-xs btn-warning" onclick='getEditFormMedic2({{$li->id}})'>edit B</a>
        </td>
        <td>
          <form method="post" action="{{ url('medicine/'.$li->id) }}">
            @csrf
            @method('DELETE')
            <input type="submit" value="delete" class="btn btn-danger btn-xs" onclick="if(!confirm('Are you sure to delte this record ?')) return false;">
          </form>

          <a class='btn btn-xs btn-danger' 
          onclick='if(confirm("Are your sure?")) deleteDataRemoveTR({{$li->id}})'>delete 2</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  @else
    <h2>Tidak ada data</h2>
  @endif
</div>

@endsection

@section('javascript')
<script>
    function getEditFormMedic(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("medicine.getEditFormMedic")}}',
            data: {'_token':'<?php echo csrf_token() ?>',
                  'id':id
            },
            success: function(data) {
                $('#modalContent').html(data.msg);
            }
        });
    }

    function getEditFormMedic2(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("medicine.getEditFormMedic2")}}',
            data: {'_token':'<?php echo csrf_token() ?>',
                  'id':id
            },
            success: function(data) {
                $('#modalContent').html(data.msg);
            }
        });
    }

    function saveDataUpdateTD(id) {
      var generic_name = $('#generic_name').val();
      var form = $('#form').val();
      var restriction_form = $("#restriction_form").val();
      var price = $("#price").val();
      var description = $("#description").val();
      var category = $("#category").val();
      var faskes1 = $("#faskes1").val();
      var faskes2 = $("#faskes2").val();
      var faskes3 = $("#faskes3").val();
        $.ajax({
            type: 'POST',
            url: '{{route("medicine.saveData")}}',
            data: {'_token':'<?php echo csrf_token() ?>',
                  'id':id,
                  'generic_name':generic_name,
                  'form':form,
                  'restriction_form':restriction_form,
                  'price':price,
                  'description':description,
                  'category_id':category,
                  'faskes1':faskes1,
                  'faskes2':faskes2,
                  'faskes3':faskes3
            },
            success: function(data) {
                if(data.status == "oke"){
                  $('#td_gn_' + id).html(generic_name);
                  $('#td_form_' + id).html(form);
                  $('#td_price_' + id).html(price);
                  
                  $('#pesan').show();
                  $('#pesan').html(data.msg);
                }
            }
        });
    }

    function deleteDataRemoveTR(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("medicine.deleteData")}}',
            data: {'_token':'<?php echo csrf_token() ?>',
                  'id':id
            },
            success: function(data) {
                if(data.status == "oke"){
                  alert(data.msg);
                  $("#tr_" + id).remove();
                } else {
                  alert(data.msg);
                }
            }
        });
    }
</script>
@endsection