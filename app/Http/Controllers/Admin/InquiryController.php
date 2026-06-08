<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::orderBy('id', 'desc')->get();
        return view('admin.inquiries.index', compact('inquiries'));
    }
}
