@extends('layouts.conquer')
@section('content')
<div class="container">
  <h2>Create New Category</h2>
  <form method="post" class="form-horizontal" action="{{route('category.store')}}">
    @csrf
    <div class="form-group">
      <label class="control-label col-sm-2" for="name_category">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name_category" placeholder="Enter Name" name="name_category">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="description">Description:</label>
      <div class="col-sm-10">          
        <textarea rows="4" cols="122" name="description" placeholder="Enter Description"></textarea>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Create</button>
      </div>
    </div>
  </form>
</div>

@endsection