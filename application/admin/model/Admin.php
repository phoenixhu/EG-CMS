<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    public function addadmin($data)
    {
        // 如果传入的值为空或者不是数组则返回false
        if(empty($data) || !is_array($data)) {
            return false;
        }
        if($data['password']) {
            $data['password'] = md5($data['password']);
        }
        // 如果添加成功返回true,否则为false
        if ($this->save($data)) {
            return true;
        } else {
            return false;
        }

    }

    public function getadmin()
    {
        return $this::paginate(3);
    }

    public function saveadmin($data, $admins)
    {
        if (!$data['name']) {
            return 2; //管理员
        }
        if (!$data['password']) {
            $data['password'] = $admins['password'];
        } else {
            $data['password'] =md5($data['password']);
        }
        return $this::update($data);
    }

    public function deleadmin($id)
    {
        if ($this::destroy($id)) {
            return 1;
        } else {
            return 2;
        }

    }
    public function login($data)
    {
        $admin = Admin::getByName($data['name']);
        if ($admin)
        {
            if ($admin['password'] == md5($data['password']))
            {
                return 2; //密码正确
            } else {
                return 3; //密码错误
            }
        } else {
            return 1; //用户不存在
        }
    }
}
