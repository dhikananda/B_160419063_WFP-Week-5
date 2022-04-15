@extends('layouts.conquer')
@section('content')
<div class="container">
  <h2>List Average Categories</h2>
  
  @if($average_category_have_medicines)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Average</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($average_category_have_medicines as $li)
      <tr>
        <td>{{ $li->name }}</td>
        <td>{{ $li->average }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  @else
    <h2>Tidak ada data</h2>
  @endif
</div>

@endsection