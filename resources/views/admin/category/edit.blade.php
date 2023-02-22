@extends('layouts.backend.app', ['title' => 'Category'])

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-10">
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-card-form title="EDIT CATEGORY" url="{{ route('admin.category.index') }}" titleBtn="Update Category">
                    <x-input title="Title" type="text" name="name" placeholder="Enter category title"
                        :value="$category->name" />
                    <x-uploadfile title="Image" name="image" :value="$category->image" />
                </x-card-form>
            </form>
        </div>
    </div>
@endsection
    