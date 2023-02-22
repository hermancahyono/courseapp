<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use App\Models\Category;
use App\Models\Showcase;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // tampung jumlah data category kedalam variabel $category.
        $category = Category::count();

        // tampung jumlah data course kedalam variabel $course.
        $course = Course::count();

        // tampung jumlah data transaction yang memiliki status "success" kedalam variabel $transaction.
        $transaction = Transaction::where('status', 'success')->count();

        // tampung jumlah data transaction yang memiliki status "success" kemudian jumlahkan "grand_total" dan masukan kedalam variabel $revenue.
        $revenue = Transaction::where('status', 'success')->sum('grand_total');

        // tampung jumlah data user yang memiliki role "author" kedalam variabel $author.
        $author = User::role('author')->count();

        // tampung jumlah data showcase kedalam variabel $showcase.
        $showcase = Showcase::count();

        // tampung jumlah data review kedalam variabel $review.
        $review = Review::count();

        // tampung jumlah data user kedalam variabel $member.
        $member = User::count();

        /*
            tampung data best course kedalam variabel $bestCourse, disini kita melakukan sebuah query builder untuk memanipulasi data yang akan kita ambil yaitu hanya berupa sebuah nama course dan total dari transaction course tersebut yang kita ubah namanya menjadi total, disini kita tetapkan limit data yang di ambil hanya berjumlah 5.
         */
        $bestCourse = DB::table('transaction_details')
                            ->addSelect(DB::raw('courses.name as name, count(transaction_details.course_id) as total'))
                            ->join('courses', 'courses.id', 'transaction_details.course_id')
                            ->groupBy('transaction_details.course_id')
                            ->orderBy('total', 'DESC')
                            ->limit(5)
                            ->get();

        // tampung data array kosong kedalam variabel $label.
        $label = [];

        // tampung data array kosong kedalam variabel $total.
        $total = [];

        // cek apakah variabel $bestCourse memiliki nilai atau tidak
        if(count($bestCourse)){
            // lakukan perulangan data $bestCourse yang kita ubah menjadi variabel $data
            foreach($bestCourse as $data){
                // tampung variabel $data->name ke dalam variabel $label[]
                $label[] = $data->name;
                // tampung variabel $data->total kedalam variabel $total[]
                $total[] = (int) $data->total;
            }
        // jika variabel $bestCourse tidak memiliki nilai
        }else{
            // masukan empty string kedalam variabel $label[]
            $label[] = '';
            // masukan empty string kedalam variabel $total[]
            $total[] = '';
        }

        return view('admin.dashboard', compact('category', 'course', 'transaction', 'revenue', 'author', 'showcase', 'review', 'member', 'label', 'total'));
    }
}