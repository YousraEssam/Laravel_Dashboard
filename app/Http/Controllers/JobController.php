<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Job;
use Yajra\DataTables\DataTables;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Job::class);
        // $jobs = Job::paginate(5);
        // return view('jobs.index', compact('jobs'));

        if(request()->ajax()){
            $jobs = Job::latest()->get();
            return DataTables::of($jobs)
            ->addIndexColumn()
            ->addColumn('actions', 'jobs.buttons')
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('jobs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Job::class);
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        Job::create($request->all());
        return redirect()->route('jobs.index')
            ->with('success', 'Job Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $this->authorize('view', Job::class);
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $this->authorize('update', Job::class);
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, Job $job)
    {
        $job->update($request->all());
        return redirect()->route('jobs.index')
            ->with('success', 'Job Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $this->authorize('delete', Job::class);
        $job->delete();
        return redirect()->route('jobs.index')
            ->with('success', 'Job Deleted Successfully');
    }
}
