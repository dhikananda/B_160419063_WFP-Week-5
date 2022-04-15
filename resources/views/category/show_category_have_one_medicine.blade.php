@extends('layouts.conquer')
@section('content')
<div class="container">
  <h2>List Average Categories that Have 1 Medicine</h2>
  
  @if($category_have_one_medicine)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($category_have_one_medicine as $li)
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