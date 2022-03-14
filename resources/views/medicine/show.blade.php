@extends('layouts.conquer')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Medicines</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    h2 {
        text-align:center;
    }
</style>
<body>

<div class="container">
  <h2>List Medicines</h2>
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

</body>
</html>