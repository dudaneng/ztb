/*
 * jQuery validate plugin
 * @requires jQuery v1.1 or later
 * @author yangxin
 *
 * Revision: $Id$
 * Version: 0.1
 */
 (function($){
    //验证因子(0:验证字段,1:验证规则,2:验证提示,4:验证条件,5:匹配验证)
    //验证规则(number:验证数量,function:函数验证,confirm:比较验证,in:范围验证,regex:正则验证)
    //验证条件(0:存在则验证,1:必须验证,2:值不为空验证)
    //匹配验证(0:匹配验证,1:非匹配验证)
    // var validate=[
    //     ['name', /^\s*$/, '名称不能为空', 1, 'regex',0],
    //     ['name', /^\d+$/, '名称不能为数字', 1, 'regex',0],
    //     ['name', /^[a-z]{3}$/, '名称错误', 1, 'regex',1],
    // ];
    /**
     * 自动验证
     * @param array validate 验证因子
     * @type bool 是否批量验证（默认批量验证）
     * @return mixed
    */
    $.fn.validate=function(validate,type){
        //获取表单数据
        var data=$(this).serializeArray();
        if($.isEmptyObject(data)){
            return true;
        }
        //序列化数据
        data=_serializeJSON(data);
        //错误信息
        var error={};
        for(i in validate){

            var condition=validate[i][3];//验证条件
            var name=validate[i][0];//字段名称
            var value=data[name];//字段值

            //字段已验证则继续
            if(typeof(error[name])!='undefined'){
                continue;
            }

            //存在字段就验证、必须验证、值不为空的时候验证
            if((condition==0&&typeof(value)!='undefined')||(condition==1)||(condition==2&&typeof(value)!='undefined'&&value!='')){
                if(type==false){
                    for(key in data){
                        var name=key;
                        break;
                    }
                    if(validate[i][0]!=name){
                        continue;
                    }
                }
                if((rs=_validationField(value,data,validate[i]))!==true){
                    if(type==false){
                        return rs;
                    }else{
                        error[validate[i][0]]=rs;
                    }
                }
            }
        }
        //返回验证结果
        return $.isEmptyObject(error)?true:error;

        //根据验证因子验证字段
        function _validationField(value,data,validate){

            if(validate[4]=='number'){
                // alert(value);
                //验证选择数量（复选框）
                if(typeof(value)=='string'){
                    value=[value];
                }
                return $.isArray(value)&&value.length>=validate['1']?(validate[5]?true:validate[2]):(validate[5]?validate[2]:true);

            }else if(validate[4]=='function'){
                //函数验证
                return typeof(validate[1])=='function'&&validate[1](value)?(validate[5]?true:validate[2]):(validate[5]?validate[2]:true);

            }else if(validate[4]=='confirm'){
                //验证表单中的两个字段是否相同
                return value==data[validate[1]]?(validate[5]?true:validate[2]):(validate[5]?validate[2]:true);

            }else if(validate[4]=='in'){
                //验证是否在某个范围内
                if(typeof(validate[1])=='string'){
                    validate[1]=validate[1].split(',');
                }
                return $.inArray(value,validate[1])!=-1?(validate[5]?true:validate[2]):(validate[5]?validate[2]:true);

            }else if(validate[4]=='equal'){
                //验证是否等于某个值，该值由前面的验证规则定义
                return validate[1]==value?(validate[5]?true:validate[2]):(validate[5]?validate[2]:true);

            }else if(validate[4]=='length'){
                //验证是否等于某个值，该值由前面的验证规则定义
                var length=validate[1].split(',');
                return value.length>=length[0]&&value.length<=length[1]?(validate[5]?true:validate[2]):(validate[5]?validate[2]:true);

            }else{
                //正则验证
                var pattern={
                    empty:/^\s*$/,
                    require:/^.+$/,
                    number:/^\d+$/,
                    mail:/^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/,
                    email:/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/,
                    url:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/
                }
                //使用预定义正则
                if(typeof(pattern[validate[1]])!='undefined'){
                    validate[1]=pattern[validate[1]];
                }
                var regex = new RegExp(validate[1]);
                return regex.test(value)?(validate[5]?true:validate[2]):(validate[5]?validate[2]:true);
            }
        }

        //序列化数据
        function _serializeJSON(data){
            var result={};
            for(index in data){
                if(result[data[index]['name']]){
                    if(typeof(result[data[index]['name']])=='string'){
                        result[data[index]['name']]=[result[data[index]['name']]];
                    }
                    result[data[index]['name']].push(data[index]['value']);
                }else{
                    result[data[index]['name']]=data[index]['value'];
                }
            }
            return result;
        }
    }
 })(jQuery);