<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display the blog list page.
     */
    public function index(Request $request)
    {
        return view('pages.blog');
    }

    /**
     * Display the blog details page.
     */
    public function show($id = null)
    {
        return view('pages.blog-details', [
            'postId' => $id,
        ]);
    }
}
