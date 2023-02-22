@extends('layouts.backend.app', ['title' => 'Video'])

@section('content')
<a href="{{ route('admin.course.index') }}" class="btn btn-danger mb-3">
    <i class="fas fa-arrow-left mr-1"></i> GO BACK
</a>
<x-button-create title="ADD NEW EPISODE" :url="route('admin.video.create', $course->slug)" />

<x-card title="LIST EPISODE - {{ $course->name }}">
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="10">EPS</th>
                <th>TITLE</th>
                <th>TYPE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $i => $video)
            <tr>
                <td>{{ $video->episode }}</td>
                <td>{{ $video->name }}</td>
                <td>
                    <span class="badge badge-{{ $video->intro == 1 ? 'danger' : 'primary' }}">
                        {{ $video->intro == 1 ? 'premium' : 'free' }}
                    </span>
                </td>
                <td>
                    <x-button-edit :url="route('admin.video.edit', [$course->slug, $video->id])" />
                    <x-button-delete :id="$video->id" :url="route('admin.video.destroy', $video->id)" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-card>
@endsection