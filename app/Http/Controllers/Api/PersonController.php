<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PersonFollower;
use App\Models\PersonPost;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function followPerson(Request $request, $id)
    {
        if($id == auth()->user()->id)
            return response()->json(['message' => 'You can\'t follow yourself'], 422);
        $person = User::findOrFail($id);

        //  to check , the user already follow this person or not
        $check = PersonFollower::where('person_id', $id)->where('follower_id', auth()->user()->id)->first();
        if($check)
            return response()->json(['message' => 'You already follow this person.'], 422);
        else{
            PersonFollower::create([
               'person_id'          => $id,
               'follower_id'        => auth()->user()->id
            ]);
            $message = 'You followed '. $person->first_name. ' ' . $person->last_name;
            return response()->json(['message' => $message], 200);
        }
    }

    public function attachPost(Request $request)
    {
        $data= $request->validate([
            'post_content'    => ['required', 'string']
        ]);
        if($data)
        {
            PersonPost::create([
                'owner_id'      => auth()->user()->id,
                'post_content'  => $data['post_content']
            ]);
            return response()->json(['message' => 'Post added successfully'], 200);
        }
    }
}
