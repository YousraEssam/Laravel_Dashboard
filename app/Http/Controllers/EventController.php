<?php

namespace App\Http\Controllers;

use App\Event;
use App\Events\NewEventHasBeenAddedEvent;
use App\Http\Requests\EventRequest;
use App\Image;
use App\Traits\Uploads;
use App\Visitor;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Symfony\Component\HttpFoundation\Request;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    use Uploads;

    public function __construct()
    {
        $this->authorizeResource(Event::class, 'events');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::latest()->with('visitors.user', 'images');
        if(request()->ajax()) {
            return DataTables::of($event)
                ->addIndexColumn()
                ->editColumn(
                    'cover_url', function($row){
                        return "<img src=".Storage::url($row->images()->whereId($row->cover_url)->first()->url)." style='height:50px; width:50px;'>";
                    })
                ->editColumn(
                    'visitors', function ($row) {
                        return view('events.visitors', compact('row'));
                    })
                ->editColumn(
                    'is_published', function ($row) {
                        return view('events.status', compact('row'));
                    })
                ->addColumn('actions', 'events.buttons')
                ->rawColumns(['cover_url', 'visitors', 'is_published', 'actions'])
                ->make(true);
        }
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    public function getEventVisitors(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $event_visitors = Visitor::whereHas(
            'user', function ($query) use ($term) {
                        return $query->where('first_name', 'like', "%$term%")
                            ->orWhere('last_name', 'like', "%$term%");
            }
        )->get();

        $visitors = [];
        foreach($event_visitors as $visitor){
            if($visitor->user) {
                $visitors[] = ['id' => $visitor->id, 'text' => $visitor->user->first_name." ".$visitor->user->last_name];
            }
        }
        return \Response::json($visitors);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {        
        $event = Event::create($request->all());
        $event->visitors()->attach($request->visitors);
        $event->cover_url = $request->cover_url;
        
        if($request->input('image')) {
            $images = Image::whereIn('id', $request->input('image'))->get();
            $event->images()->createMany($images);
        }

        event(new NewEventHasBeenAddedEvent($event));
        
        return redirect()
            ->route('events.index')
            ->with('success', 'New Event Has Been Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event->load('images', 'visitors');
        $cover = $event->images()->whereId($event->cover_url)->first()->url;
        return view('events.show', compact('event','cover'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $images = $event->images()->get();
        $visitors = $event->visitors()->get()->pluck('user.full_name', 'id');
        return view('events.edit', compact('event', 'images', 'visitors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Event               $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->all());
        $event->visitors()->sync($request->visitors);
        $event->cover_url = $request->cover_url;

        if($request->input('image')) {
            $event->images()->delete();
            $images = Image::whereIn('id', $request->input('image'))->get();
            $event->images()->saveMany($images);
        }
        return redirect()
            ->route('events.index')
            ->with('success', 'Event Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()
            ->route('events.index')
            ->with('success', 'Event Has Been Deleted Successfully');
    }

    /**
     * Toggle Event Publish 
     */
    public function togglePublish(Event $event)
    {
        $event->update(['is_published' => ! $event->is_published]);
        return \Response::json('success');
    }

    /**
     * fireBase retrieve
     */
    public function fireBase(){
        $factory = (new Factory)
            ->withServiceAccount(base_path().'/laravel-firebase.json')
            ->withDatabaseUri('https://laravel-dashboard-training.firebaseio.com/');

        $database = $factory->createDatabase();
        $reference = $database->getReference('events/');
        $value = $reference->getValue();

        return view('firebase.show', compact('value'));
    }
}