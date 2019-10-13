<?php

namespace App\Http\Controllers;

use App\Http\Repository\ContentRepository;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    private static $attributes = [
        'article' => [
            'title' => '标题',
            'keywords' => '关键字',
            'intro' => '简介',
            'cover_img' => '封面图',
            'content' => '内容'
        ]
    ];

    private function checkUserAuth(int $record_id)
    {
        $create_id = $this->admin['id'];
        if ($create_id == 1) {
            return true;
        }
        $where = [['id', '=', $record_id], ['create_id', '=', $create_id]];
        $has = app(ContentRepository::class)->checkExists($where);
        if ($has) {
            return true;
        }
        return false;
    }

    public function showArticleList(ContentRepository $contentRepository)
    {
        $data['title'] = "";
        $data['push_id'] = 0;
        $title = trim($this->request->get('title')) ?: "";
        $page = (int)$this->request->get('page') ?: 1;
        $push_id = (int)$this->request->get('push_id') ?: 0;
        $filed = ['article.*', 'article_class.class_name', 'push.push_name'];
        $where = [['article.is_del', '=', 0]];
        if (!empty($title)) {
            $data['title'] = $title;
            array_push($where, ['article.title', 'like', '%' . $title . '%']);
        }
        if ($push_id) {
            $data['push_id'] = $push_id;
            array_push($where, ['article.push_id', '=', $push_id]);
        }
        $orderBy = ['article.created_at' => 'desc'];
        $size = (int)$this->request->get('size') ?: 10;
        $builder = $contentRepository->getContentList($where, $filed, $orderBy, $size, $page);
        if (count($builder->items())) {
            foreach ($builder->items() as $key => $item) {
                $item->is_show_text = '隐藏';
                if ($item->is_show) {
                    $item->is_show_text = '显示';
                }
                $item->is_recommend_text = '未推荐';
                if ($item->is_recommend) {
                    $item->is_recommend_text = '已推荐';
                }
                if (!$item->class_name) {
                    $item->class_name = '未分类';
                }
                if (!$item->push_name) {
                    $item->push_name = '默认机构';
                }
                if ($item->push_time) {
                    $item->push_time = date("Y-m-d H:i:s", $item->push_time);
                } else {
                    $item->push_time = '';
                }
            }
        }
        $data['push_list'] = $contentRepository->getPushList(['is_del' => 0], ['id', 'push_name']);
        $data['builder'] = $builder;
        return view('content/list', $data);
    }

    public function showAddContent(ContentRepository $contentRepository)
    {
        $data['class'] = [];
        $data['push'] = [];
        $class_field = ['id', 'pid', 'class_name', 'sort'];
        $class_where = ['is_del' => 0];
        $class_info = $contentRepository->getContentClassList($class_where, $class_field);
        if ($class_info) {
            $data['class'] = $this->helper->loopChild($class_info);
        }
        $push_field = ['id', 'push_name'];
        $push_where = ['is_del' => 0];
        $data['push'] = $contentRepository->getPushList($push_where, $push_field);
        return view("content/add", $data);
    }

    public function showUpDataContent(ContentRepository $contentRepository)
    {
        $id = $this->request->get("id");
        if(!$this->checkUserAuth($id)){
            return response("page not fund", 404);
        }
        $data['class'] = [];
        $data['push'] = [];
        $data['info'] = [];
        $where = ['id' => $id];
        $info = $contentRepository->getContent($where);
        if(!$info){
            return response("page not fund", 404);
        }
        $data['info'] = $info;
        $class_field = ['id', 'pid', 'class_name', 'sort'];
        $class_where = ['is_del' => 0];
        $class_info = $contentRepository->getContentClassList($class_where, $class_field);
        if ($class_info) {
            $data['class'] = $this->helper->loopChild($class_info);
        }
        $push_field = ['id', 'push_name'];
        $push_where = ['is_del' => 0];
        $data['push'] = $contentRepository->getPushList($push_where, $push_field);
        return view("content/edit", $data);
    }

    public function saveContent(ContentRepository $contentRepository){
        $validator = Validator::make($this->request->post(), [
            'title' => 'required',
            'keywords' => 'required',
            'cover_img' => 'required',
            'intro' => 'required',
            'content' => 'required'
        ], [], self::$attributes['article']);
        if($validator->fails()){
            return $this->helper->returnJson([1, [], $validator->errors()->first()]);
        }
        $post = $this->request->post();
        unset($post["_token"]);
        $post['content'] = htmlspecialchars($post['content']);
        $post['push_time'] = strtotime($post['push_time']);
        $post['create_id'] = $this->admin['id'];
        $post['created_at'] = $post['updated_at'] = date('Y-m-d H:i:s');
        $insert = $contentRepository->insertContent($post);
        if(!$insert){
            return $this->helper->returnJson([1, [], "操作失败，请重试！"]);
        }
        return $this->helper->returnJson([0, $post, "添加成功"]);
    }

    public function upDateContent(ContentRepository $contentRepository)
    {
        $id = $this->request->post("id");
        if(!$this->checkUserAuth($id)){
            return response("page not fund", 404);
        }
        $validator = Validator::make($this->request->post(), [
            'title' => 'required',
            'keywords' => 'required',
            'cover_img' => 'required',
            'intro' => 'required',
            'content' => 'required'
        ], [], self::$attributes['article']);
        if($validator->fails()){
            return $this->helper->returnJson([1, [], $validator->errors()->first()]);
        }
        $post = $this->request->post();
        unset($post["_token"], $post['id']);

        $post['content'] = htmlspecialchars($post['content']);
        $post['push_time'] = strtotime($post['push_time']);
        $post['update_id'] = $this->admin['id'];
        $post['updated_at'] = $post['updated_at'] = date('Y-m-d H:i:s');
        $insert = $contentRepository->upDateContent(['id' => $id], $post);
        if(!$insert){
            return $this->helper->returnJson([1, [], "操作失败，请重试！"]);
        }
        return $this->helper->returnJson([0, $post, "更新成功"]);
    }

    public function showPreview(ContentRepository $contentRepository)
    {
        $data['info'] = [];
        $field = ['id', 'title', 'content', 'read', 'push_time'];
        $where = ['id' => $this->request->get("id")];
        $info = $contentRepository->getContent($where, $field);
        if(!$info){
            return response("page not fund", 404);
        }
        $data['info'] = $info;
        return view("content/preview", $data);
    }

    public function delContent(ContentRepository $contentRepository)
    {
        $id = $this->request->get("id");
        if(!$this->checkUserAuth($id)){
            return response("page not fund", 404);
        }
        $where = ['id' => $id];
        $change = $contentRepository->upDateContent($where, ['is_del' => 1]);
        if($change){
            return $this->helper->returnJson([0, [], "删除成功"]);
        }
        return $this->helper->returnJson([0, [], "操作失败， 请重试！"]);
    }

    public function showClassify(ContentRepository $contentRepository)
    {
        $data['title'] = "";
        $data['list'] = $contentRepository->getContentClassifyList([]);
        return view('content/classify/list', $data);
    }
}
