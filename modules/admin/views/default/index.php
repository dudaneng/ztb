<?php 
use yii\helpers\Url;
use components\dy;
?>
<div class="admin">
	<div class="line-big">
    	<div class="xm3">
        	<div class="panel border-back">
            	<div class="panel-body text-center">
                	<img src="<?php echo dy::getWebUrl();?>/public/admin/images/face.jpg" width="120" class="radius-circle" /><br />
                    <?=$list['admin_acount']?>
                </div>
                <div class="panel-foot bg-back border-back">您好，<?=$list['admin_acount']?>，欢迎您的光临。</div>
            </div>
        </div>
        <div class="xm9">
        	<div class="panel">
            	<table class="table">
                	<tr><th colspan="2">服务器信息</th><th colspan="2">系统信息</th></tr>
                    <tr><td width="110" align="right">操作系统：</td><td><?=php_uname('v')?></td><td width="90" align="right">系统名称：</td><td>成都xxx系统</td></tr>
                    <tr><td align="right">Web服务器：</td><td><?=apache_get_version()?></td><td align="right">开发人员：</td><td>xxxx技术部</td></tr>
                    <tr><td align="right">PHP版本：</td><td><?=phpversion()?></td><td align="right">维护 QQ：</td><td>00000000</td></tr>
                    <tr><td align="right">数据库类型：</td><td>MySql</td><td align="right">开发单位：</td><td>成都xxxxx网络科技有限公司</td></tr>
                </table>
            </div>
        </div>
    </div>
    <p class="text-right text-gray"></p>
    
    <div class="clearfix text-center">
    	<a href="javascript:" target="_blank">成都xxxxxx网络科技有限公司</a>--技术支持<br />
    </div>
    <br />
</div>