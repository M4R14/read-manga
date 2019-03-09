<?php

namespace App\Http\Controllers\Admin\Manga;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use App\Models\Manga;
use App\Models\Manga\Chater;
use App\Models\Manga\Image;
use App\Models\Manga\Chater\Image as ChaterImage;

class ChaterImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file_image = $request->file('image');
        $image_path = $file_image->store('images/manga');
        
        $image = new Image;
        $image->name = basename($image_path);
        $image->save();
        
        $chater_id = Input::get('chater');
        $page_number = $request->get('number');

        ChaterImage::whereChaterId($chater_id)
            ->where('page_number', '>=', $page_number)
            ->update([
                'page_number' => \DB::raw('page_number + 1'),
            ]);

        $chaterImage = new ChaterImage;
        $chaterImage->chater_id = $chater_id;
        $chaterImage->image_id = $image->id;
        $chaterImage->page_number = $page_number;
        $chaterImage->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chaterImage = ChaterImage::find($id);
        $image = $chaterImage->image;
        $image_path = storage_path("app/images/manga/$image->name");
        $manager = new ImageManager;
        return $manager->make($image_path)->response();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $chater_id = Input::get('chater');
        $page_number = $request->get('number');

        ChaterImage::whereChaterId($chater_id)
            ->where('page_number', '>=', $page_number)
            ->update([
                'page_number' => \DB::raw('page_number + 1'),
            ]);

        $chaterImage = ChaterImage::find($id);
        $chaterImage->page_number = $page_number;
        $chaterImage->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chaterImage = chaterImage::find($id);
        $image = $chaterImage->image;

        $image_path = storage_path("app/images/manga/$image->name");
        Storage::delete($image_path);

        $image->delete();
        $chaterImage->delete();

        return redirect()->back();
    }
}
