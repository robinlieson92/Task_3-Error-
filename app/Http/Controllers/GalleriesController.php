<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Gallery;

use App\Http\Requests\GalleryRequest;

use Session;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries=Gallery::all();
        return view('galleries.index')
        ->with('galleries', $galleries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validate=Validator::make(Input::all(), Gallery::valid());
        if($validate->fails()){
            return Redirect::to('galleries/create')
                ->withErrors($validate)
                ->withInput();
        }else{
            $gallery = new Gallery;
            $gallery->title = Input::get('title');

            if (Input::hasFile('url'))
                {
                    $image = Input::file('url');
                    $imagename = $image->getClientOriginalName();
                    //$file->move('public/uploads', $file->getClientOriginalName());
                    $gallery->url ="ori_".$imagename;
                    $gallery->thumbnail ="thumb_".$imagename;
                    $gallery->showimage ="show_".$imagename;
                    $gallery->save();
                    $directory = public_path()."/upload_gambar/".$gallery->id;
                    if(!File::exists($directory)){
                        File::makeDirectory($directory,$mode=0777,true,true);
                    }
                    Image::make($image->getRealPath())->save($directory."/ori_".$imagename);
                    Image::make($image->getRealPath())->resize('200','100')->save($directory."/thumb_".$imagename);
                    Image::make($image->getRealPath())->resize('600','300')->save($directory."/show_".$imagename);
                    Session::flash('notice', 'Gallery success add');
                    return Redirect::to('galleries.show');
                }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $galleries = Gallery::find($id);
        return view('galleries.show')
        ->with('galleries', $galleries);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $galleries = Gallery::find($id);
        return view('galleries.edit')
        ->with('galleries', $galleries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gallery::find($id)->update($request->all());
        Session::flash("notice", "Gallery success updated");
        return redirect()->route("galleries.show", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::destroy($id);
        Session::flash("notice", "Gallery success deleted");
        return redirect()->route("galleries.index");
    }
}
