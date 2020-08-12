<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Project",
 *     description="Project model",
 *     @OA\Xml(
 *         name="Project"
 *     ),
 *     @OA\Property(
 *         property="id",
 *         title="id",
 *         description="Project ID",
 *         type="integer",
 *         example=1,
 *     ),
 *     @OA\Property(
 *          property="name",
 *          title="name",
 *          description="Name of the project",
 *          type="string",
 *          example="A nice project"
 *     ),
 *     @OA\Property(
 *          property="description",
 *          title="description",
 *          description="Description of the project",
 *          type="string",
 *          example="This is the project's description"
 *     ),
 *     @OA\Property(
 *          property="is_completed",
 *          title="is_completed",
 *          description="Status of the project",
 *          type="boolean",
 *          example=false
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         title="created_at",
 *         description="DateTime the project is created",
 *         format="date-time",
 *         type="string",
 *         example="2020-01-27 17:50:45"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         title="updated_at",
 *         description="DateTime the project is last updated",
 *         format="date-time",
 *         type="string",
 *         example="2020-01-27 17:50:45"
 *     )
 * )
 */
class Project extends Model
{
    protected $fillable = ['name', 'description'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
        'is_completed' => 'boolean'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
