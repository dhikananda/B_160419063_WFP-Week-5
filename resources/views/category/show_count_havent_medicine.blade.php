@extends('layouts.conquer')
@section('content')
<div class="container">
  <h2>List Categories that Haven't Medicines</h2>
  
  @if($category_havent_medicines)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($category_havent_medicines as $li)
      <tr>
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