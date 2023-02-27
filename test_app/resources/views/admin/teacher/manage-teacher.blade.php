@extends('admin.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>sl No</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1 @endphp
                    @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->address }}</td>
                        <td>
                            <img src="{{ asset($teacher->image) }}" style="height: 50px;width: 50px" alt="">
                        </td>
                        <td>
                            <a href="{{ route('edit-teacher', $teacher->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('delete-teacher', $teacher->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
