<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ComicController extends Controller
{
    public function index()
    {
        //get data from table posts
        $comics = Comic::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data'    => $comics  
        ], 200);

    }
    
     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $comic = Comic::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $comic 
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
        // return response()->json([
        //     $request->title
        // ], 201);

        //set validation
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'alt_title' => 'required',
            'genre' => 'required',
            'type' => 'required',
            'colour' => 'required',
            'rating' => 'required',
            'illustrator' => 'required',
            'comic_type' => 'required',
            'graphic' => 'required',
            'viewers' => 'required',
            'status' => 'required',
            'theme' => 'required',
            'img' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $comic = Comic::create([
            'id' => $request->id,
            'title'     => $request->title,
            'alt_title'   => $request->alt_title,
            'slug'   => Str::slug($request->title),
            'genre'   => $request->genre,
            'type'   => $request->type,
            'colour'   => $request->colour,
            'rating'   => $request->rating,
            'illustrator'   => $request->illustrator,
            'comic_type'   => $request->comic_type,
            'graphic'   => $request->graphic,
            'viewers'   => $request->viewers,
            'status'   => $request->status,
            'theme'   => $request->theme,
            'img'   => $request->img,
        ]);

        //success save to database
        if($comic) {

            return response()->json([
                'success' => true,
                'message' => 'Post Created',
                'data'    => $comic  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save',
        ], 409);

    }
}
