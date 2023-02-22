<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showcase;

class ShowcaseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        /*
            tampung seluruh data showcase kedalam variabel $showcases, kemudian kita memanggil relasi				menggunakan with, selanjutnya kita pecah data showcase yang kita tampilkan hanya 9 per halaman
            dengan urutan terbaru.
        */
        $showcases = Showcase::with('user', 'course')->latest()->paginate(9);

        // passing variabel $showcases kedalam view.
        return view('admin.showcase.index', compact('showcases'));
    }
}
