@extends('layouts.backend.app', ['title' => 'Episode'])

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-10">
        <form action="{{ route('admin.video.update', [$course->slug, $video->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <x-card-form title="EDIT EPISODE" :url="route('admin.video.index', $course->id)" titleBtn="Update Episode">
                <x-input title="Title" name="name" type="text" placeholder="Enter episode title" :value="$video->name" />
                <div class="row">
                    <div class="col-6">
                        <x-input title="Episode" name="episode" type="text" placeholder="Enter video episode" :value="$video->episode" />
                    </div>
                    <div class="col-6">
                        <x-input title="Video Code" name="video_code" type="text" placeholder="Enter video code" :value="$video->video_code" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="duration">Type</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="intro" value="0" @checked($video->intro == 0)>
                        <label class="form-check-label">Free</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="intro" value="1" @checked($video->intro == 1)>
                        <label class="form-check-label">Premium</label>
                    </div>
                </div>
            </x-card-form>
        </form>
    </div>
</div>
@endsection