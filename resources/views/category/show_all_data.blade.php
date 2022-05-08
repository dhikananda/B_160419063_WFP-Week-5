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

  <h2>List Categories</h2>

  @if($alldata)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($alldata as $li)
      <tr>
        <td>{{ $li->id }}</td>
        <td>{{ $li->name }}</td>
        <td>{{ $li->description }}</td>
        <td>
          <a href="{{ route('category.edit',$li->id) }}" class="btn btn-xs btn-info">edit</a>

          <form method="post" action="{{ url('category/'.$li->id) }}">
            @csrf
            @method('DELETE')
            <input type="submit" value="delete" class="btn btn-danger btn-xs" onclick="if(!confirm('Are you sure to delte this record ?')) return false;">
          </form>
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