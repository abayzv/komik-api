<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use App\Models\Chapter;
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
    public function show($slug)
    {
        //find post by ID
        $comic = Comic::where('slug', $slug)->first();
        if($comic === null){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Post',
                'data'    => null
            ], 200);
        }
        $chapter = Chapter::where('comic_id', $comic->id)->get();
        
        $data = [
            'detail' => $comic,
            'chapter_list' => $chapter
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
        // return response()->json([
        //     $request->title
        // ], 201);

        //set validation
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'alt_title' => 'required',
            'author' => 'required',
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
            'excerpt' => 'required',
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
            'author' => $request->author,
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
            'excerpt'   => $request->excerpt,
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
