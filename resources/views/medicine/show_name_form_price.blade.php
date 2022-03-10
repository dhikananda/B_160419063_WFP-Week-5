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
  @if($alldata_medicine)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Generic Name</th>
        <th>Formulas</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($alldata_medicine as $li)
      <tr>
        <td>{{ $li->generic_name }}</td>
        <td>{{ $li->form }}</td>
        <td>{{ $li->price }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  @else
    <h2>Tidak ada data</h2>
  @endif
</div>

</body>
</html>