<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\NewsRequest;
use App\Image;
use App\News;
use App\Related;
use App\StaffMember;
use App\Traits\Uploads;
use Symfony\Component\HttpFoundation\Request;
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
        $news = News::latest()->with('staffMember.user');
        if(request()->ajax()) {
            return DataTables::of($news)
                ->addIndexColumn()
                ->editColumn(
                    'author', function ($row) {
                        return $row->staffMember->user->getFullNameAttribute();
                    }
                )
                ->addColumn(
                    'actions', function ($row) {
                        return view('news.buttons', compact('row'));
                    }
                )
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
        $types = News::NEWS_TYPE;
        return view('news.create', compact('types'));
    }

    public function getPublishedNews(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $published_related = News::published()
            ->where('main_title', 'like', "%$term%")->get();

        $published = [];
        
        foreach($published_related as $pub){
            $published[] = ['id' => $pub->id, 'text' => $pub->main_title];
        }
        return \Response::json($published);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news = News::create($request->all());
        $news->related()->attach($request->related);

        if($request->input('image')) {
            $images = Image::whereIn('id', $request->input('image'))->get();
            $news->images()->createMany($images);
        }

        if($request->input('file')) {
            $files = File::whereIn('id', $request->input('file'))->get();
            $news->files()->createMany($files);
        }

        return redirect()
            ->route('news.index')
            ->with('success', 'News Has Been Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $images = $news->images()->get();
        $files = $news->files()->get();
        $all_news = News::pluck('main_title', 'id')->all();
        $related_news = Related::where('news_id', $news->id)->pluck('related_id')->all();
        $types = News::NEWS_TYPE;
        return view('news.edit', compact('news', 'images', 'files', 'related_news', 'all_news', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\News                $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $news->update($request->all());
        $new_related = $request->input('related');
        $news->related()->sync($new_related);

        if($request->input('image')) {
            $news->images()->delete();
            $images = Image::whereIn('id', $request->input('image'))->get();
            $news->images()->saveMany($images);
        }

        if($request->input('file')) {
            $news->files()->delete();
            $files = File::whereIn('id', $request->input('file'))->get();
            $news->files()->saveMany($files);
        }
        return redirect()
            ->route('news.index')
            ->with('success', 'News Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News $news
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
    public function getAuthorList($type)
    {
        if (! News::NEWS_TYPE[$type]) {
            return response()->json(['message' => 'Article type not found'], 404);
        }
        $staffMember = StaffMember::with(['user', 'job'])
        ->get()->filter(function ($member) use ($type) {
            return $member->job->name == News::NEWS_TYPE[$type];
        });  
        return response()->json($staffMember);
    }

    /**
     * Toggle News Publish 
     */
    public function togglePublish(News $news)
    {
        $news->update(['is_published' => ! $news->is_published]);
        return \Response::json('success');
    }
}
