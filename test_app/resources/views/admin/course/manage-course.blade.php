@extends('admin.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>sl No</th>
                        <th>Teacher Name</th>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1 @endphp
                    @foreach($courses as $course)
                        @if($course->teacher_id == Session::get('teacherId'))
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->course_code }}</td>
                            <td>{{ Illuminate\Support\Str::limit($course->description, 30); }}</td>
                            <td>
                                <img src="{{ asset($course->image) }}" style="height: 50px;width: 50px" alt="">
                            </td>
                            <td>
                                <a href="{{ route('manage_course_edit', $course->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('course_delete', $course->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
