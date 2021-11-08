<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Page;
use App\Models\PageFollower;
use App\Models\PagePost;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function create(Request $request)
    {
        $data= $request->validate([
            'page_name'               => ['required', 'string', 'between:2,100']
        ]);

        if($data){
            $user = Page::create([
                'page_name'     => $data['page_name'],
                'owner_id'      => auth()->user()->id
            ]);

            return response()->json(['message' => 'Page Created Successfully'], 200);
        }
    }

    public function followPage(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        //  to check , the user already follow this page or not
        $check = PageFollower::where('page_id', $id)->where('follower_id', auth()->user()->id)->first();
        if($check)
            return response()->json(['message' => 'You already follow this page.'], 422);
        else{
            PageFollower::create([
               'page_id'        => $id,
               'follower_id'    => auth()->user()->id
            ]);
            $message = 'You followed '. $page->page_name;
            return response()->json(['message' => $message], 200);
        }
    }

    public function attachPost(Request $request, $id)
    {
        $data= $request->validate([
            'post_content'    => ['required', 'string']
        ]);
        if($data)
        {
            PagePost::create([
                'page_id'      => $id,
                'post_content'  => $data['post_content']
            ]);
            return response()->json(['message' => 'Post added successfully'], 200);
        }
    }
}
