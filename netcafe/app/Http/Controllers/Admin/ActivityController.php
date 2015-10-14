<?php

namespace Netcafe\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Netcafe\Models\Activity;
use Netcafe\Http\Requests;
use Netcafe\Http\Controllers\Controller;
use Netcafe\Http\Requests\ActivityCreateRequest;
use Netcafe\Http\Requests\ActivityUpdateRequest;

class ActivityController extends Controller
{

    protected $fields = [
                'title'         => '',
                'description'   => '',
                'status'        => '',
    ];  

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $activities = Activity::all();

        return view('admin.activity.index')
                    ->withActivities($activities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }

        return view('admin.activity.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ActivityCreateRequest $request)
    {
        //
        $activity = new Activity();
        foreach (array_keys($this->fields) as $field) {
            $activity->$field = $request->get($field);
        }
        $activity->save();

        return redirect('/admin/activity')
            ->withSuccess("The activity '$activity->title' was created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $activity = Activity::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $activity->$field);
        }

        return view('admin.activity.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ActivityUpdateRequest $request, $id)
    {
        //
        $activity = Activity::findOrFail($id);

        foreach (array_keys(array_except($this->fields, ['activity'])) as $field) {
            $activity->$field = $request->get($field);
        }
        $activity->save();

        return redirect("/admin/activity/$id/edit")
            ->withSuccess("Changes saved.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //

        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect('/admin/activity')
            ->withSuccess("The '$activity->title' activity has been deleted.");
    }
}
