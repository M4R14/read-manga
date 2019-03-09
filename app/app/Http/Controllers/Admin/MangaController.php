<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use App\Models\Manga;
use App\Models\Manga\Image;
use App\Models\Manga\Chater;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mangas = Manga::select()->paginate(15);

        return view('admin.mangas.index', [
            'link_to_create' => route('admin.manga.create'),
            'mangas' => $mangas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mangas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $image_path = $image->store('images/manga');

        $newImage = new Image;
        $newImage->name = basename($image_path);
        $newImage->save();

        $newManga = new Manga;
        $newManga->name         = $request->get('name');
        $newManga->abstract     = $request->get('abstract');
        $newManga->is_close     = $request->has('is_close') == true;
        $newManga->image_cover  = $newImage->id;
        $newManga->save();

        return redirect()->route('admin.manga.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manga = Manga::find($id);
        $chaters = Chater::whereMangaId($id)->paginate(15);
        return view('admin.mangas.show', [
            'manga' => $manga,
            'link_to_add_chater' => route('admin.manga-chater.create', [ 'manga_id' => $id ]),
            'chaters' => $chaters,
        ]) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manga = Manga::find($id);

        return view('admin.mangas.edit', [ 'data' => $manga ]);
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
        $manga = Manga::find($id);

        $image_cover = null;
        if ($request->has('remove_image')) {
            Storage::delete('images/manga/'.$manga->image->name);
        }

        // dd($request->file('image'));
        if ($request->file('image')) {
            $image = $request->file('image');
            $image_path = $image->store('images/manga');

            $newImage = new Image;
            $newImage->name = basename($image_path);
            $newImage->save();

            $image_cover = $newImage->id;
        }
        
        $manga->name        = $request->get('name');
        $manga->abstract    = $request->get('abstract');
        $manga->is_close    = $request->has('is_close');
        $manga->image_cover = $image_cover ?: $manga->image_cover;
        $manga->save();

        // dd($manga);
        
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
        Manga::find($id)->delete();

        return redirect()->back();
    }

    public function getImage($name)
    {
        $image_path = storage_path("app/images/manga/$name");
        $manager = new ImageManager;
        return $manager->make($image_path)->resize(100, 150)->response();
    }
}
