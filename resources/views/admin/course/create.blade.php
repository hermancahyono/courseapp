@extends('layouts.backend.app', ['title' => 'Course'])

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-10">
            <form action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-card-form title="CREATE NEW COURSE" url="{{ route('admin.course.index') }}" titleBtn="Create Course">
                    <div class="card-body">
                        <x-input title="Title" type="text" name="name" placeholder="Enter course title"
                            value="{{ old('name') }}" />
                        <div class="row">
                            <div class="col-6">
                                <x-select title="Category" name="category_id">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col-6">
                                <x-input title="Demo" type="text" name="demo" placeholder="Enter course demo url"
                                    :value="old('demo')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <x-input title="Price" type="number" name="price" placeholder="Enter course price"
                                    value="{{ old('price') }}" />
                            </div>
                            <div class="col-6">
                                <x-input title="Discount" type="number" name="discount" placeholder="Enter course discount"
                                    value="{{ old('discount') }}" />
                            </div>
                        </div>
                        <x-uploadfile title="Cover" name="image" value="{{ old('image') }}" />
                        <x-textarea title="Description" name="description" placeholder="Enter course description"
                            value="{{ old('description') }}" />
                    </div>
                </x-card-form>
            </form>
        </div>
    </div>
@endsection