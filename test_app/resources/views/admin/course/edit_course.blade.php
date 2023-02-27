@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Edit Course Form</h6>
            <hr/>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('updateCourse', $course->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="teacher_id" value="{{ Session::get('teacherId') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Course Form</h5>
                            </div>
                            <hr/>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Course Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="course_name" value="{{ $course->course_name }}" class="form-control" id="inputEnterYourName" placeholder="Course Name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Url</label>
                                <div class="col-sm-9">
                                    <input type="text" name="slug" value="{{ $course->slug }}" class="form-control" id="inputEnterYourName" placeholder="url">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Course Code</label>
                                <div class="col-sm-9">
                                    <input type="text" name="course_code" value="{{ $course->course_code }}" class="form-control" id="inputEnterYourName" placeholder="Course Code">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control" id="inputAddress4" rows="3" placeholder="Description">{{ $course->description }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <img src="{{ asset('/') . $course->image  }}" class="img-fluid" width="80">
                                    <input type="file" name="image" class="form-control" >
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary px-5">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

