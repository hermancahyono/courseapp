<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*  tampung seluruh data review kedalam variabel $reviews, disini
            kita juga menambahkan method search dan multiSearch
            yang kita dapatkan dari sebuah trait hasScope, selanjutnya
            kita pecah data review yang kita tampilkan hanya 8 per halaman
            dengan urutan terbaru.
        */
        $reviews = Review::search('rating')
            ->multiSearch('course', 'name')
            ->multiSearch('user', 'name')
            ->paginate(8)
            ->withQueryString();

        // passing varibel $reviews kedalam view.
        return view('admin.review.index', compact('reviews'));
    }

    public function store(ReviewRequest $request, Course $course)
    {
        /*
            masukan data baru review dengan "course_id" sesuai dengan variabel $course, karena disini kita menggunakan
            updateOrCreate maka jika user yang sedang login pernah memberikan review maka data hanya akan diupdate jika belum
            maka akan memasukan data baru.
        */
        $course->reviews()->UpdateOrcreate([
            'user_id' => $request->user()->id,
        ], [
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        // kembali kehalaman sebelumnya dengan membawa toastr.
        return back()->with('toast_success', 'Review Created');
    }
}
