<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\News;
use App\Related;
use App\StaffMember;
use App\Traits\Uploads;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    use Uploads;

    public function __construct()
    {
        $this->authorizeResource(News::class, 'news');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->with('staffMember','staffMember.user');
        if(request()->ajax()) {
            return DataTables::of($news)
                ->addIndexColumn()
                ->editColumn('author', function($row){
                    return $row->staffMember->user->getFullNameAttribute();
                })
                ->editColumn('is_published', function($row){
                    return view('news.publish', compact('row'));
                })
                ->addColumn('actions', 'news.buttons')
                ->rawColumns(['author', 'is_published', 'actions'])
                ->make(true);
        }
        return view('news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = News::pluck('main_title', 'id')->all();
        return view('news.create', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news = News::create($request->all());

        if($request->related){
            foreach($request->related as $related)
            $news->related()->create([ 'related_id' => $related ]);
        }
        
        if($request->input('image')){
            foreach($request->input('image') as $img){
                $news->images()->create(['url' => $img]);
            }
        }

        if($request->input('file')){
            foreach($request->input('file') as $file){
                $news->files()->create(['file_url' => $file]);
            }
        }

        return redirect()
            ->route('news.index')
            ->with('success', 'News Has Been Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $staffMember = $news->staffMember();
        $images = $news->images();
        $files = $news->files();
        return view('news.show', compact('news', 'staffMember', 'images', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $images = $news->images()->get();
        $files = $news->files()->get();
        $all_news = News::pluck('main_title', 'id')->all();
        $related_news = Related::where('news_id', $news->id)->pluck('related_id')->all();
        return view('news.edit', compact('news', 'images', 'files', 'related_news', 'all_news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $news->update($request->all());

        if($request->related){
            $news->related()->delete();
            foreach($request->related as $related)
            $news->related()->create([ 'related_id' => $related ]);
        }

        if($request->hasFile('image')){
            $img_path = $this->uploadImage($request, $news);
            $news->images()->delete();
            foreach($img_path as $img){
                $news->images()->create(['url' => $img]);
            }
        }

        if($request->hasFile('file')){
            $file_path = $this->uploadFile($request, $news);
            $news->files()->delete();
            foreach($file_path as $file){
                $news->files()->create(['file_url' => $file]);
            }
        }
        return redirect()
            ->route('news.index')
            ->with('success', 'News Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()
            ->route('news.index')
            ->with('success', 'News Has Been Deleted Successfully');
    }

    /**
     * get author list for writers and reporters based on chosen type
     */
    public function getAuthorList($type){
        if($type == "News"){

            $reporters = StaffMember::with('user','job')->where('job_id',2)->get();

            return response()->json($reporters);
            
        }elseif($type == "Article"){

            $writers = StaffMember::with('user','job')->where('job_id',1)->get();

            return response()->json($writers);
        }
    }

    /**
     * Toggle News Publish 
     */
    public function togglePublish(News $news)
    {
        $status = $news->is_published ? 0 : 1;
        $news->update(['is_published' => $status]);
        return "success";
    }
}
