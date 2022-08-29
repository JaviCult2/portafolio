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
            \DB::beginTransaction();

            $project = new Project;

            $project->fill($request->all());

            $project->saveOrFail();

            if ($request->developers) {
                foreach ($request->developers as $item) {

                    foreach ($item as $key => $value) {

                        switch ($key) {
                            case "name":
                                $name = $value;
                                break;
                            case "last_name":
                                $last_name = $value;
                                break;
                        }
                    }

                    $developer = new Developer;

                    $developer->fk_id_project = $project->id;
                    $developer->name = $name;
                    $developer->last_name = $last_name;

                    $developer->saveOrFail();
                }
            }

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Save Success'
            ]);

        } catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Save Error',
                'error' => $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine(),
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            \DB::beginTransaction();

            $project = Project::find($request->id);

            $project->fill($request->all());

            $project->saveOrFail();

            Developer::where('fk_id_project', $request->id)->delete();

            if ($request->developers) {
                foreach ($request->developers as $item) {

                    foreach ($item as $key => $value) {

                        switch ($key) {
                            case "name":
                                $name = $value;
                                break;
                            case "last_name":
                                $last_name = $value;
                                break;
                        }
                    }

                    $developer = new Developer;

                    $developer->fk_id_project = $project->id;
                    $developer->name = $name;
                    $developer->last_name = $last_name;

                    $developer->saveOrFail();
                }
            }

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Save Success'
            ]);

        } catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Update Error',
                'error' => $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine(),
            ]);
        }
    }

    public function delete($id)
    {

        try {
            \DB::beginTransaction();

            Developer::where('fk_id_project', $id)->delete();

            Project::find($id)->delete();

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Delete success'
            ]);

        } catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Delete Error',
                'error' => $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine(),
            ]);
        }
    }

    public function active($id)
    {
        try {
            \DB::beginTransaction();

            $project = Project::find($id);

            $project->active = !$project->active;

            $project->saveOrFail();

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Active success'
            ]);

        } catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Active Error',
                'error' => $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine(),
            ]);
        }
    }
}
