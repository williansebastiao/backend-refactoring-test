<?php

namespace App\Http\Controllers;

use App\Constants\StatusCode;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\UseCases\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *      path="/users",
     *      operationId="getUsersList",
     *      summary="Get list of users",
     *      tags={"Users"},
     *      description="Returns list of users",
     *      security={
     *          {"bearerAuth": {}}
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(
     *                      property="id",
     *                      type="integer",
     *                      example=1
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      example="John Doe"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      format="email",
     *                      example="john.doe@example.com"
     *                  ),
     *                  @OA\Property(
     *                      property="email_verified_at",
     *                      type="string",
     *                      format="date-time",
     *                      nullable=true,
     *                      example=null
     *                  ),
     *                  @OA\Property(
     *                      property="created_at",
     *                      type="string",
     *                      format="date-time",
     *                      example="2024-07-24T15:53:32.000000Z"
     *                  ),
     *                  @OA\Property(
     *                      property="updated_at",
     *                      type="string",
     *                      format="date-time",
     *                      example="2024-07-24T16:51:39.000000Z"
     *                  ),
     *                  @OA\Property(
     *                      property="deleted_at",
     *                      type="string",
     *                      format="date-time",
     *                      nullable=true,
     *                      example=null
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $user = $this->userService->findAll();
            return response()->json($user, StatusCode::SUCCESS);
        } catch (\Exception $e) {
            return response()->json(['detail' => $e->getMessage()], StatusCode::INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show a specific user resource
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *      path="/users/{id}",
     *      operationId="showUser",
     *      summary="Show a specific user",
     *      tags={"Users"},
     *      description="Returns a specific user",
     *      security={
     *          {"bearerAuth": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="User ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="id",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="John Doe"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  format="email",
     *                  example="john.doe@example.com"
     *              ),
     *              @OA\Property(
     *                  property="email_verified_at",
     *                  type="string",
     *                  format="date-time",
     *                  nullable=true,
     *                  example=null
     *              ),
     *              @OA\Property(
     *                  property="created_at",
     *                  type="string",
     *                  format="date-time",
     *                  example="2024-07-24T15:53:32.000000Z"
     *              ),
     *              @OA\Property(
     *                  property="updated_at",
     *                  type="string",
     *                  format="date-time",
     *                  example="2024-07-24T16:51:39.000000Z"
     *              ),
     *              @OA\Property(
     *                  property="deleted_at",
     *                  type="string",
     *                  format="date-time",
     *                  nullable=true,
     *                  example=null
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(int $id): JsonResponse
    {
        try {
            $user = $this->userService->findById($id);
            return response()->json($user, StatusCode::SUCCESS);
        } catch (\Exception $e) {
            return response()->json(['detail' => $e->getMessage()], StatusCode::INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @return JsonResponse
     *
     * @OA\Post(
     *      path="/users",
     *      operationId="storeUser",
     *      summary="Store a new user",
     *      tags={"Users"},
     *      description="Stores a new user",
     *      security={
     *          {"bearerAuth": {}}
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"name", "email", "password"},
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="John Doe"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  format="email",
     *                  example="john.doe@example.com"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="secret"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="id",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="John Doe"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  format="email",
     *                  example="john.doe@example.com"
     *              ),
     *              @OA\Property(
     *                  property="created_at",
     *                  type="string",
     *                  format="date-time",
     *                  example="2024-07-24T15:53:32.000000Z"
     *              ),
     *              @OA\Property(
     *                  property="updated_at",
     *                  type="string",
     *                  format="date-time",
     *                  example="2024-07-24T16:51:39.000000Z"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(UserCreateRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->store($request->validated());
            return response()->json($user, StatusCode::CREATED);
        } catch (\Exception $e) {
            return response()->json(['detail' => $e->getMessage()], StatusCode::INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update a specific user resource
     *
     * @return JsonResponse
     *
     * @OA\Put(
     *      path="/users/{id}",
     *      operationId="updateUser",
     *      summary="Update a specific user",
     *      tags={"Users"},
     *      description="Updates a specific user",
     *      security={
     *          {"bearerAuth": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="User ID",
     *          required=true,
     *          in="path",
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"name", "email", "password"},
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="John Doe"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  format="email",
     *                  example="john.doe@example.com"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="secret"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="id",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="John Doe"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  format="email",
     *                  example="john.doe@example.com"
     *              ),
     *              @OA\Property(
     *                  property="email_verified_at",
     *                  type="string",
     *                  format="date-time",
     *                  nullable=true,
     *                  example=null
     *              ),
     *              @OA\Property(
     *                  property="created_at",
     *                  type="string",
     *                  format="date-time",
     *                  example="2024-07-24T15:53:32.000000Z"
     *              ),
     *              @OA\Property(
     *                  property="updated_at",
     *                  type="string",
     *                  format="date-time",
     *                  example="2024-07-24T16:51:39.000000Z"
     *              ),
     *              @OA\Property(
     *                  property="deleted_at",
     *                  type="string",
     *                  format="date-time",
     *                  nullable=true,
     *                  example=null
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function update(int $id, UserUpdateRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->update($id, $request->validated());
            return response()->json($user, StatusCode::SUCCESS);
        } catch (\Exception $e) {
            return response()->json(['detail' => $e->getMessage()], StatusCode::INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove a specific user resource
     *
     * @return JsonResponse
     *
     * @OA\Delete(
     *      path="/users/{id}",
     *      operationId="deleteUser",
     *      summary="Delete a specific user",
     *      tags={"Users"},
     *      description="Deletes a specific user",
     *      security={
     *          {"bearerAuth": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="User ID",
     *          required=true,
     *          in="path",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->userService->destroy($id);
            return response()->json(['detail'=> 'Data deleted'], StatusCode::SUCCESS);
        } catch (\Exception $e) {
            return response()->json(['detail' => $e->getMessage()], StatusCode::INTERNAL_SERVER_ERROR);
        }
    }
}

