<?php
namespace Home\Controller;
use Think\Controller;
class FormController extends Controller{
	
	public function insert(){
		$Form = D('Form');//自动知道操作的数据库是think_form了
		
		//创建数据
		if($Form->create()) {   
			$result = $Form->add();  //数据增加后，返回主键的值
			if($result) {
				$this->success('数据添加成功！ ');
			}else{
				$this->error('数据添加错误！ ');
			}
		}else{
			$this->error($Form->getError());
		}
	}
	
	public function read($id=0){   //read函数，默认id是0
		$Form = M('Form');
		// 读取数据
		$data = $Form->find($id);
		$title = $Form->where('id=1')->getField('title');
		if($data) {
			$this->assign('data',$data);// 模板变量赋值
			$this->assign('title',$title);// 模板变量赋值
		}else{
			$this->error('数据错误');
		}
		$this->display();  //输出到默认的视图文件
	}
	
	public function edit($id=0){    //作用是先显示已经存了的内容
		$Form = M('Form');
		$this->assign('vo',$Form->find($id));  //绑定到html的$vo中
		$this->display();
	}
	
	public function update(){   //点击按键后的更新
		$Form = D('Form');
		if($Form->create()) {
			$result = $Form->save();  //采用save方法
			if($result) {
				$this->success('操作成功！ ');
			}else{
				$this->error('写入错误！ ');
			}
		}else{
			$this->error($Form->getError());
		}
	}
	
	public function handle(){
		$Form = M('Form');
		$map['id'] = array('ELT',3);  //查找条件
		$List = $Form->where($map)->select();  //开始查找
		
		$this->assign('list', $List);//绑定
		
		$this->display('./Application/Home/View/Form/edit.php');//输出到edit操作所对应的视图中
	}
	
	
	
}