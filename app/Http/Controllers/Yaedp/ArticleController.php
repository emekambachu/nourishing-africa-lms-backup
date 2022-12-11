<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Services\Yaedp\YaedpArticlesService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(YaedpArticlesService $yaedpArticle){

        $this->yaedpArticle = $yaedpArticle;
    }



    public function index()
    {
    $data['articles'] = $this->yaedpArticle->getAll()->latest()->take(9)->get(); 

    return view('yaedp.articles.index', $data);
    }
}
