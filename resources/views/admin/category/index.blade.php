@extends('layouts.backend.app', ['title' => 'Category'])

@section('content')
    <div class="row">
        <div class="col-12">
            <x-button-create title="ADD NEW CATEGORY" :url="route('admin.category.create')" />
            <x-card title="LIST CATEGORY">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>NAME</th>
                            <th>IMAGE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $i => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $i }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <img src="{{ $category->image }}" class="img-fluid" width="50">
                                </td>
                                <td>
                                    <x-button-edit :url="route('admin.category.edit', $category->id)" />
                                    <x-button-delete :id="$category->id" :url="route('admin.category.destroy', $category->id)" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-card>
            <div class="d-flex justify-content-end">{{ $categories->links() }}</div>
        </div>
    </div>
@endsection