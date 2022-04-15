@extends('layouts.conquer')
@section('content')
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

  <!-- <a class="btn btn-default" data-toggle="modal" href="#disclaimer">Disclaimer</a> -->
  <a data-toggle="modal" href="#disclaimer">Readme First!</a>
  
  @if($message)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Generic Name</th>
        <th>Formulas</th>
        <th>Restriction Formula</th>
        <th>Price</th>
        <th>Category Name</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $message->generic_name }}</td>
        <td>{{ $message->form }}</td>
        <td>{{ $message->restriction_formula }}</td>
        <td>{{ $message->price }}</td>
        <td>{{ $message->category->name }}</td>
      </tr>
    </tbody>
  </table>
  @else
    <h2>Tidak ada data</h2>
  @endif
</div>

@endsection