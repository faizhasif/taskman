<?php

/**
 * @OA\Schema(
 *      title="Store Project Request",
 *      description="Store Project request body data",
 *      type="object",
 *      required={"name","description"},
 *      @OA\Xml(name="StoreProjectRequest"),
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
     *      example="This is the project's description",
     * )
     *
     * @var string
     */
    public $description;
}
