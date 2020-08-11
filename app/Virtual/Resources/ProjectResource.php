<?php

/**
 * @OA\Schema(
 *     title="ProjectResource",
 *     description="Project resource",
 *     @OA\Xml(
 *         name="ProjectResource"
 *     )
 * )
 */
class ProjectResource 
{

    /**
     * @OA\Property(
     *      title="data",
     *      description="Data wrapper",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/Project"),
     * )
     *
     * @var \App\Virtual\Models\Project[]
     */
    private $data;
}
