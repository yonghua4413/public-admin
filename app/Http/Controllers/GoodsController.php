<?php

namespace App\Http\Controllers;

use App\Http\Repository\Repository;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{
    private static $attributes = [
        'goods_class' => [
            'class_name' => '分类名称'
        ]
    ];

    public function showGoodsClassify()
    {
        $data['list'] = [];
        $list = $this->getAllGoodsClassify();
        if($list){
            $data['list'] = $this->helper->disposeLoopData($list);
        }
        return view('goods/classify/list', $data);
    }

    public function showAddGoodsClassify()
    {
        $data['class_list'] = [];
        $list = $this->getAllGoodsClassify();
        if($list){
            $data['class_list'] = $this->helper->disposeLoopData($list);
        }
        return view("goods/classify/add", $data);
    }

    public function showEditGoodsClassify(Repository $repository)
    {
        $data['class_list'] = [];
        $id  = (int)$this->request->get('id');
        $info = $repository->getOne('goods_class', ['id' => $id]);
        if(!$info){
            return response("", 404);
        }
        $data['info'] = $info;
        $list = $this->getAllGoodsClassify();
        if($list){
            $data['class_list'] = $this->helper->disposeLoopData($list);
        }
        return view("goods/classify/edit", $data);
    }

    /**
     * @return mixed
     */
    public function getAllGoodsClassify()
    {
        $repository = app(Repository::class);
        $repository->orderBy = ['sort' => 'desc'];
        return $repository->getList("goods_class", ['is_del' => 0]);
    }

    /**
     * @param Repository $repository
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveGoodsClassify(Repository $repository)
    {
        $table = 'goods_class';
        $post = $this->request->post();
        $validator = Validator::make($this->request->post(), [
            'class_name' => 'required'
        ], [], self::$attributes['goods_class']);
        if ($validator->fails()) {
            return $this->helper->returnJson([1, [], $validator->errors()->first()]);
        }
        $where = [['class_name', "=", $post['class_name']], ['is_del', '=', 0]];
        if ($repository->checkExists($table, $where)) {
            return $this->helper->returnJson([1, [], "该分类已经存在！"]);
        }
        unset($post['_token']);
        $post['create_id'] = $this->admin['id'];
        $post['created_at'] = date("Y-m-d H:i:s");
        $insert = $repository->insert($table, $post);
        if ($insert) {
            return $this->helper->returnJson([0, [], "操作成功"]);
        }
        return $this->helper->returnJson([1, [], "操作失败， 请重试！"]);
    }

    /**
     * @param Repository $repository
     * @return \Illuminate\Http\JsonResponse
     */
    public function modifyGoodsClassify(Repository $repository)
    {
        $table = 'goods_class';
        $id = $this->request->all("id");
        $post = $this->request->post();
        unset($post['id'], $post['_token']);
        if(!$this->helper->checkUserAuth($table, $id)){
            return $this->helper->returnJson([1, [], "您没有权限"]);
        }
        if(isset($post['is_del']) && $repository->checkExists($table, ['pid' => $id])){
            return $this->helper->returnJson([1, [], "该分类下还有子分类，不能删除！"]);
        }
        $where = ['id' => $id];
        $update = [
            'updated_at' => date('Y-m-d H:i:s'),
            'update_id' => $this->admin['id']
        ];
        $data = array_merge($post, $update);
        $change = $repository->update($table, $where, $data);
        if($change){
            return $this->helper->returnJson([0, [], "操作成功"]);
        }
        return $this->helper->returnJson([1, [], "操作失败， 请重试！"]);
    }
}
