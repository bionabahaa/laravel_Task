{{-- @extends('layout') --}}
@extends('layouts.app')

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
  <a href="{{ route('companies.create')}}" class="btn btn-info">ADD company</a>

  <table class="table table-striped">
    <thead>
        <tr>
          <td>first_name</td>
          <td>Email</td>
          <td>logo</td>
          <td>website</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{$company->first_name}}</td>
            <td>{{$company->email}}</td>
            <td><img src="{{asset('storage/logo/'.$company['logo'])}}" height="100px" width="100px"></td>
            <td>{{$company->website}}</td>
            <td><a href="{{ route('companies.show', $company->id)}}" class="btn btn-secondary">Show</a></td>
            <td><a href="{{ route('companies.edit', $company->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('companies.destroy', $company->id)}}" method="post">
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
