<?php
namespace app\index\controller;
use think\Controller;
class Login extends Controller
{

 public function dl(){
 		$data=input('post.');
 		// echo "<pre>";
   //  	print_r($data);exit;
    	$username=input('post.username');
    	$mima=input('post.password');
    	// $username='111';
    	$info=db('tab1')->where('name="'.$username.'"')->find();
    	// echo "<pre>";
    	// print_r($info);exit;
    	if(!empty($info))
    	{
    		if($info['password']==$mima)
    		{
    		session('userid',$info['id']);
    		session('username',$username);
    		if(!empty($data['xuanze']))
                {
                    cookie('username',$username,3600);
             
                }
    			$datas=[
                    'msg'=>'登录成功',
                    'status'=>1
                ];
              return $datas;
            }else{
            	$datas=[
                    'msg'=>'密码错误',
                    'status'=>0
                ];
                return $datas;
            }
    	}else{
    		$datas=[
                    'msg'=>'用户名不对',
                    'status'=>0
                ];
                 return $datas;
    	}
    	


    }
    public function reg()
    {
    	
            $data = input('post.');
            $name=input('post.name');
    		$mima=input('post.password');
    		$mimas=input('post.passwords');
    		$info=db('tab1')->where('name="'.$name.'"')->find();
    		if($name==''){
    			$datas=[
	                    'msg'=>'用户名不能为空',
	                    'status'=>0
	                ];
	            return $datas;
    		}else{
              if($mima=='' and $mimas==''){
              	$datas=[
	                    'msg'=>'密码不能用空',
	                    'status'=>0
	                ];
	                   return $datas;
              }else{


    		}
    		if($info){
    			$datas=[
	                    'msg'=>'用户已存在',
	                    'status'=>0
	                ];
	            return $datas;
    		}else{
    			if($mima!=$mimas){

    				$datas=[
	                    'msg'=>'两次密码不一致',
	                    'status'=>0
	                ];
	                  return $datas;
    			}else{
    				 if(captcha_check($data['code'])) {
                // 校验失败
    				 	unset($data['passwords']);
    				 	unset($data['code']);
    				 	$sql=db('tab1')->insert($data);
    				 	if($sql){
    				 		$datas=[
			                    'msg'=>'注册成功',
			                    'status'=>1
			                ];
			            return $datas;
			        }
			            
		            }else{
		            	$datas=[
		                    'msg'=>'验证码不对',
		                    'status'=>0
		                ];
		                return $datas;
		            }
    			}
    		}
 		}
           

    }

}
?>