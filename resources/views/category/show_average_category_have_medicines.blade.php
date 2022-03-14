@extends('layouts.conquer')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Show Average Data Categories</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

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

</body>
</html>