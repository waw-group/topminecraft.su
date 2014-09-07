<?php
/*
* Pagination class
*/
class pagination
{
    private $page;
    private $current_pos;
    private $next_pos;
    public function getContent($page,$onPage,$getClass,$getFunction)
    {
        $this->page = $page;
        $this->current_pos = ($page*$onPage)-$onPage;
        $this->next_pos = $page*$onPage;
        $class = new $getClass();
        $content = $class->$getFunction($this->current_pos,$onPage);
        return $content;
    }
    function getPages($countPage, $actPage)
    {
        if ($countPage == 0 || $countPage == 1) return array();
        if ($countPage > 10)
        {
            if($actPage <= 4 || $actPage + 3 >= $countPage)
            {
                for($i = 0; $i <= 4; $i++)
                {
                    $pageArray[$i] = $i + 1;
                }
                $pageArray[5] = "...";
                for($j = 6, $k = 4; $j <= 10; $j++, $k--)
                {
                    $pageArray[$j] = $countPage - $k;
                }
            }
            else
            {
                $pageArray[0] = 1;
                $pageArray[1] = 2;
                $pageArray[2] = "...";
                $pageArray[3] = $actPage - 2;
                $pageArray[4] = $actPage - 1;
                $pageArray[5] = $actPage;
                $pageArray[6] = $actPage + 1;
                $pageArray[7] = $actPage + 2;
                $pageArray[8] = "...";
                $pageArray[9] = $countPage - 1;;
                $pageArray[10] = $countPage;
            }
        }
        else
        {
            for($n = 0; $n < $countPage; $n++)
            {
                $pageArray[$n] = $n + 1;
            }
        }
        return $pageArray;
    }
}