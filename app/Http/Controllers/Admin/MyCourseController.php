<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // tampung data user yang sedang login ke dalam variable $user
        $user = $request->user();

        //tampung data transaction detail kedalam variable $course
        $courses = TransactionDetail::with('transaction', 'course.reviews')
            ->whereHas('transaction', function ($query) use ($user) {
                $query->where('user_id', $user->id)->where('status', 'success');
            })->whereHas('course', function ($query) {
                $query->where('name', 'like', '%' . request()->search . '%');
            })->latest()->paginate(3);

        // passing variabel $courses kedalam view.
        return view('admin.course.mycourse', compact('courses'));
    }
}
