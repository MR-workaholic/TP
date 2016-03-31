<?php
namespace Admin\Controller;
use Think\Controller;

class AgentStatisticController extends Controller {
    //显示运行统计概况的视图
    public function showStatisticSummary(){
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->display('./GLLogin/Signin/zui-master-me/Agent/StatisticsSummary.html');
    }
    //显示商家统计的视图
    public function showMerchantStatistic(){
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->display('./GLLogin/Signin/zui-master-me/Agent/MerchantStatistics.html');
    }
    
    public function getMerchantTypeList(){
        
        $call = A('Publiccode');
       // $agentId=I('session.uid');
        $agentId=2;
        
        $merchantTypeList=array('商家类型A','商家类型B','商家类型C','商家类型D');
        $response['data'] = $merchantTypeList;
        $response['status'] = 1;
        $response['info'] = '';
        $response['type'] = 'JSON';
        $this->ajaxReturn($response,'JSON');
    }
    
    //获取商家列表
    public function getMerchantList(){
        // $agentId=I('session.uid');
        $pageSize=I('post.PageSize');
        $pageNum=I('post.PageNum');
        $agentId = 12;
        $call = A('Publiccode');
        
        $MerchantNumjson = array(
            "op" => "query",
            "where" => "where Role = '普通商家' and AgentId='{$agentId}'",
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
    
    //搜索某个商家
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