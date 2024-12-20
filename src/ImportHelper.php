<?php
namespace shengxiaoweimo\helper;

class ImportHelper
{
    /**
     * @param $file     要读取的xlsx文件名称
     * @param array $desc       xlsx行表示转换字段
     * @param int $readLine     从第几行开始读取
     * @param int $sheet        读取第几个sheet
     * @return array
     */
    public static function getData($fileName , $desc = [] , $readLine = 2 , $sheet = 0)
    {
        $PHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileName , $encode = 'utf-8');
        $data = [];
        $currentSheet = $PHPExcel->getSheet($sheet);
        $allColumn = $currentSheet->getHighestColumn();
        $allRow = $currentSheet->getHighestRow();
        for ($currentRow = $readLine ; $currentRow <= $allRow; $currentRow++) {
            //从哪列开始，A表示第一列
            for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                //数据坐标
                $address = $currentColumn . $currentRow;
                //读取到的数据，保存到数组$arr中
                if(isset($desc[$currentColumn])){
                    $data[$currentRow][$desc[$currentColumn]] = $currentSheet->getCell($address)->getValue();

                } else {
                    $data[$currentRow][$currentColumn] = $currentSheet->getCell($address)->getValue();
                }
            }
        }

        return $data;
    }
}