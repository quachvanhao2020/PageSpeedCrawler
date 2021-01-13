<?php
namespace PageSpeedCrawler;

class PageCrawler{

    /**
     * @var string
     */
    protected $html;

    /**
     * @var string
     */
    protected $router;

    /**
     * @var string
     */
    protected $html2;

    public function __construct(string $html,string $router = null,string $html2 = null)
    {
        if(file_exists($html)){
            $html = file_get_contents($html);
        }
        if(file_exists($html2)){
            $html2 = file_get_contents($html2);
        }
        $this->html = $html;
        $this->router = $router;
        $this->html2 = $html2;
    }

    /**
     * Get the value of html
     *
     * @return  string
     */ 
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set the value of html
     *
     * @param  string  $html
     *
     * @return  self
     */ 
    public function setHtml(string $html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get the value of router
     *
     * @return  string
     */ 
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * Set the value of router
     *
     * @param  string  $router
     *
     * @return  self
     */ 
    public function setRouter(string $router)
    {
        $this->router = $router;

        return $this;
    }

    /**
     * Get the value of html2
     *
     * @return  string
     */ 
    public function getHtml2()
    {
        return $this->html2;
    }

    /**
     * Set the value of html2
     *
     * @param  string  $html2
     *
     * @return  self
     */ 
    public function setHtml2(string $html2)
    {
        $this->html2 = $html2;

        return $this;
    }
}