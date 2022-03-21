@extends('layouts.conquer')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Show Data Medicines</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>List Medicines</h2>
  
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

  <a href="#" onclick="showHighPrice()">
  <i class="icon-bulb"></a></i>

  <div id='showinfo'></div>

  <!-- <a class="btn btn-default" data-toggle="modal" href="#disclaimer">Disclaimer</a> -->
  <a data-toggle="modal" href="#disclaimer">Readme First!</a>
  
  @if($data_nfc)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Image</th>
        <th>Generic Name</th>
        <th>Formulas</th>
        <th>Category Name</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($data_nfc as $li)
      <tr>
        <td>
          <a class="btn btn-default" data-toggle="modal" href="#detail_{{$li->id}}" data-toggle="modal">{{ $li->id }}</a>  

          <div class="modal fade" id="detail_{{$li->id}}" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">{{$li->generic_name}}</h4>
                  </div>
                  <div class="modal-body">
                    <img src="{{ asset('images/'.$li->id.'.jpg') }}" height='200px'/>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </div>
            </div>
          </div>
        </td>
        <td>{{ $li->generic_name }}</td>
        <td>{{ $li->form }}</td>
        <td>{{ $li->name }}</td>
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
function showInfo()
{
  $.ajax({
    type:'POST',
    url:'{{route("medicines.showInfo")}}',
    data:'_token=<?php echo csrf_token() ?>',
    success: function(data){
       $('#showinfo').html(data.msg)
    }
  });
}

function showHighPrice()
{
  $.ajax({
    type:'GET',
    url:'{{route("medicines.showHighPrice")}}',
    data:'_token=<?php echo csrf_token() ?>',
    success: function(data){
       $('#showinfo').html(data.msg)
    }
  });
}
</script>
@endsection

</body>
</html>