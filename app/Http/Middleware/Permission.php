<?php

namespace App\Http\Middleware;

use Auth;
use Route;
use Flash;
use Closure;
use App\Models\Role;
use App\Models\UsersPermission;
use Model\Entity\Foo;

class Permission
{

    protected $roles;
    protected $userspermissions;
    public function __construct(Role $roles,UsersPermission $userspermissions){
        $this->roles = $roles;
        $this->userspermissions = $userspermissions;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // cho nay lay route name chuan bi request toi,
        $routeName = explode('.', Route::currentRouteName());
        //tach route name do ra gom nhung gi
        // roi goi ham checkRoute de merge chung route voi nhau
        // dd($routeName);

        if(!empty($routeName[1]) && !empty($routeName[0])){
            $route = $this->checkRoute($routeName[1], $routeName[0]);
        } else {
            $route = $routeName;
        }

        $getRouteName  = $this->roles->where('name', $route)->first();
        // dd($getRouteName);
        if(empty($getRouteName))
        {
            flash('Bạn không có quyền truy cập vào chức năng này .')->error();
            return redirect()->route('home');
        }

        $usersPermissions = $this->userspermissions
                            ->where('permissions_id',Auth::user()->permissions_id)
                            ->where('roles_id', $getRouteName->id)->count();
        if($usersPermissions != 1)
        {
            flash('Bạn không có quyền truy cập vào chức năng này .')->error();
            return redirect()->route('home');
        }
        return $next($request);
    }

    public function checkRoute($action, $param){
        switch ($action){
            case 'index': return $param.'.index';
            case 'create': return $param.'.create,'.$param.'.store';
            case 'store': return $param.'.create,'.$param.'.store';
            case 'edit': return $param.'.edit,'.$param.'.update';
            case 'destroy': return $param.'.destroy';
            default: return $param.'.index';
        }
    }
}
