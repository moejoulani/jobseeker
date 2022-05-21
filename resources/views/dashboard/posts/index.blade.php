@extends('layouts.app')

@section('content')
@include('layouts.sidebar')
<div class="container">
<div class="jumbotron">
    <h1 class="display-4">Manage A Job Posts </h1>
    <p class="lead">You Can Edit , Update And Delete Posts</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="{{ route('post.create') }}" role="button">Add New Job Post</a>
    </p>
  </div>
  @if (count($posts) > 0 )
      

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Created Date</th>
        <th scope="col">Post Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @php
            $count = 1;
        @endphp
        @foreach ($posts as $item)
            
      <tr>
        <th scope="row">{{ $count }}</th>
        <td>{{ $item->title }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->created_at }}</td>
        <td>
          @if ($item->expiry_date < date("Y-m-d"))
            Not Active (Expired)
          @else
          Active  
          @endif
        </td>
        <td>
            {{-- <a  class="text-success" href=""> <i class="fas  fa-2x fa-eye"></i> </a> --}}
          
            <a href="{{ route('post.edit',$item->id) }}"> <i class="fas fa-2x fa-edit"></i>  </a>&nbsp;&nbsp;
            {{-- <a class="text-danger" href=""> <i class="fas  fa-2x fa-trash-alt"></i> </a> --}}
        </td>
      </tr>
     
      
      @php
          $count++;
      @endphp
      @endforeach
    </tbody>
  </table>
  @else
  <h1>There Is No Posts</h1>
  @endif
  
</div>
@endsection