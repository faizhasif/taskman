<?php

/**
 * @OA\Schema(
 *      title="StoreProjectRequest",
 *      description="Store Project request body data",
 *      type="object",
 *      required={"name","description"},
 * )
 */
class StoreProjectRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new project",
     *      example="A nice project",
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the new project",
     *      example="This is the new project's description",
     * )
     *
     * @var string
     */
    public $description;
}
