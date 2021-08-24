<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\BlackLine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlackHeaderController extends Controller
{
    public function view_of_black_header() {
        $black_line = BlackLine::where('id', 1)->first();
        return view('admin.layouts.header_content', ['black_line' => $black_line['content']]);
    }
    public function send_black_line_to_data_base(Request $request) {
        BlackLine::where('id', 1)->update(['content' => $request->black_line]);
        $new_black_line = BlackLine::where('id', 1)->first();
        return $new_black_line;
    }
    public function view_of_edition_black_header() {
        $black_line = BlackLine::where('id', 1)->first();
        return view('admin.layouts.change_header_content', ['black_line' => $black_line['content']]);
    }
}
