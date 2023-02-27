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
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Confirmation</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1 @endphp
                    @foreach($applicants as $applicant)
{{--                        @if($applicant->teacher_id == Session::get('teacherId'))--}}
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $applicant->student_name }}</td>
                            <td>{{ $applicant->student_phone }}</td>
                            <td>{{ $applicant->student_email }}</td>
                            <td>{{ $applicant->course_name }}</td>
                            <td>{{ $applicant->course_code }}</td>
                            <td>{{ $applicant->confirmation }}</td>
                            <td>
                                <a href="{{ route('delete_applicant', $applicant->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
{{--                        @endif--}}
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

