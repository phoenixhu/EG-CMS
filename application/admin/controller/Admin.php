<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin as AdminModel;
class Admin extends Controller
{
    public function lst()
    {
        $admin = new AdminModel();
        $adminres= $admin->getadmin();
        $this->assign('adminres', $adminres);
        return $this->fetch('list');
    }

    public function add()
    {
        if(request()->isPost()) {
            //$res = db('admin')->insert(input('post.'));
            $admin = new AdminModel();
            if ($admin->addadmin(input('post.'))) {
                $this->success('添加管理员成功!', url('lst'));
            } else {
                $this->error('添加管理员失败!');
            }
            return;
        }
        return $this->fetch('add');
    }

    public function edit($id)
    {
        $admins = db('admin')->find($id);
        if (request()->isPost()) {
            $data = input('post.');
            $admin = new AdminModel();
            $savenum = $admin->saveadmin($data, $admins);
            if ($savenum == '2') {
                $this->error('管理员名不得为空!');
            }
            if ($savenum != false) {
                $this->success('管理员修改成功!', 'lst');
            } else {
                $this->error('管理员修改失败!');
            }
            return;
        }
        if (!$admins) {
            $this->error('该管理员不存在!');
        }
        $this->assign('admin', $admins);
        return $this->fetch('edit');
    }

    public function del($id)
    {
        $admin = new AdminModel();
        $delnum = $admin->deleadmin($id);
        if ($delnum == '1') {
            $this->success('删除管理员成功', 'lst');
        } else {
            $this->error('删除管理员失败!');
        }

    }
}
