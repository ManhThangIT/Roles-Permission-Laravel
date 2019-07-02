<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Repositories\PermissionRepository;
// use App\Repositories\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\UsersPermission;
use App\Models\Role;

class PermissionController extends AppBaseController
{
    /** @var  PermissionRepository */
    private $permissionRepository;
    private $roleRepository;
    private $usersPermission;

    public function __construct(PermissionRepository $permissionRepo, Role $roleRepository, UsersPermission $usersPermission )
    {
        $this->permissionRepository = $permissionRepo;
        $this->roleRepository = $roleRepository;
        $this->usersPermission = $usersPermission;

    }

    /**
     * Display a listing of the Permission.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->permissionRepository->pushCriteria(new RequestCriteria($request));
        $permissions = $this->permissionRepository->all();

        return view('permissions.index')
        ->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new Permission.
     *
     * @return Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param CreatePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionRequest $request)
    {
        $input = $request->all();

        $permission = $this->permissionRepository->create($input);

        Flash::success('Permission saved successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        return view('permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

       $permission = $this->permissionRepository->findWithoutFail($id);

        // if (empty($permission)) {
        //     Flash::error('Permission not found');

        //     return redirect(route('permissions.index'));
        // }

       $role =  $this->roleRepository->all();
       return view('permissions.edit-permision', compact('role'))->with('id', $id);
   }

    /**
     * Update the specified Permission in storage.
     *
     * @param  int              $id
     * @param UpdatePermissionRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        // $permission = $this->permissionRepository->findWithoutFail($id);

        // if (empty($permission)) {
        //     Flash::error('Permission not found');

        //     return redirect(route('permissions.index'));
        // }

        // $permission = $this->permissionRepository->update($request->all(), $id);

        // Flash::success('Permission updated successfully.');

        // Update nhung route do vao  table user_permission
     
        $this->usersPermission->where('permissions_id', $id)->delete();
        foreach ($request->get('permissions') as $key => $value) {
            $idRoles = $this->roleRepository->where('name', $value)->first();
            if($idRoles){
                $userspermission = new UsersPermission();
                $userspermission->permissions_id    = $id;
                $userspermission->roles_id          = $idRoles->id;
                $userspermission->save();
            }
        }
        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $this->permissionRepository->delete($id);

        Flash::success('Permission deleted successfully.');

        return redirect(route('permissions.index'));
    }
}
