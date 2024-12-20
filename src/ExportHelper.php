<?php
namespace shengxiaoweimo\helper;

class ExportHelper
{
    /*
     * 支持导出的文件后缀
     */
    public $fileType = ['csv' , 'xlsx' , 'txt'];


    /**
     * @param $data         导出的数据
     * @param $fileName     导出文件名称
     * @param $fileName     导出文件表头
     */
    public function exportFile($fileType = 'csv', $data , $fileName , $title = [])
    {
        if(!$this->checkFileType($fileType)){
            throw new \Exception('export file type error');
        }

        if(!$data){
            throw new \Exception('export data is empty');
        }

        $object = $this->getExportObject($fileType);
        $object->setFileType($fileType);
        $object->export($fileName , $data , $title);
    }

    protected function checkFileType($type)
    {
        if(!in_array($type , $this->fileType)){
            return false;
        }

        return true;
    }

    protected function getExportObject($type)
    {
        switch ($type){
            case 'csv':
                require_once dirname(__FILE__).'./export/ExportCsv.php';
                $object = new \ExportCsv();
                break;
            case 'xlsx':
                require_once dirname(__FILE__).'./export/ExportXlsx.php';
                $object = new \ExportXlsx();
                break;
            case 'txt':
                require_once dirname(__FILE__).'./export/ExportTxt.php';
                $object = new \ExportTxt();
                break;
        }

        return $object;
    }
}