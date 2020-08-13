<?php

namespace App\Http\Controllers;

use App\Project;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * @OA\Get(
     *      path="/projects",
     *      operationId="getProjectsList",
     *      tags={"Projects"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  title="data",
     *                  description="Data-Wrapper",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", ref="#components/schemas/Project/properties/id"),
     *                      @OA\Property(property="name", ref="#components/schemas/Project/properties/name"),
     *                      @OA\Property(property="description", ref="#components/schemas/Project/properties/description"),
     *                      @OA\Property(property="is_completed", ref="#components/schemas/Project/properties/is_completed"),
     *                      @OA\Property(property="created_at", ref="#components/schemas/Project/properties/created_at"),
     *                      @OA\Property(property="updated_at", ref="#components/schemas/Project/properties/updated_at"),
     *                      @OA\Property(
     *                          property="tasks_count",
     *                          title="tasks_count",
     *                          description="Number of tasks in the project",
     *                          type="integer",
     *                          example=1
     *                      )
     *                  )
     *              )
     *          ),
     *      ),
     * )
     */
    public function index()
    {
        $projects = Project::where('is_completed', false)
                            ->orderBy('created_at', 'desc')
                            ->withCount(['tasks' => function ($query) {
                                $query->where('is_completed', false);
                            }])
                            ->get();

        return new ProjectResource($projects);
    }

    /**
     * @OA\Post(
     *      path="/projects",
     *      operationId="storeProject",
     *      tags={"Projects"},
     *      summary="Store a new project",
     *      description="Returns created project data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="name", ref="#components/schemas/Project/properties/name"),
     *              @OA\Property(property="description", ref="#components/schemas/Project/properties/description"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  title="data",
     *                  description="Data-Wrapper",
     *                  type="object",
     *                  @OA\Property(property="id", ref="#components/schemas/Project/properties/id"),
     *                  @OA\Property(property="name", ref="#components/schemas/Project/properties/name"),
     *                  @OA\Property(property="description", ref="#components/schemas/Project/properties/description"),
     *                  @OA\Property(property="created_at", ref="#components/schemas/Project/properties/created_at"),
     *                  @OA\Property(property="updated_at", ref="#components/schemas/Project/properties/updated_at"),
     *              )
     *          ),
     *      ),
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        return (new ProjectResource($project))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/projects/{projectId}",
     *      operationId="getOneProject",
     *      tags={"Projects"},
     *      summary="Get details of a single project",
     *      description="Returns the project details and an array of tasks associated with the project",
     *      @OA\Parameter(
     *          name="projectId",
     *          description="Project ID",
     *          in="path",
     *          required=true,
     *          example=1,
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  title="data",
     *                  description="Data-Wrapper",
     *                  type="object",
     *                  @OA\Property(property="id", ref="#components/schemas/Project/properties/id"),
     *                  @OA\Property(property="name", ref="#components/schemas/Project/properties/name"),
     *                  @OA\Property(property="description", ref="#components/schemas/Project/properties/description"),
     *                  @OA\Property(property="is_completed", ref="#components/schemas/Project/properties/is_completed"),
     *                  @OA\Property(property="created_at", ref="#components/schemas/Project/properties/created_at"),
     *                  @OA\Property(property="updated_at", ref="#components/schemas/Project/properties/updated_at"),
     *                  @OA\Property(
     *                      property="tasks",
     *                      title="tasks",
     *                      description="array of task object",
     *                      type="array",
     *                      @OA\Items(ref="#/components/schemas/Task"),
     *                  ),
     *              )
     *          ),
     *      ),
     * )
     */
    public function show($id)
    {
        $project = Project::with(['tasks' => function ($query) {
            $query->where('is_completed', false);
        }])->find($id);

        return new ProjectResource($project);
    }

    /**
     * @OA\Put(
     *      path="/projects/{projectId}",
     *      operationId="markProjectAsComplete",
     *      tags={"Projects"},
     *      summary="Mark project as complete",
     *      description="Returns updated project data with is_completed to true",
     *      @OA\Parameter(
     *          name="projectId",
     *          description="Project ID",
     *          in="path",
     *          required=true,
     *          example=1,
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  title="data",
     *                  description="Data-Wrapper",
     *                  type="object",
     *                  @OA\Property(property="id", ref="#components/schemas/Project/properties/id"),
     *                  @OA\Property(property="name", ref="#components/schemas/Project/properties/name"),
     *                  @OA\Property(property="description", ref="#components/schemas/Project/properties/description"),
     *                  @OA\Property(property="is_completed", ref="#components/schemas/Project/properties/is_completed"),
     *                  @OA\Property(property="created_at", ref="#components/schemas/Project/properties/created_at"),
     *                  @OA\Property(property="updated_at", ref="#components/schemas/Project/properties/updated_at"),
     *              )
     *          ),
     *      ),
     * )
     */
    public function markAsCompleted($projectId)
    {
        $project = Project::find($projectId);
        $project->is_completed = true;
        $project->save();

        return (new ProjectResource($project))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
