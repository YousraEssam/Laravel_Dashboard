<?php

namespace App\Http\Controllers;

use App\Event;
use App\Events\NewEventHasBeenAddedEvent;
use App\Http\Requests\EventRequest;
use App\Traits\Uploads;
use App\User;
use App\Visitor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    use Uploads;

    public function __construct()
    {
        $this->authorizeResource(Event::class, 'event');
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
                    'visitors', function ($row) {
                        return view('events.visitors', compact('row'));
                    }
                )
                ->editColumn(
                    'is_published', function ($row) {
                        $this->checkStatus($row);
                        return view('events.status', compact('row'));
                    }
                )
                ->addColumn('actions', 'events.buttons')
                ->rawColumns(['actions'])
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
        $visitors = Visitor::with('user')->get();
        return view('events.create', compact('visitors'));
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

        $this->checkStatus($event);

        event(new NewEventHasBeenAddedEvent($event));

        if($request->input('image')) {
            foreach($request->input('image') as $img){
                $event->images()->create([ 'url' => $img ]);
            }
        }
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
        $images = $event->images()->get();
        $visitors = $event->visitors()->get();
        return view('events.show', compact('event', 'images', 'visitors'));
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

        $all_visitors = Visitor::pluck('id')->all();

        $visitors = $event->visitors()->with('user')->get();

        return view('events.edit', compact('event', 'images', 'all_visitors', 'visitors'));
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

        $new_visitors = $request->visitors;
        $event->visitors()->sync($new_visitors);

        $this->checkStatus($event);

        if($request->input('image')) {
            $event->images()->delete();
            foreach($request->input('image') as $img){
                $event->images()->create(['url' => $img]);
            }
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
        $status = $event->is_published ? 0 : 1;
        $event->update(['is_published' => $status]);

        return \Response::json('success');
    }

    /**
     * Check Event dates with current date to be published or not
     */
    public function checkStatus($event)
    {
        $now = now()->toDateTimeString();

        if(strtotime($now) >= strtotime($event->start_date) 
            && strtotime($now) <= strtotime($event->end_date)
        ) {
            $event->update(['is_published' => true]);
        }else{
            $event->update(['is_published' => false]);
        }
    }
}
