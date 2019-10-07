<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\News;
use App\StaffMember;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
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
        $news = News::latest()->with('staffMember');
        if(request()->ajax()) {
            return DataTables::of($news)
                ->addIndexColumn()
                ->editColumn('author', function($row){
                    return view('news.fullname', compact('row'));
                })
                ->addColumn('actions', 'news.buttons')
                ->rawColumns(['author', 'actions'])
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
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        News::create($request->all());
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
        return view('news.show', compact('news','staffMember'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
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
}
