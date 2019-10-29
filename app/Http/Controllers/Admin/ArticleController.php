<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Article;
use App\Column;
use App\Events\AdminBackgroundLog;
use App\Http\Requests\ArticleRequest;
use App\Packages\ColumnPackage\Facade\Column as FColumn;
use App\Packages\MyAssistPackage\Facade\Assist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param object $request    表单
     * @param object $article    查询对象
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Article $article)
    {
        $search['category'] = $request->input("category","");
        $search['state'] = $request->input("state","");
        $search['startAt'] = $request->input("start_at","");
        $search['endAt'] = $request->input("end_at","");
        $search['title'] = $request->input("title","");
        if(Assist::checkRoutePower("article.me","",true)){
            $search['me'] = true;
        }
        $articles = $article->getArticleByTerm($search);
        $categorys = Category::where("state",1)->get();
        return view("admin/article_list", ['articles'=>$articles,'categorys'=>$categorys,'search'=>$search]);
    }

    /**
     * @param Column $column
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Column $column)
    {
        $categorys = Category::where("state",1)->get();
        $columns   = $column->getColumnTree(0,COLUMN_STATE_START);
        $colList   = FColumn::columnSelectList($columns);
        return view("admin/article_add",['categorys'=>$categorys, "colList" => $colList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request,Article $article)
    {
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["创建资讯成功"],
        ];
        $article["title"]          = $request->input("title");
        $article["intro"]          = $request->input("intro");
        $article["author"]         = $request->input("author");
        $article["comment_state"] = $request->input("comment_state",0);
        $article["icon"]            = $request->input("icon","");
        $article["template_id"]    = $request->input("template_id",0);
        $article["column_id"]      = $request->input("column_id");
        $article["category_id"]    = $request->input("category_id");
        $article["source"]          = $request->input("source");
        $article["content"]         = $request->input("editor");
        $article["sort"]            = $request->input("sort",0);
        $article["key_words"]       = $request->input("key_words");
        $article["state"]           = $request->input("state",1);
        $article["operator_id"]    = $request->session()->get("admin_id");

        $row = $article->save();
        if(!$row){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["创建资讯失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "添加资讯")));
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $template = ARTICLE_DEFAULT_SHOW_VIEW;
        //获取模板
        if(collect($article->template)->isNotEmpty() &&  $article->template->state == TEMPLATE_START){
            $template = $article->template->templ_uri;
        }
        return view($template ,["articleInfo" => $article]);
    }

    /**
     * @param Article $article
     * @param Column $column
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Article $article,Column $column)
    {
        $categorys = Category::where("state",1)->get();
        $columns   = $column->getColumnTree(0,COLUMN_STATE_START);
        $article->content = new HtmlString($article->content);
        $colList   = FColumn::columnSelectList($columns, $article->column_id);
        return view("admin/article_update",['article'=>$article ,'categorys'=>$categorys, "colList" => $colList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["修改资讯成功"],
        ];
        $article["title"]          = $request->input("title");
        $article["intro"]          = $request->input("intro");
        $article["author"]         = $request->input("author");
        $article["comment_state"] = $request->input("comment_state",0);
        $article["icon"]            = $request->input("icon","");
        $article["template_id"]    = $request->input("template_id",0);
        $article["column_id"]      = $request->input("column_id");
        $article["category_id"]    = $request->input("category_id");
        $article["source"]          = $request->input("source");
        $article["content"]         = $request->input("editor");
        $article["sort"]            = $request->input("sort",0);
        $article["key_words"]       = $request->input("key_words");
        $article["state"]           = $request->input("state",1);
        $article["operator_id"]    = $request->session()->get("admin_id");

        $row = $article->save();
        if(!$row){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["修改资讯失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改资讯")));
        return response()->json($data);
    }

    /**
     * @param Request $request
     * @param Article $article
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

        $id = $request->input("id");
        $bool = Article::destroy($id);
        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["删除资讯失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "删除资讯")));
        return response()->json($data);
    }

    /**
     * 上传
     * @param Request $request
     * @return false|string
     */
    public function upload(Request $request)
    {
        $request->validate([
            "file" => "image"
        ],[
            "file.image" => "上传类型必须是（jpeg, png, bmp, gif）"
        ]);
        $path = Storage::putFile('public/article_icon', $request->file('file'), "public");
        $path = Storage::url($path);
        return response()->json(["data"=>$path]);
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

        $article = Article::find($id);
        $article['state'] = $request->input("state");
        $article['verifier_id'] = $request->session()->get("admin_id");

        $bool = $article->save();
        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["修改状态失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改资讯状态")));
        return response()->json($data);
    }
}
