<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库操作类</title>
</head>
<?php
  require_once("config.inc.php");
  class DB
   {
	private $_link;
	public function _construct()
	{
		$this->_link=
		mysql_connect(HOST,USER,PASSWORD,DBNAME);  //连接数据库
		$this->_link= 
		$this or $this->errmsg('unconnect to MySql server');
		  $this->query('set name'.DB_CHARSET);   //数据库编码
		}  
		   
		public function query($sql)  //执行数据库
	{
		$result=mysql_query($this->_link,$sql);
		
		$result or $this->errmsg('Execute sql sentence error');
		 return $result;
		}    
		 
		 	public function fetch_array($result,$type=MYSQL_BOTH)  //返回行生成的数组
	{ 
	   return mysql_fetch_array($result,$type);
		
		
		}    
		public function fetch_object($result)  //返回行生成的对象
	{ 
	   return mysql_fetch_object($result);
		} 
		
		   public function affected_rows()  //上一次操作影响的行数
		   {
			 return  mysql_affected_rows($this->_link);
		 }    
		public function free_result($result)  //释放结果内存
	{ 
	   return mysql_free_result($result);
		} 
	     public function num_rows($result)  //取得结果集行数
	{ 
	   return mysql_num_rows($result);
		} 
	   public function num_fields($result)  //结果集中字段的行数
	{ 
	   return mysql_num_fields($result);
		} 
	   public function insert_id()  //上一步插入产生的ID
	{ 
	   return mysql_insert_id($this->_link);
		} 
		private function erromg($msg){                           //mysql执行错误
			$message='<strong>数据库错误</strong><br />';
			$message.='<strong>错误号为：</strong>'.mysql_errno($this->_link).'<br />';
			$message='<strong>错误信息：</strong>'.msg.mysql_error($this->_link).'<br />';
			$message.='<strong>错误时间：</strong>'.date('Y-m-d H:i:s');
			exit($message);
			}
		
		  public function link_id()  //返回数据库连接标识
	{ 
	   return $this->_link;
	  
		} 
		  public function version()  //MySQL服务器版本
	{ 
	   return mysql_get_server_info($this->_link);
		} 
		  public function close()   //关闭数据库连接
	{ 
	   mysql_close($this->_link); 
		} 
		
		
	   }




?>
<body>
</body>
</html>