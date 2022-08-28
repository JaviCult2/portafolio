<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('developers')->orderBy('id', 'asc')->get();

        return response()->json(['projects' => $projects]);
    }

    public function create(Request $request)
    {
        try {

            $project = new Project;

            $project->fill($request->all());

            $project->saveOrFail();

            foreach ($request->developers as $item) {

                foreach ($item as $key => $value) {

                    ($key == "name") ? $name = $value : $last_name = $value;
                }

                $developer = new Developer;

                $developer->fk_id_project = $project->id;
                $developer->name = $name;
                $developer->last_name = $last_name;

                $developer->saveOrFail();
            }

            return response()->json([
                'success' => true,
                'message' => 'Save Success'
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Save Error'
            ]);
        }
    }

    public function update(Request $request)
    {
        try {

            $project = Project::find($request->id);

            $project->fill($request->all());

            $project->saveOrFail();

            Developer::where('fk_id_project', $request->id)->delete();

            //dd($request->developers);

            if ($request->developers)
            {
                foreach ($request->developers as $item) {

                    foreach ($item as $key => $value) {

                        ($key == "name") ? $name = $value : $last_name = $value;
                    }

                    $developer = new Developer;

                    $developer->fk_id_project = $project->id;
                    $developer->name = $name;
                    $developer->last_name = $last_name;

                    $developer->saveOrFail();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Save Success'
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Save Error'
            ]);
        }
    }

    public function delete($id)
    {
        try {
            Project::find($id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Delete success'
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Delete Error'
            ]);
        }
    }

    public function active($id)
    {
        $project = Project::find($id);

        $project->active = !$project->active;

        if ($project->save()) {

            return response()->json([
                'success' => true,
                'message' => 'Active success'
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Active Error'
            ]);
        }
    }
}
