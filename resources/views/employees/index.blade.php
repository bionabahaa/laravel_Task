@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <a href="{{ route('employees.create')}}" class="btn btn-info">ADD Employee</a>

  <table class="table table-striped">
    <thead>
        <tr>
          <td>first_name</td>
          <td>last_name</td>
          <td>company</td>
          <td>Email</td>
          <td>Phone</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            <td>{{$employee->company->first_name}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->phone}}</td>
            <td><a href="{{ route('employees.show', $employee->id)}}" class="btn btn-secondary">Show</a></td>
            <td><a href="{{ route('employees.edit', $employee->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
