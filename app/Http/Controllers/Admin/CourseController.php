<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            tampung semua data course kedalam variabel $courses, kemudian kita memanggil relasi menggunakan withcount,
            selanjutnya pada saat melakukan pemanggilan relasi details yang kita ubah namanya menjadi enrolled, disini kita melakukan sebuah query untuk mengambil data transaksi yang memiliki status success, selanjutnya kita pecah data course yang kita tampilkan hanya 3 per halaman dengan urutan terbaru.
        */
        $courses = Course::withCount(['videos as video', 'details as enrolled' => function($query){
            $query->whereHas('transaction', function($query){
                $query->where('status', 'success');
            });
        }])->latest()->paginate(3);

        // passing variabel $courses kedalam view.
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // tampung seluruh data category kedalam variabel $categories.
        $categories = Category::all();

        // passing variabel $categories kedalam view.
        return view('admin.course.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        // tampung request file image kedalam variable $image.
        $image = $request->file('image');
        // request yang telah kita tampung kedalam variabel, kita masukan kedalam folder public/course.
        $image->storeAs('public/course', $image->hashName());

        // masukan data baru course dengan user_id sesuai dengan user yang sedang memberikan request
        $request->user()->courses()->create([
            'name' => $request->name,
            'image' => $request->file('image') ? $image->hashName() : null,
            'price' => $request->price,
            'description' => $request->description,
            'demo' => $request->demo,
            'category_id' => $request->category_id,
            'discount' => $request->discount,
        ]);

        // kembali kehalaman admin/course/index dengan membawa toastr.
        return redirect(route('admin.course.index'))->with('toast_success', 'Course Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        // tampung seluruh data category kedalam variabel $categories.
        $categories = Category::all();

        // passing variabel $categories dan $course kedalam view.
        return view('admin.course.edit', compact('categories', 'course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        // update data course berdasarkan id.
        $course->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'demo' => $request->demo,
            'category_id' => $request->category_id,
            'discount' => $request->discount,
        ]);

        // cek apakah user mengirimkan request file image.
        if($request->file('image')){
            // hapus image course yang sebelumnya.
            Storage::disk('local')->delete('public/course/'.basename($course->image));
            // tampung request file image kedalam variabel $image.
            $image = $request->file('image');
            // request yang telah kita tampung kedalam variabel kita masukan kedalam folder public/course.
            $image->storeAs('public/course', $image->hashName());
            // update data course image berdasrkan id.
            $course->update([
                'image' => $image->hashName(),
            ]);
        }

        // kembali kehalaman admin/course/index dengan membawa toastr.
        return redirect(route('admin.course.index'))->with('toast_success', 'Course Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        // hapus image course berdasarkan id
        Storage::disk('local')->delete('public/course/'.basename($course->image));

        // hapus data course bedasarkan id
        $course->delete();

        // kembali kehalaman sebelumnya dengan membawa toastr
        return back()->with('toast_success', 'Course Deleted');
    }
}