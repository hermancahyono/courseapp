@extends('layouts.backend.app', ['title' => 'Course'])

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-10">
            <form action="{{ route('admin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-card-form title="EDIT COURSE" url="{{ route('admin.course.index') }}" titleBtn="Update Course">
                    <div class="card-body">
                        <x-input title="Title" type="text" name="name" placeholder="Enter course title"
                            value="{{ $course->name }}" />
                        <div class="row">
                            <div class="col-6">
                                <x-select title="Category" name="category_id">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($course->category_id == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col-6">
                                <x-input title="Demo" type="text" name="demo" placeholder="Enter course demo url"
                                    value="{{ $course->demo }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <x-input title="Price" type="number" name="price" placeholder="Enter course price"
                                    value="{{ $course->price }}" />
                            </div>
                            <div class="col-6">
                                <x-input title="Discount" type="number" name="discount" placeholder="Enter course discount"
                                    value="{{ $course->discount }}" />
                            </div>
                        </div>
                        <x-uploadfile title="Cover" name="image" value="{{ $course->image }}" />
                        <x-textarea title="Description" name="description" placeholder="Enter course description"
                            value="{{ old('description') }}">
                            {{ $course->description }}</x-textarea>
                    </div>
                </x-card-form>
            </form>
        </div>
    </div>
@endsection