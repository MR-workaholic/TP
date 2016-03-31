<?php
namespace Admin\Controller;
use Think\Controller;

class AgentStatisticController extends Controller {
    //��ʾ����ͳ�Ƹſ�����ͼ
    public function showStatisticSummary(){
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->display('./GLLogin/Signin/zui-master-me/Agent/StatisticsSummary.html');
    }
    //��ʾ�̼�ͳ�Ƶ���ͼ
    public function showMerchantStatistic(){
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->display('./GLLogin/Signin/zui-master-me/Agent/MerchantStatistics.html');
    }
    
    public function getMerchantTypeList(){
        
        $call = A('Publiccode');
       // $agentId=I('session.uid');
        $agentId=2;
        
        $merchantTypeList=array('�̼�����A','�̼�����B','�̼�����C','�̼�����D');
        $response['data'] = $merchantTypeList;
        $response['status'] = 1;
        $response['info'] = '';
        $response['type'] = 'JSON';
        $this->ajaxReturn($response,'JSON');
    }
    
    //��ȡ�̼��б�
    public function getMerchantList(){
        // $agentId=I('session.uid');
        $pageSize=I('post.PageSize');
        $pageNum=I('post.PageNum');
        $agentId = 12;
        $call = A('Publiccode');
        
        $MerchantNumjson = array(
            "op" => "query",
            "where" => "where Role = '��ͨ�̼�' and AgentId='{$agentId}'",
            "rows" =>$pageSize,
            "page"=> $pageNum,
            
        );
        $MerchantNumjson = json_encode($MerchantNumjson);
        $result = $call->AccountHandle($MerchantNumjson);
        
        $response['data']['merchantList'] = $result['rows'];
        $response['data']['totalPage'] = ceil($result['total']/$pageSize);
        $response['status'] = 1;
        $response['info'] = '';
        $response['type'] = 'JSON';
        $this->ajaxReturn($response,'JSON');
    }
    
    //����ĳ���̼�
    public function searchMerchant(){
      	    $call = A('Publiccode');
	    $agentKeyword = I('post.agentKeyword');
	    $json = array(
	        "op" => "query",
	        "where" => "where Num = '{$agentKeyword}' OR Name='{$agentKeyword}'",
	    );
	    $json = json_encode($json);
	    $result = $call->AccountHandle($json);
        
        $response['data']['merchantList'] = $result['rows'];
        $response['status'] = 1;
        $response['info'] = '';
        $response['type'] = 'JSON';
        $this->ajaxReturn($response,'JSON');
    }
    
}