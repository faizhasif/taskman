<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Task",
 *     description="Task model",
 *     @OA\Xml(
 *         name="Task"
 *     ),
 *     @OA\Property(
 *         property="id",
 *         title="id",
 *         description="Task ID",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *          property="title",
 *          title="title",
 *          description="Title of the task",
 *          type="string",
 *          example="A nice task"
 *     ),
 *     @OA\Property(
 *         property="project_id",
 *         title="project_id",
 *         description="The project ID this task is in",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *          property="is_completed",
 *          title="is_completed",
 *          description="Status of the task",
 *          type="boolean",
 *          example=false
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         title="created_at",
 *         description="DateTime the task is created",
 *         format="date-time",
 *         type="string",
 *         example="2020-01-27 17:50:45"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         title="updated_at",
 *         description="DateTime the task is last updated",
 *         format="date-time",
 *         type="string",
 *         example="2020-01-27 17:50:45"
 *     )
 * )
 */
class Task extends Model
{
    protected $fillable = ['title', 'project_id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
        'is_completed' => 'boolean'
    ];
}
