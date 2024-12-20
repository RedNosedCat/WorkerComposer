### 说明
```
PHP常用功能的简单封装，目前有jwt、跨域解决、xss过滤、图片合成、文件导出、文件读取等
```
### 安装
```php
composer require red-nosed-cat/worker
```


### TokenHelper (JWT 相关)
```php
<?php
//引入 TokenHelper
use RedNosedCat\Worker\TokenHelper;

//初始化 $signKey 数据加密字符串
TokenHelper::init($signKey);

//获取 token $data 待加密数据
TokenHelper::getToken($data);

//检测token的有效性
TokenHelper::checkToken($token);

//token解密
TokenHelper::getTokenData($token); 

//重置token
TokenHelper::refreshToken($token);
```
### HeaderHelper (解决跨域)
```php
<?php
//引入 HeaderHelper
use RedNosedCat\Worker\HeaderHelper;

//允许跨域header头设置 $option 允许访问的域名响应的域名，默认全部
HeaderHelper::setCoreHeader($option);
```
### XssFilterHelper (简单过滤xss攻击)
```php
<?php
//引入 XssFilterHelper
use RedNosedCat\Worker\XssFilterHelper;

//简单过滤xss攻击 $data 需要过滤的数据
XssFilterHelper::dataXssFilter($data);
```
### PhpQrCodeHelper使用
```php
<?php
//引入 PhpQrCodeHelper
use RedNosedCat\Worker\PhpQrCodeHelper;

/**
 * 生成png后缀带参数的二维码图片
 * $param    {string}        二维码参数          
 * $outFile  {string}        生成的图片存放路径    
 * $level    {int}           报错级别             
 * $size     {int}           图片大小             
 * $margin   {int}           空白边距                
 */ 
PhpQrCodeHelper::createPng($param , $outFile , $level , $size , $margin);

/*
 * 图片合并
 * $backgroundUrl    {string}    背景图             
 * $disSrcUrl        {string}    待合并图片          
 * $fileName         {string}    新文件             
*/ 
 PhpQrCodeHelper::opentow($backgroundUrl , $disSrcUrl , $fileName);   
```
### ExportHelper (文件导出相关)
```php
<?php
use RedNosedCat\Worker\ExportHelper;

$obj = new ExportHelper();
/**
 * 导出txt、xlsx、csv文件
 * $exportFileType {string}  导出文件类型:csv、txt、xlsx    
 * $exportData     {string}  导出数据       
 * $fileName       {string}  导出文件名   
 * $fileDataTitle  {string}  导出文件表头 
 */ 
$obj->exportFile($exportFileType , $exportData , $fileName , $fileDataTitle);
```

### ImportHelper (文件导入相关)
```php
<?php
use RedNosedCat\Worker\ImportHelper;

/**
 * 读取xlsx、csv文件数据
 * $fileName     {string}        读取文件的名
 * $desc         {string}        字段转换[A => 'time' , 'B' => 'test'] 
 * $readLine     {int}           从第几行开始读取
 * $sheet        {int}           读取的sheet,默认0 
 */ 
ImportHelper::getData($fileName , $desc = [] , $readLine = 2 , $sheet = 0);
```

### CommonFunc (常用函数)
```php
<?php
use RedNosedCat\Worker\CommonFunc;

//直接从数据库复制出来的字符串处理成数组
CommonFunc::mysqlCopyStringToArray($str);

/**
 * 生成随机字符串
 * @param  [int]  $len    [指定生成字符串的长度]
 * @param  [int]  $type   [生成字符串类型 0 纯数字 1 数字+大小写字母]
 * @param  [string] $addChars [额外添加的字符串]
 */
CommonFunc::randString($len=6, $type = 0, $addChars = '');
```

### PdoModel (数据库连接)
```php
<?php
use RedNosedCat\Worker\PdoModel;

$config = [
    'name' => 'mysql',
    'host' => '127.0.0.1',
    'dbname' => 'dbname',
    'port' => 3306,
    'username' => 'test',
    'password' => 'dbpassword'
];

$sql = 'select id from table_name';
$obj = new PdoModel($config);
$obj->getData($sql);

$save_sql = "delete from table_name where id = 1";
$obj->saveData($save_sql);
```