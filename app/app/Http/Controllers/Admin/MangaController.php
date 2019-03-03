<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Manga;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mangas = Manga::get();
        foreach ($mangas as $key => $manga) {
            $nextManga = $manga;
            $nextManga->link_to_show = route('admin.mangas.show', [ 'id' => $manga->id ]);
            $nextManga->link_to_edit = route('admin.mangas.edit', [ 'id' => $manga->id ]);
            $nextManga->link_to_delete = route('admin.mangas.destroy', [ 'id' => $manga->id ]);
            $mangas[$key] = $nextManga;
        }
        return [
            'link_to_create' => route('admin.mangas.create'),
            'mangas' => $mangas
        ];
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
        $newManga = new Manga;
        $newManga->name = $request->get('name');
        $newManga->abstract = $request->get('abstract');
        $newManga->is_close = $request->has('is_close') == true;
        $newManga->save();

        return redirect()->route('admin.mangas.index');
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

        return view('admin.mangas.show', [
            'manga' => $manga,
            'link_to_add_chater' => route('admin.manga-chaters.create', [ 'manga_id' => $id ]),
            'chaters' => $manga->chaters,
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
