<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs= Blog::All();

        return response()->json(['mmsg'=>'success', 'blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validate=Validator::make($request->all(), [
            'title' => 'required|min:10|max:255',
            'description' =>'required|min:20'
        ]);
        
        if($validate->fails()){
            return response()->json(['msg'=>'validation error', 'data'=>$validate->errors()],422);
        }
        try{
            $blog=Blog::create([
                'title' => $request->title,
                'description'=> $request->description
            ]);            
            return response()->json(['status'=>true, 'msg'=>'blog create success', 'blog'=>$blog]);
        }
        catch(Exception $e){
                return response()->json([
                    'msg'=>$e->getMessage()
                ], $e->getCode());
                 
            }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog= Blog::find($id);

        if($blog){
            return response()->json(['mmsg'=>'success', 'blog'=>$blog]);
        }else{
            return response()->json(['msg'=>'Data Not Found']);
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate=Validator::make($request->all(), [
            'title' => 'required|min:10|max:255',
            'description' =>'required|min:20'
        ]);
        
        if($validate->fails()){
            return response()->json(['msg'=>'validation error', 'data'=>$validate->errors()],422);
        }
        try{
            $blog=Blog::find($id);
            $blog->title=$request->title;
            $blog->description=$request->description;
            $blog->save();

            return response()->json(['status'=>true, 'msg'=>'blog update success', 'blog'=>$blog]);
        }
        catch(Exception $e){
                return response()->json([
                    'msg'=>$e->getMessage()
                ], $e->getCode());
                 
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try{
            $blog=Blog::find($id);
            if($blog){
                $blog->delete();               
            }
            return response()->json(['mmsg'=>'blog delete success']);
        }
        catch(Exception $e){
                return response()->json([
                    'msg'=>'Somethng Wrong'
                ], $e->getCode());
                 
            } 
          
    }
}
