<?php
/**
 * 导出文件
 * Class Export
 * @package shengxiaoweimo\helper\export
 */
abstract class Export
{
    protected $fix;

    /**
     * @param $fileName     导出文件名
     * @param $data         导出数据
     * @return mixed
     */
    abstract public function export($fileName , $data);

    protected function setHeader($fileName)
    {
        header("Content-type:text/".$this->fix);
        header('Content-Disposition: attachment;filename=' . $fileName .$this->fix);
    }
    
    protected function setFileType($type)
    {
        $this->fix = $type;
    }
}