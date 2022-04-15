@extends('layouts.conquer')
@section('content')
<div class="container">
  <h2>List Categories</h2>

  @if($alldata)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>List of Medicines</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($alldata as $li)
      <tr>
        <td>{{ $li->id }}</td>
        <td>{{ $li->name }}</td>
        <td>{{ $li->description }}</td>
        <td>
          a
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