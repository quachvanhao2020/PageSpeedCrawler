<?php
namespace PageSpeedCrawler;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Node\HtmlNode;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;
use PHPHtmlParser\Dom\Node\AbstractNode;

class PageSpeedCrawler{

    /**
     * @var HttpClientInterface
     */
    protected $client;

    public function __construct(HttpClientInterface $client = null)
    {
        if(!$client) $client = HttpClient::create();
        $this->client = $client;
    }

    public function getData(PageCrawler $pageCrawler){
        $html2 = $pageCrawler->getHtml2();
        if(!$html2){
            $html2 = $this->client->request("GET",$pageCrawler->getRouter())->getContent(false);
        }
        $dom = new Dom;
        $dom->loadStr($html2);
        $html = $pageCrawler->getHtml();
        $dom1 = new Dom;
        $dom1->loadStr($html);
        return $this->domDom($dom1,$dom);
    }

    protected function domDom(Dom $dom,Dom $dom1){
        $array = [];
        self::note_walk_recursive($dom->root,function($key,$value,$i) use (&$array){
            if($value instanceof AbstractNode){
                $index = $value->getAttribute("_index");
                $attr = $value->getAttribute("_attr");
                if(!$attr) $attr = "innerHtml";
                if($index){
                    $flag = $value->hasAttribute("id") ? "#".$value->getAttribute("id") : null;
                    if(!$flag) $flag = $value->hasAttribute("class") ? ".".$value->getAttribute("class") : null;
                    var_dump($flag,$i);
                    if(!isset($array[$index])){
                        $array[$index] = "";
                    }
                    //$array[$index] .= $value->innerhtml;
                }
            };
        });
        return $array;
    }

    public static function note_walk_recursive(AbstractNode $note,callable $callable,int &$index = 0){
        foreach ($note as $key => $value) {
            $callable($key,$value,$index);
            if($value instanceof AbstractNode){
                self::note_walk_recursive($value,$callable,$index);
            }
            $index ++;
        }
    }

}