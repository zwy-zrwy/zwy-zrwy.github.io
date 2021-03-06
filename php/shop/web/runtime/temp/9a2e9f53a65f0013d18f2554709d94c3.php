<?php /*a:2:{s:56:"D:\shop\zhouweiyao\application\admin\view\role\edit.html";i:1573537457;s:53:"D:\shop\zhouweiyao\application\admin\view\layout.html";i:1576717639;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后端</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <script src="/static/layui/jquery-3.4.1.js"></script>
    <script src="/static/layui/layui.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">商城后台</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="http://zhouweiyao.xarlit.cn/admin/access_token/index">更新Access_Token</a></li>
            <li class="layui-nav-item"><a href="http://zhouweiyao.xarlit.cn/admin/jsapi_ticket/index">更新jsapi_ticket</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                   欢迎你！<?php echo htmlentities(app('session')->get('admin_name')); ?>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="<?php echo url('admin/login/logout'); ?>">退出</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="layui-nav-item" >
                    <a class="" href="javascript:;"><?php echo htmlentities($vo['name']); ?></a>
                    <dl class="layui-nav-child">
                        <?php if(is_array($vo['sub']) || $vo['sub'] instanceof \think\Collection || $vo['sub'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>
                        <dd <?php if($sub['con'] == $con): ?> class="layui-this" <?php endif; ?>><a href="<?php echo url($sub['con']); ?>" ><?php echo htmlentities($sub['name']); ?></a></dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;"><form action="<?php echo url('admin/role/edit'); ?>" method="post" class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">角色名</label>
        <div class="layui-input-block">
            <input type="text" name="name" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input" value="<?php echo htmlentities($info['name']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" >权限</label>
        <div class="layui-input-block">
            <?php if(is_array($nodes) || $nodes instanceof \think\Collection || $nodes instanceof \think\Paginator): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <input type="checkbox" name="nodes[]" value="<?php echo htmlentities($vo['id']); ?>" title="<?php echo htmlentities($vo['name']); ?>" <?php if(in_array(($vo['id']), is_array($info['nodes'])?$info['nodes']:explode(',',$info['nodes']))): ?>checked<?php endif; ?>><br/>
            <?php if(is_array($vo['sub']) || $vo['sub'] instanceof \think\Collection || $vo['sub'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>
            <input type="checkbox" name="nodes[]" value="<?php echo htmlentities($sub['id']); ?>" title="<?php echo htmlentities($sub['name']); ?>" <?php if(in_array(($sub['id']), is_array($info['nodes'])?$info['nodes']:explode(',',$info['nodes']))): ?>checked<?php endif; ?>>
            <?php endforeach; endif; else: echo "" ;endif; ?><br/><br/>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="1" title="启用" checked>
            <input type="radio" name="status" value="0" title="禁用">
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo htmlentities($info['id']); ?>">
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="submit" value="提交" class="layui-btn">
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form></div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
    </div>
</div>
<script>
    //JavaScript代码区域
    layui.use(['element','form'], function(){
        var element = layui.element,form = layui.form;

    });
    $(".layui-this").parent().parent().addClass('layui-nav-itemed');
</script>
</body>
</html>