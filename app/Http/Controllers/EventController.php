<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Event;
use App\Traits\Uploads;
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
        $event = Event::latest()->with('visitors','images');
        if(request()->ajax()){
            return DataTables::of($event)
                ->addIndexColumn()
                ->addColumn('actions', function($row){
                    return view('events.buttons', compact('row'));
                })
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
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        return redirect()
        ->route('events.index')
        ->with('success', 'New Event Has Been Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        return redirect()
        ->route('events.index')
        ->with('success', 'Event Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
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
        return "success";
    }
}
