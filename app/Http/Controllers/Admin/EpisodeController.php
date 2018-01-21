<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Episode;
use App\Http\Requests\EpisodeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EpisodeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = Episode::latest()->paginate(20);
        return view('Admin.episodes.all' , compact('episodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.episodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EpisodeRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpisodeRequest $request)
    {
        $episode = Episode::create($request->all());
        $this->setCourseTime($episode);

        return redirect(route('episodes.index'));
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
     * @param Episode $episode
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Episode $episode)
    {
        return view('Admin.episodes.edit' , compact('episode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EpisodeRequest|Request $request
     * @param Episode $episode
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(EpisodeRequest $request, Episode $episode)
    {
        $episode->update($request->all());
        $this->setCourseTime($episode);

        return redirect(route('episodes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Episode $episode
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Episode $episode)
    {
        $episode->delete();
        return redirect(route('episodes.index'));
    }
}
