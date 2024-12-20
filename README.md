### 说明
```angular2
PHP常用功能的简单封装，目前有jwt、跨域解决、xss过滤、图片合成、文件导出、文件读取等
```
### 安装
```angular2
composer require shengxiaoweimo/helper
```

### 使用
- #### jwt验证 - TokenHelper使用
    - 引入命名空间
    ```
    use shengxiaoweimo\helper\TokenHelper;
    ```

    - 初始化
        - 参数说明
        - $signKey  {string}    数据加密字符串
    ```
    TokenHelper::init($signKey);
    ```
  
    - 获取token
        - 参数说明
        - $data  {array}    待加密数据
    ```
    TokenHelper::getToken($data);
    ```
  
    - 检测token的有效性
        - 参数说明：
        - $token  {string} 需要检测的token
    ```
    TokenHelper::checkToken($token);
    ```
  
    - token解密   
        - 参数说明：
        - $token {string} 待解密的token
    ```
    TokenHelper::getTokenData($token);
    ```
  
    - 重置token
        - 参数说明：
        - $token  {string} 需要重置的token
    ```
    TokenHelper::refreshToken($token);
    ```

- #### HeaderHelper使用
    - 解决跨域header头设置
         - 参数说明：
         - $option  {array}  允许访问的域名响应的域名,默认全部
    ```
    HeaderHelper::setCoreHeader($option);
    ```

- #### XssFilterHelper使用
    - 简单过滤xss攻击
        - 参数说明：
        - $data  {array}  需要过滤的数据
    ```
    XssFilterHelper::dataXssFilter($data);
    ```
 
- #### PhpQrCodeHelper使用
    - 生成png后缀带参数的二维码图片
        - 参数说明：
        - $param    {string}        二维码参数           null
        - $outFile  {string}        生成的图片存放路径    not null
        - $level    {int}           报错级别             null
        - $size     {int}           图片大小             null
        - $margin   {int}           空白边距             null   
    ```
    PhpQrCodeHelper::createPng($param , $outFile , $level , $size , $margin);
    ```    
    - 图片合并
        - 参数说明:   
        - $backgroundUrl    {string}    背景图             not null
        - $disSrcUrl        {string}    待合并图片          not null
        - $fileName         {string}    新文件             not null
    ```
        PhpQrCodeHelper::opentow($backgroundUrl , $disSrcUrl , $fileName);
    ``` 

- #### ExportHelper使用
    - 导出txt、xlsx、csv文件
        - 参数说明：
        - $exportFileType    {string}        导出文件类型:csv、txt、xlsx         not null
        - $exportData        {string}        导出数据                           not null
        - $fileName          {int}           导出文件名称                       not null
        - $fileDataTitle     {int}           导出文件表头                       null
    ```
    use shengxiaoweimo\helper\ExportHelper;
    $obj = new ExportHelper();
    $obj->exportFile($exportFileType , $exportData , $fileName , $fileDataTitle);
    ```    
  
- #### ImportHelper使用
    - 读取xlsx、csv文件数据
        - 参数说明：
        - $fileName     {string}        读取文件的名称                              not null
        - $desc         {string}        字段转换[A => 'time' , 'B' => 'test']       not null
        - $readLine     {int}           从第几行开始读取                             null
        - $sheet        {int}           读取的sheet,默认0                            null
    ```
    use shengxiaoweimo\helper\ImportHelper;
    ImportHelper::getData($fileName , $desc = [] , $readLine = 2 , $sheet = 0);
    ```    