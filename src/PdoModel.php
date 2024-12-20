<?php
namespace RedNosedCat\Worker;
/**
 * Example:
 * $config = [
    'name' => 'mysql',
    'host' => '127.0.0.1',
    'dbname' => 'dbname',
    'port' => 3306,
    'username' => 'test',
    'password' => 'dbpassword'
];

$obj = new PdoModel($config);
$obj->getData($sql);
 */
class PdoModel
{
    private $pdo = null;

    private $host;

    private $dbname;

    private $port;

    private $username;

    private $password;


    public function __construct($params)
    {
        foreach($params as $k=>$v){
            if(isset($this->$k)){
                $this->$k = $v;
            }
        }
        
        try{
            $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';port='.$this->port , $this->username , $this->password);
            // $this->pdo->setAttribute(PDO::ATTR_TIMEOUT, 60);

        } catch (Exception $exception){
            print "Error!: " . $exception->getMessage() . "<br/>";
            die();
        }
        
    }

    /**
     * @param $sql   查询sql
     * @return array 数据库查询结果
     */
    public function getData($sql)
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param $sql  更新、修改、新增sql
     * @return array  返回影响行数和错误码
     * row_count 影响行数
     * error_code 错误码
     */
    public function saveData($sql)
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        return ['row_count' => $sth->rowCount() , 'error_code' => $sth->errorCode()];
    }
}