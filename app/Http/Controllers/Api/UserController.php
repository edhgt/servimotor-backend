<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\UserCreatedAccount;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::with('empleado')->orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user =
            $password = $request->isRandomPassword
                    ? Str::password(12, true, true, false)
                    : $request->password;
            $name = trim(preg_replace('/\\s+/', ' ', "{$request->primer_nombre} {$request->segundo_nombre} {$request->primer_apellido} {$request->segundo_apellido}"));
            $user = User::create(array_merge(
                $request->except(['roles', 'password', 'name']),
                [
                    'name' => $name,
                    'password' => Hash::make($password),
                    
                ]
            ));

            $user->assignRole($request->roles);

            $rolesAsignados = $user->roles->pluck('name')->implode(', ');
            $user->empleado()->create(array_merge(
                $request->all(),
                [
                    'sucursal_id' => auth()->id()
                ]
            ));
            
            if($request->isSendPassword) {
                $user->notify(new UserCreatedAccount($password, $rolesAsignados));
            }

            DB::commit();

            return response()->json(new UserResource($user), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        if($request->has('roles')) {
            return response()->json($user->roles);
        }

        return response()->json(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());

        return response()->json(new UserResource($user));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
