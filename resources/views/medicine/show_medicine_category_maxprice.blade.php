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
  <h2>List Medicines that Have Highest Price</h2>
  @if($medicine_category_maxprice)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Generic Name</th>
        <th>Category Name</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($medicine_category_maxprice as $li)
      <tr>
        <td>{{ $li->generic_name }}</td>
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

</body>
</html>