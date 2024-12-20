<?php
require_once dirname(__FILE__).'./ExportAbstract.php';
/**
 * 导出csv文件
 * Class ExportCsv
 * use example:
 * $csv = new ExportCsv();
 * $csv->export($fileName , $data , $title = []);
 * @package shengxiaoweimo\helper\export
 */
/**
 * Class ExportCsv

 */

class ExportCsv extends ExportAbstract
{
    /**
     * @param $fileName  {string}   导出文件名  example: exportCsvFile
     * @param $data      {array}    导出数据    example: [['time' => 123 , 'test' => 123] , ['time' => 123 , 'test' => 123]]
     * @param $title     {array}   导出数据的表头  example:['时间' , '测试']
     * @return mixed
     */
    public function export($fileName , $data , $title = [])
    {
        if(!$data){
            throw new \Exception('export data is empty');
        }

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
            echo $tv.',';
        }
        echo "\n";
    }

    protected function printFileData($data)
    {
        foreach($data as $value)
        {
            foreach($value as $v){
                echo $v.',';
            }
            echo "\n";
        }
    }
}



