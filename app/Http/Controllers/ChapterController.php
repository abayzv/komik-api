<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{
    public function index()
    {
        //get data from table posts
        $chapters = Chapter::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data'    => $chapters  
        ], 200);

    }
    
     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($slug)
    {
        //find post by ID
        $chapter = Chapter::where('slug', $slug)->first();

        $data = [
            'comic_id' => $chapter->comic_id,
            'name' => $chapter->name,
            'slug' => $chapter->slug,
            'img' => explode(",",$chapter->img),
        ];

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $data
        ], 200);

    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'comic_id'   => 'required',
            'name'   => 'required',
            'slug' => 'required',
            'img' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $chapter = Chapter::create([
            'comic_id'   => $request->comic_id,
            'name'   => $request->name,
            'slug' => $request->slug,
            'img' => $request->img,
        ]);

        //success save to database
        if($chapter) {

            return response()->json([
                'success' => true,
                'message' => 'Post Created',
                'data'    => $chapter  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save',
        ], 409);

    }
}
