<?php

namespace App\Http\Controllers\Admin\Manga;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;

use App\Models\Manga;
use App\Models\Manga\Chater;
use App\Models\Manga\Image;

class ChaterController extends Controller
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
        $mangaId = input::get('manga_id');
        $manga = Manga::find($mangaId);

        $pageSize = input::get('page_size') ?: 1;

        return view('admin.manga-chater.create', [
            'manga' => $manga,
            'pageSize' => $pageSize,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newChater = new Chater;
        $newChater->name = $request->get('number');
        $newChater->manga_id = $request->get('mangaId');
        $newChater->public_date = implode(' ', $request->get('public_date'));
        $newChater->save();

        $files = $request->file('page');
        foreach ($files as $key => $file) {
            $image_path = $file->store('images/manga');

            $newImage = new Image;
            $newImage->name = basename($image_path);
            $newImage->save();

            $newChater->addImage($key, $newImage);
        }

        return redirect()->route('admin.mangas.show', [ 'id' => $newChater->manga_id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
