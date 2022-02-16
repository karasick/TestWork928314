<?php

namespace App\Http\Controllers\Post\Dtos;

use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Json;

/**
 * @OA\Schema(
 *     title="Post List with Pagination",
 *     description="Post list DTO with pagination",
 *     @OA\Xml(
 *         name="PostPaginationDto"
 *     )
 * )
 */
class PostPaginationDto
{
    /**
     * @OA\Property(
     *     title="Post list",
     *     description="List of posts at current page"
     * )
     *
     * @var PostDto[]
     */
    public $data;

    /**
     * @OA\Property(
     *     title="Current page",
     *     description="Current page of post list",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $current_page;

    /**
     * @OA\Property(
     *     title="Per page",
     *     description="Amount of posts in list per page",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $per_page;

    /**
     * @OA\Property(
     *     title="To",
     *     description="Last post's id number in post list",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $to;

    /**
     * @OA\Property(
     *     title="From",
     *     description="First post's id number in post list",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $from;

    /**
     * @OA\Property(
     *     title="Total",
     *     description="Total amount of posts",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $total;

    public function __construct($data, $info)
    {
        $this->data = $data;
        $this->current_page = $info['current_page'];
        $this->per_page = $info['per_page'];
        $this->to = $info['to'];
        $this->from = $info['from'];
        $this->total = $info['total'];
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'currentPage' => $this->current_page,
            'perPage' => $this->per_page,
            'to' => $this->to,
            'from' => $this->from,
            'total' => $this->total,
        ];
    }
}
