<?php
/**
 * Created by PhpStorm.
 * User: roocket
 * Date: 6/4/2017
 * Time: 8:12 PM
 */

namespace App;


trait HasRole
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        if(is_string($role)) {
            return $this->roles->contains('name' , $role);
        }
//
//        foreach ($role as $r) {
//            if($this->hasRole($r->name)) {
//                return true;
//            }
//        }
//        return false;

        return !! $role->intersect($this->roles)->count();
    }
}