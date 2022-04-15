<div class="container">
  <h2>List Medicines by Category</h2>
  <p>ID Category: {{ $id_category }} with name: {{ $namecategory }}</p>
  <br>
  <p>Total rows: {{ $getTotalData }}</p>
  @if($result)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Generic Name</th>
        <th>Formulas</th>
        <th>Restriction Formula</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
    @foreach($result as $li)
      <tr>
        <td>{{ $li->generic_name }}</td>
        <td>{{ $li->form }}</td>
        <td>{{ $li->restriction_formula }}</td>
        <td>{{ $li->price }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  @else
    <h2>Tidak ada data</h2>
  @endif
</div>