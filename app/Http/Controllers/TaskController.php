<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * @OA\Post(
     *      path="/tasks",
     *      operationId="storeTask",
     *      tags={"Tasks"},
     *      summary="Store a new task",
     *      description="Returns created task data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="project_id", ref="#components/schemas/Project/properties/id"),
     *              @OA\Property(property="title", ref="#components/schemas/Task/properties/title"),
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
     *                  @OA\Property(property="id", ref="#components/schemas/Task/properties/id"),
     *                  @OA\Property(property="title", ref="#components/schemas/Task/properties/title"),
     *                  @OA\Property(property="project_id", ref="#components/schemas/Task/properties/project_id"),
     *                  @OA\Property(property="created_at", ref="#components/schemas/Task/properties/created_at"),
     *                  @OA\Property(property="updated_at", ref="#components/schemas/Task/properties/updated_at"),
     *              )
     *          ),
     *      ),
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(['title' => 'required']);

        $task = Task::create([
            'title' => $validatedData['title'],
            'project_id' => $request->project_id,
        ]);

        return (new TaskResource($task))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *      path="/tasks/{taskId}",
     *      operationId="markTaskAsComplete",
     *      tags={"Tasks"},
     *      summary="Mark a task as complete",
     *      description="Returns updated task data with is_completed to true",
     *      @OA\Parameter(
     *          name="taskId",
     *          description="Task ID",
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
     *                  @OA\Property(property="id", ref="#components/schemas/Task/properties/id"),
     *                  @OA\Property(property="title", ref="#components/schemas/Task/properties/title"),
     *                  @OA\Property(property="project_id", ref="#components/schemas/Task/properties/project_id"),
     *                  @OA\Property(property="is_completed", ref="#components/schemas/Task/properties/is_completed"),
     *                  @OA\Property(property="created_at", ref="#components/schemas/Task/properties/created_at"),
     *                  @OA\Property(property="updated_at", ref="#components/schemas/Task/properties/updated_at"),
     *              )
     *          ),
     *      ),
     * )
     */
    public function markAsCompleted($taskId)
    {
        $task = Task::find($taskId);
        $task->is_completed = true;
        $task->save();

        return (new TaskResource($task))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
