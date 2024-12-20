<?php
require_once dirname(__FILE__).'./ExportAbstract.php';
/**
 * 导出txt文件
 * Class ExportXlsx
 * use example:
 * $csv = new ExportXlsx();
 * $csv->export($fileName , $data , $title = []);
 * @package shengxiaoweimo\helper\export
 */
/**
 * Class ExportCsv

 */

class ExportXlsx extends ExportAbstract
{
    /**
     * @param $fileName  {string}   导出文件名  example: exportCsvFile
     * @param $data      {array}    导出数据    example: [['time' => 123 , 'test' => 123] , ['time' => 123 , 'test' => 123]]
     * @param $title     {array}   导出数据的表头  example:['时间' , '测试']
     * @return mixed
     */
    public function export($fileName , $data , $title = [])
    {
        $this->setHeader($fileName);
        if($title){
            $this->printFileTitle($title);
        }
        $this->printFileData($data);
    }

    protected function printFileTitle($title)
    {
        foreach($title as $tv)
        {
            echo $tv."\t";
        }
        echo "\n";
    }

    protected function printFileData($data)
    {
        foreach($data as $value)
        {
            foreach($value as $v){
                echo $v."\t";
            }
            echo "\n";
        }
    }
}
