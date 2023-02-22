<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\Course;
use App\Http\Requests\VideoRequest;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index($slug)
    {
        // tampung data course kedalam variabel $course, yang dimana "slug"nya sama dengan variabel $slug.
        $course = Course::where('slug', $slug)->first();

        // tampung seluruh data video kedalam variabel $videos, yang dimana "course_id"nya sama dengan variable $course->id.
        $videos = Video::where('course_id', $course->id)->get();

        // passing variabel $videos dan $course kedalam view.
        return view('admin.video.index', compact('videos', 'course'));
    }
    public function create($slug)
    {
        // tampung data course kedalam variabel $course, yang dimana "slug"nya sama dengan variabel $slug.
        $course = Course::where('slug', $slug)->first();

        // passing variable $course kedalam view.
        return view('admin.video.create', compact('course'));
    }

    public function store($slug, VideoRequest $request)
    {
        // tampung data course kedalam variabel $course, yang dimana "slug"nya sama dengan variabel $slug.
        $course = Course::where('slug', $slug)->first();

        // masukan data baru video dengan "course_id" sesuai dengan variabel $course
        $course->videos()->create([
            'name' => $request->name,
            'episode' => $request->episode,
            'intro' => $request->intro,
            'video_code' => $request->video_code,
        ]);

        // kembali kehalaman admin/video/index dengan membawa toastr.
        return redirect(route('admin.course.index'))->with('toast_success', 'Video Created');
    }

    public function edit($slug, Video $video)
    {
        // tampung data course kedalam variabel $course, yang dimana "slug"nya sama dengan variabel $slug.
        $course = Course::where('slug', $slug)->first();

        // passing variable $course dan $video kedalam view.
        return view('admin.video.edit', compact('course', 'video'));
    }

    public function update(VideoRequest $request, $slug, Video $video)
    {
        // tampung data course kedalam variabel $course, yang dimana "slug"nya sama dengan variabel $slug.
        $course = Course::where('slug', $slug)->first();

        // update data video berdasarkan id
        $video->update([
            'name' => $request->name,
            'episode' => $request->episode,
            'intro' => $request->intro,
            'video_code' => $request->video_code,
        ]);

        // kembali kehalaman admin/video/index dengan variabel $course dan toastr.
        return redirect(route('admin.video.index', $course))->with('toast_success', 'Video Updated');
    }

    public function destroy(Video $video)
    {
        // hapus data video berdasarkan id
        $video->delete();

        // kembali kehalaman sebelumnya dengan membawa toastr
        return back()->with('toast_success', 'Video Deleted');
    }
}
