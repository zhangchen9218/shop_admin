<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Events\AdminBackgroundLog;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CategoryController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input("keyword","");
        if($keyword){
            $categories = Category::where("id",$keyword)->orWhere("name","like","%".$keyword."%")->get();
        }else{
            $categories = Category::all();
        }
        return view("admin.article_category_list",["keyword"=>$keyword,"categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.article_category_add");
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request,Category $category)
    {
        $category['name'] = $request->input("name");
        $category['state'] = ARTICLE_CATEGORY_START;
        $category->save();
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["添加成功"],
        ];
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "添加资讯分类")));
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view("admin.article_category_update",['category'=> $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category['name'] = $request->input("name");
        $category->save();
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["修改成功"],
        ];
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改资讯分类")));
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);

        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["删除资讯成功"],
        ];

        $ids = $request->input("id");

        $bool = Category::destroy($ids);

        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["删除资讯失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "删除资讯分类")));
        return response()->json($data);
    }

    public function editState(Request $request){
        $request->validate([
            "id" => "required|integer",
            "state" => "required|integer",
        ]);
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["修改状态成功"],
        ];

        $id = $request->input("id");
        $state = $request->input("state");
        if(!is_array($id)){
            $id = [$id];
        }
        Category::whereIn("id",$id)->update(['state' => $state]);
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改资讯分类状态")));
        return response()->json($data);
    }
}
