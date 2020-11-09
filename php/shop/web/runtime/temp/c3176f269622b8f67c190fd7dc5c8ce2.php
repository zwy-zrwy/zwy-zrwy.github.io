<?php /*a:1:{s:77:"/www/wwwroot/shop.zhouweiyaocloud.xyz/application/index/view/goods/index.html";i:1585114422;}*/ ?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="zh-CN">
    <link rel="stylesheet" href="/static/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/style.css" />
    <link rel="stylesheet" href="/static/css/slide.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/goods_list.css" />
    <title>购物</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="copyright" content="" />
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/common.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <link href="/static/css/common.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        $(document).ready(function() {
            var showproduct = {
                "boxid": "showbox",
                "sumid": "showsum",
                "boxw": 400, //宽度,该版本中请把宽高填写成一样
                "boxh": 400, //高度,该版本中请把宽高填写成一样
                "sumw": 60, //列表每个宽度,该版本中请把宽高填写成一样
                "sumh": 60, //列表每个高度,该版本中请把宽高填写成一样
                "sumi": 7, //列表间隔
                "sums": 5, //列表显示个数
                "sumsel": "sel",
                "sumborder": 1, //列表边框，没有边框填写0，边框在css中修改
                "lastid": "showlast",
                "nextid": "shownext"
            };
            $.ljsGlasses.pcGlasses(showproduct); //方法调用，务必在加载完后执行
        });
    </script>
    <style>
        .search {
            margin-top: 6px;
        }

        .dsc-search .search-text {
            height: 34px;
        }

        .city-choice {
            float: left;
        }

        .city-choice .dsc-cm {
            position: static;
            border: none;
            height: 28px;
            line-height: 28px;
            z-index: 1;
        }
    </style>
</head>

<body>
<div class="top_banner">
    <div class="module w1200">
        <a href="javascript:">
            <img src="/static/images/active.jpg" />
            <i class="icon-close"><img src="/static/images/close.png"/></i>
        </a>
    </div>
</div>
<div class="site-nav" id="site-nav">
    <div class="w w1200">
        <div class="fl">
            <div class="city-choice" id="city-choice" data-ectype="dorpdown">
                <div class="dsc-choie dsc-cm" ectype="dsc-choie">
                    <img src="/static/images/place.png" class="place" />
                    <input type="text" value="石家庄" class="search" />
                </div>

            </div>
            <div class="txt-info" id="ECS_MEMBERZONE">
                <?php if(app('session')->get('user_name')): ?><a href="<?php echo url('user/index/index'); ?>" class="link-regist"><?php echo htmlentities(app('session')->get('user_name')); ?></a>
                <a href="<?php echo url('user/login/logout'); ?>" class="link-login red">退出登录</a>
                <?php else: ?>
                <a href="<?php echo url('user/login/index'); ?>" class="link-login red">请登录</a>
                <?php endif; ?>
            </div>
        </div>
        <ul class="quick-menu fr">
            <li>
                <div class="dt">
                    <a href="<?php echo url('flow/index'); ?>">我的订单</a>
                </div>
            </li>
            <li class="spacer"></li>
            <li>
                <div class="dt">
                    <a href="#">我的浏览</a>
                </div>
            </li>
            <li class="spacer"></li>
            <li>
                <div class="dt">
                    <a href="#">我的收藏</a>
                </div>
            </li>
            <li class="spacer"></li>
            <li>
                <div class="dt">
                    <a href="#">客户服务</a>
                </div>
            </li>
            <li class="spacer"></li>
            <li class="li_dorpdown" data-ectype="dorpdown">
                <div class="dt dsc-cm">网站导航</div>
                <div class="dd dorpdown-layer" style="z-index: 10000000;">
                    <dl class="fore1">
                        <dt>特色主题</dt>
                        <dd>
                            <div class="item">
                                <a href="#" target="_blank">家用电器</a>
                            </div>
                            <div class="item">
                                <a href="#" target="_blank">手机数码</a>
                            </div>
                            <div class="item">
                                <a href="#" target="_blank">电脑办公</a>
                            </div>
                        </dd>
                    </dl>
                    <dl class="fore2">
                        <dt>促销活动</dt>
                        <dd>
                            <div class="item">
                                <a href="#">拍卖活动</a>
                            </div>
                            <div class="item">
                                <a href="#">共创商品</a>
                            </div>
                            <div class="item">
                                <a href="#">优惠活动</a>
                            </div>
                            <div class="item">
                                <a href="#">批发市场</a>
                            </div>
                            <div class="item">
                                <a href="#">超值礼包</a>
                            </div>
                            <div class="item">
                                <a href="#">优惠券</a>
                            </div>
                        </dd>
                    </dl>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="clear"></div>
<div class="header">
    <div class="header_container">
        <div class="logo fl">
            <img src="/static/images/logo.png" />
            <a href="#"><img src="/static/images/ecsc-join.gif" /></a>
        </div>
        <div class="dsc-search">
            <div class="form">
                <form class="search-form">
                    <input name="keywords" type="text" id="keyword" value="" class="search-text" style="color: rgb(153, 153, 153);">
                    <button type="submit" class="button button-goods">搜商品</button>
                    <button type="submit" class="button button-store">搜店铺</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="nav" ectype="dscNav">
    <div class="w w1200">
        <div class="categorys site_mast ">
            <div class="categorys-type">
                <a href="#" target="_blank">全部商品分类</a>
            </div>
            <div class="categorys-tab-content">
                <div class="categorys-items" id="cata-nav">
                    <div class="categorys-item">
                        <div class="item item-content">
                            <i class="iconfont icon-ele"><img src="/static/images/elece.png"></i>
                            <div class="categorys-title">
                                <strong>
                                    <a href="#" target="_blank">家用电器</a>
                                </strong>
                                <span>
                                            <a href="#" target="_blank">大家电</a>
                                            <a href="#" target="_blank">生活电器</a>
                                    	</span>
                            </div>
                        </div>
                        <div class="categorys-items-layer">
                            <div class="cate-layer-con clearfix">
                                <div class="cate-layer-left">
                                    <div class="cate_channel">
                                        <a href="#" target="_blank">品牌日</a>
                                        <a href="#" target="_blank">家电城</a>
                                        <a href="#" target="_blank">智能生活馆</a>
                                        <a href="#" target="_blank">京东净化馆</a>
                                        <a href="#" target="_blank">京东帮服务店</a>
                                        <a href="#" target="_blank">值得买精选</a>
                                    </div>
                                    <div class="cate_detail">
                                        <dl class="dl_fore1">
                                            <dt><a href="#" target="_blank">大家电</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">平板电视</a>
                                                <a href="#" target="_blank">空调</a>
                                                <a href="#" target="_blank">冰箱</a>
                                                <a href="#" target="_blank">洗衣机</a>
                                                <a href="#" target="_blank">家庭影院</a>
                                                <a href="#" target="_blank">DVD</a>
                                                <a href="#" target="_blank">迷你音响</a>
                                                <a href="#" target="_blank">热水器</a>
                                                <a href="#" target="_blank">冷吧/冰柜</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore2">
                                            <dt><a href="#" target="_blank">生活电器</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">电风扇</a>
                                                <a href="#" target="_blank">冷风扇</a>
                                                <a href="#" target="_blank">净化器</a>
                                                <a href="#" target="_blank">加湿器</a>
                                                <a href="#" target="_blank">扫地机器人</a>
                                                <a href="#" target="_blank">吸尘器</a>
                                                <a href="#" target="_blank">插座</a>
                                                <a href="#" target="_blank">电话机</a>
                                                <a href="#" target="_blank">饮水机</a>
                                                <a href="#" target="_blank">取暖电器</a>
                                                <a href="#" target="_blank">净水设备</a>
                                                <a href="#" target="_blank">干衣机</a>
                                                <a href="#" target="_blank">收音机/录音机</a>
                                                <a href="#" target="_blank">电器开关</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore3">
                                            <dt><a href="#" target="_blank">厨房电器</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">电饭煲</a>
                                                <a href="#" target="_blank">电压力锅</a>
                                                <a href="#" target="_blank">豆浆机</a>
                                                <a href="#" target="_blank">面包机</a>
                                                <a href="#" target="_blank">咖啡机</a>
                                                <a href="#" target="_blank">微波炉</a>
                                                <a href="#" target="_blank">料理/榨汁机</a>
                                                <a href="#" target="_blank">电烤箱</a>
                                                <a href="#" target="_blank">电磁炉</a>
                                                <a href="#" target="_blank">电饼铛/烧火盘</a>
                                                <a href="#" target="_blank">煮蛋器</a>
                                                <a href="#" target="_blank">酸奶机</a>
                                                <a href="#" target="_blank">电水壶/热水瓶</a>
                                                <a href="#" target="_blank">电饭盒</a>
                                                <a href="#" target="_blank">其他厨房电器</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore4">
                                            <dt><a href="#" target="_blank">个护健康</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">按摩椅</a>
                                                <a href="#" target="_blank">剃须刀</a>
                                                <a href="#" target="_blank">脱毛器</a>
                                                <a href="#" target="_blank">口腔护理</a>
                                                <a href="#" target="_blank">电吹风</a>
                                                <a href="#" target="_blank">美容器</a>
                                                <a href="#" target="_blank">理发器</a>
                                                <a href="#" target="_blank">按摩器</a>
                                                <a href="#" target="_blank">足浴盆</a>
                                                <a href="#" target="_blank">血压计</a>
                                                <a href="#" target="_blank">健康秤/厨房秤</a>
                                                <a href="#" target="_blank">血糖计</a>
                                                <a href="#" target="_blank">计步器</a>
                                                <a href="#" target="_blank">其他健康电器</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore5">
                                            <dt><a href="#" target="_blank">五金家装</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">电动工具</a>
                                                <a href="#" target="_blank">手动工具</a>
                                                <a href="#" target="_blank">仪器</a>
                                                <a href="#" target="_blank">仪表</a>
                                                <a href="#" target="_blank">浴霸/排气扇</a>
                                                <a href="#" target="_blank">灯具</a>
                                                <a href="#" target="_blank">LED灯</a>
                                                <a href="#" target="_blank">洁身器</a>
                                                <a href="#" target="_blank">水槽</a>
                                                <a href="#" target="_blank">龙头</a>
                                                <a href="#" target="_blank">沐浴花洒</a>
                                                <a href="#" target="_blank">厨卫五金</a>
                                                <a href="#" target="_blank">家具五金</a>
                                                <a href="#" target="_blank">门铃</a>
                                                <a href="#" target="_blank">监控安防</a>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="cate-layer-rihgt">
                                    <h3>猜你喜欢</h3>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="categorys-item">
                        <div class="item item-content">
                            <i class="iconfont icon-digital"><img src="/static/images/phone.png"></i>
                            <div class="categorys-title">
                                <strong>
                                    <a href="#" target="_blank" class="division_cat">手机</a>、
                                    <a href="#" target="_blank" class="division_cat">数码</a>、
                                    <a href="#" target="_blank" class="division_cat">通信</a>
                                </strong>
                                <span>
                                            <a href="#" target="_blank">智能设备</a>
                                            <a href="#" target="_blank">数码配件</a>
                                    	</span>
                            </div>
                        </div>
                        <div class="categorys-items-layer">
                            <div class="cate-layer-con clearfix">
                                <div class="cate-layer-left">
                                    <div class="cate_channel" ectype="channels_3">
                                        <a href="#" target="_blank">手机频道</a>
                                        <a href="#" target="_blank">网上营业厅</a>
                                        <a href="#" target="_blank">配件城</a>
                                        <a href="#" target="_blank">影像Club</a>
                                        <a href="#" target="_blank">手机社区</a>
                                        <a href="#" target="_blank">以旧换新</a>

                                    </div>
                                    <div class="cate_detail" ectype="subitems_3">
                                        <dl class="dl_fore1">
                                            <dt><a href="#" target="_blank">智能设备</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">智能手环</a>
                                                <a href="#" target="_blank">智能手表</a>
                                                <a href="#" target="_blank">智能眼镜</a>
                                                <a href="#" target="_blank">运动跟踪器</a>
                                                <a href="#" target="_blank">健康监测</a>
                                                <a href="#" target="_blank">智能配饰</a>
                                                <a href="#" target="_blank">智能家居</a>
                                                <a href="#" target="_blank">体感车</a>
                                                <a href="#" target="_blank">其他配件</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore2">
                                            <dt><a href="#" target="_blank">数码配件</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">存储卡</a>
                                                <a href="#" target="_blank">读卡器</a>
                                                <a href="#" target="_blank">滤镜</a>
                                                <a href="#" target="_blank">闪光灯/手柄</a>
                                                <a href="#" target="_blank">相机包</a>
                                                <a href="#" target="_blank">三脚架/云台</a>
                                                <a href="#" target="_blank">相机清洁</a>
                                                <a href="#" target="_blank">相机贴膜</a>
                                                <a href="#" target="_blank">机身附件</a>
                                                <a href="#" target="_blank">镜头附件</a>
                                                <a href="#" target="_blank">电池/充电器</a>
                                                <a href="#" target="_blank">移动电源</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore3">
                                            <dt><a href="#" target="_blank">手机通讯</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">手机</a>
                                                <a href="#" target="_blank">对讲机</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore4">
                                            <dt><a href="#" target="_blank">运营商</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">购机送费</a>
                                                <a href="#" target="_blank">0元购机</a>
                                                <a href="#" target="_blank">选号入网</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore5">
                                            <dt><a href="#" target="_blank">手机配件</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">电池</a>
                                                <a href="#" target="_blank">蓝牙耳机</a>
                                                <a href="#" target="_blank">充电器/数据线</a>
                                                <a href="#" target="_blank">手机耳机</a>
                                                <a href="#" target="_blank">贴膜</a>
                                                <a href="#" target="_blank">存储卡</a>
                                                <a href="#" target="_blank">保护套</a>
                                                <a href="#" target="_blank">车载</a>
                                                <a href="#" target="_blank">iPhone配件</a>
                                                <a href="#" target="_blank">创意配件</a>
                                                <a href="#" target="_blank">便携/无线音箱</a>
                                                <a href="#" target="_blank">手机饰品</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore6">
                                            <dt><a href="#" target="_blank">摄影摄像</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">数码相机</a>
                                                <a href="#" target="_blank">单电/微单相机</a>
                                                <a href="#" target="_blank">单反相机</a>
                                                <a href="#" target="_blank">拍立得</a>
                                                <a href="#" target="_blank">运动相机</a>
                                                <a href="#" target="_blank">摄像机</a>
                                                <a href="#" target="_blank">镜头</a>
                                                <a href="#" target="_blank">户外器材</a>
                                                <a href="#" target="_blank">摄影器材</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore7">
                                            <dt><a href="#" target="_blank">时尚影音</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">耳机/耳麦</a>
                                                <a href="#" target="_blank">音箱/音响</a>
                                                <a href="#" target="_blank">麦克风</a>
                                                <a href="#" target="_blank">MP3/MP4</a>
                                                <a href="#" target="_blank">数码相框</a>
                                                <a href="#" target="_blank">专业音频</a>
                                                <a href="#" target="_blank">苹果周边</a>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="cate-layer-rihgt">
                                    <h3>猜你喜欢</h3>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="categorys-item">
                        <div class="item item-content">
                            <i class="iconfont icon-computer"><img src="/static/images/elec.png"></i>
                            <div class="categorys-title">
                                <strong>
                                    <a href="#" target="_blank">电脑、办公</a>
                                </strong>
                                <span>
                                            <a href="#" target="_blank">服务产品</a>
                                            <a href="#" target="_blank">电脑整机</a>
										</span>
                            </div>
                        </div>
                        <div class="categorys-items-layer">
                            <div class="cate-layer-con clearfix">
                                <div class="cate-layer-left">
                                    <div class="cate_channel" ectype="channels_4">
                                        <a href="#" target="_blank">本周热卖</a>
                                        <a href="#" target="_blank">游戏部落</a>
                                        <a href="#" target="_blank">智能社区</a>
                                        <a href="#" target="_blank">GAME+</a>
                                        <a href="#" target="_blank">装机大师</a>
                                        <a href="#" target="_blank">办公生活馆</a>

                                    </div>
                                    <div class="cate_detail" ectype="subitems_4">
                                        <dl class="dl_fore1">
                                            <dt><a href="#" target="_blank">服务产品</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">上门服务</a>
                                                <a href="#" target="_blank">远程服务</a>
                                                <a href="#" target="_blank">电脑软件</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore2">
                                            <dt><a href="#" target="_blank">电脑整机</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">笔记本</a>
                                                <a href="#" target="_blank">超级本</a>
                                                <a href="#" target="_blank">游戏本</a>
                                                <a href="#" target="_blank">平板电脑</a>
                                                <a href="#" target="_blank">平板电脑配件</a>
                                                <a href="#" target="_blank">台式机</a>
                                                <a href="#" target="_blank">笔记本配件</a>
                                                <a href="#" target="_blank">服务器/工作站</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore3">
                                            <dt><a href="#" target="_blank">电脑配件</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">CPU</a>
                                                <a href="#" target="_blank">主板</a>
                                                <a href="#" target="_blank">显卡</a>
                                                <a href="#" target="_blank">硬盘</a>
                                                <a href="#" target="_blank">SSD固态硬盘</a>
                                                <a href="#" target="_blank">内存</a>
                                                <a href="#" target="_blank">机箱</a>
                                                <a href="#" target="_blank">电源</a>
                                                <a href="#" target="_blank">显示器</a>
                                                <a href="#" target="_blank">刻录机/光驱</a>
                                                <a href="#" target="_blank">声卡、扩展卡</a>
                                                <a href="#" target="_blank">散热器</a>
                                                <a href="#" target="_blank">装机配件</a>
                                                <a href="#" target="_blank">组装电脑</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore4">
                                            <dt><a href="#" target="_blank">外设产品</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">鼠标</a>
                                                <a href="#" target="_blank">键盘</a>
                                                <a href="#" target="_blank">游戏设备</a>
                                                <a href="#" target="_blank">U盘</a>
                                                <a href="#" target="_blank">移动硬盘</a>
                                                <a href="#" target="_blank">鼠标垫</a>
                                                <a href="#" target="_blank">摄像头</a>
                                                <a href="#" target="_blank">线缆</a>
                                                <a href="#" target="_blank">电玩</a>
                                                <a href="#" target="_blank">手写板</a>
                                                <a href="#" target="_blank">外置盒</a>
                                                <a href="#" target="_blank">电脑工具</a>
                                                <a href="#" target="_blank">电脑清洁</a>
                                                <a href="#" target="_blank">UPS</a>
                                                <a href="#" target="_blank">插座</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore5">
                                            <dt><a href="#" target="_blank">网络产品</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">路由器</a>
                                                <a href="#" target="_blank">网卡</a>
                                                <a href="#" target="_blank">交换机</a>
                                                <a href="#" target="_blank">网络存储</a>
                                                <a href="#" target="_blank">4G/3G上网</a>
                                                <a href="#" target="_blank">网络盒子</a>
                                                <a href="#" target="_blank">网络配件</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore6">
                                            <dt><a href="#" target="_blank">办公打印</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">打印机</a>
                                                <a href="#" target="_blank">一体机</a>
                                                <a href="#" target="_blank">投影机</a>
                                                <a href="#" target="_blank">投影配件</a>
                                                <a href="#" target="_blank">传真机</a>
                                                <a href="#" target="_blank">复合机</a>
                                                <a href="#" target="_blank">碎纸机</a>
                                                <a href="#" target="_blank">扫描仪</a>
                                                <a href="#" target="_blank">墨盒</a>
                                                <a href="#" target="_blank">硒鼓</a>
                                                <a href="#" target="_blank">墨粉</a>
                                                <a href="#" target="_blank">色带</a>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="cate-layer-rihgt">
                                    <h3>猜你喜欢</h3>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="categorys-item">
                        <div class="item item-content">
                            <i class="iconfont icon-bed"><img src="/static/images/home.png"/></i>
                            <div class="categorys-title">
                                <strong>
                                    <a href="#" target="_blank">家居、家具、家装、厨具</a>
                                </strong>
                                <span>
                                       	 	<a href="#" target="_blank">厨具</a>
                                        	<a href="#" target="_blank">家装建材</a>
                                    	</span>
                            </div>
                        </div>
                        <div class="categorys-items-layer" ectype="cateLayer">
                            <div class="cate-layer-con clearfix">
                                <div class="cate-layer-left">
                                    <div class="cate_channel" ectype="channels_5">
                                        <a href="#" target="_blank">家装城</a>
                                        <a href="#" target="_blank">居家日用</a>
                                        <a href="#" target="_blank">精品家具</a>
                                        <a href="#" target="_blank">家装建材</a>
                                        <a href="#" target="_blank">厨房达人</a>
                                        <a href="#" target="_blank">猫猫狗狗</a>

                                    </div>
                                    <div class="cate_detail" ectype="subitems_5">
                                        <dl class="dl_fore1">
                                            <dt><a href="#" target="_blank">厨具</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">烹饪锅具</a>
                                                <a href="#" target="_blank">刀剪菜板</a>
                                                <a href="#" target="_blank">厨房配件</a>
                                                <a href="#" target="_blank">水具酒具</a>
                                                <a href="#" target="_blank">餐具</a>
                                                <a href="#" target="_blank">茶具/咖啡具</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore2">
                                            <dt><a href="#" target="_blank">家装建材</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">灯饰照明</a>
                                                <a href="#" target="_blank">厨房卫浴</a>
                                                <a href="#" target="_blank">五金工具</a>
                                                <a href="#" target="_blank">电工电料</a>
                                                <a href="#" target="_blank">墙地面材料</a>
                                                <a href="#" target="_blank">装饰材料</a>
                                                <a href="#" target="_blank">装修服务</a>
                                                <a href="#" target="_blank">吸顶灯</a>
                                                <a href="#" target="_blank">淋浴花洒</a>
                                                <a href="#" target="_blank">开关插座</a>
                                                <a href="#" target="_blank">油漆涂料</a>
                                                <a href="#" target="_blank">龙头</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore3">
                                            <dt><a href="#" target="_blank">家纺</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">床品套件</a>
                                                <a href="#" target="_blank">被子</a>
                                                <a href="#" target="_blank">蚊帐</a>
                                                <a href="#" target="_blank">凉席</a>
                                                <a href="#" target="_blank">床单被罩</a>
                                                <a href="#" target="_blank">枕芯</a>
                                                <a href="#" target="_blank">毛巾浴巾</a>
                                                <a href="#" target="_blank">布艺软饰</a>
                                                <a href="#" target="_blank">毯子</a>
                                                <a href="#" target="_blank">抱枕靠垫</a>
                                                <a href="#" target="_blank">床垫/床褥</a>
                                                <a href="#" target="_blank">窗帘/窗纱</a>
                                                <a href="#" target="_blank">电热毯</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore4">
                                            <dt><a href="#" target="_blank">家具</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">卧室家具</a>
                                                <a href="#" target="_blank">客厅家具</a>
                                                <a href="#" target="_blank">餐厅家具</a>
                                                <a href="#" target="_blank">书房家具</a>
                                                <a href="#" target="_blank">储物家具</a>
                                                <a href="#" target="_blank">阳台/户外</a>
                                                <a href="#" target="_blank">商业办公</a>
                                                <a href="#" target="_blank">床</a>
                                                <a href="#" target="_blank">床垫</a>
                                                <a href="#" target="_blank">沙发</a>
                                                <a href="#" target="_blank">电脑椅</a>
                                                <a href="#" target="_blank">衣柜</a>
                                                <a href="#" target="_blank">茶几</a>
                                                <a href="#" target="_blank">电视柜</a>
                                                <a href="#" target="_blank">餐桌</a>
                                                <a href="#" target="_blank">电脑桌</a>
                                                <a href="#" target="_blank">鞋架/衣帽架</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore5">
                                            <dt><a href="#" target="_blank">灯具</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">台灯</a>
                                                <a href="#" target="_blank">吸顶灯</a>
                                                <a href="#" target="_blank">筒灯射灯</a>
                                                <a href="#" target="_blank">LED灯</a>
                                                <a href="#" target="_blank">节能灯</a>
                                                <a href="#" target="_blank">落地灯</a>
                                                <a href="#" target="_blank">五金电器</a>
                                                <a href="#" target="_blank">应急灯/手电</a>
                                                <a href="#" target="_blank">装饰灯</a>
                                                <a href="#" target="_blank">吊灯</a>
                                                <a href="#" target="_blank">氛围照明</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore6">
                                            <dt><a href="#" target="_blank">生活日用</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">收纳用品</a>
                                                <a href="#" target="_blank">雨伞雨具</a>
                                                <a href="#" target="_blank">浴室用品</a>
                                                <a href="#" target="_blank">缝纫/针织用品</a>
                                                <a href="#" target="_blank">洗晒/熨烫</a>
                                                <a href="#" target="_blank">净化除味</a>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="cate-layer-rihgt">
                                    <h3>猜你喜欢</h3>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="categorys-item">
                        <div class="item item-content">
                            <i class="iconfont icon-clothes"><img src="/static/images/short.png"/></i>
                            <div class="categorys-title">
                                <strong>
                                    <a href="#" target="_blank">男装、女装、内衣</a>
                                </strong>
                                <span>
                                            <a href="#" target="_blank">女装</a>
                                            <a href="#" target="_blank">男装</a>
                    					</span>
                            </div>
                        </div>
                        <div class="categorys-items-layer" ectype="cateLayer">
                            <div class="cate-layer-con clearfix">
                                <div class="cate-layer-left">
                                    <div class="cate_channel" ectype="channels_6">
                                        <a href="#" target="_blank">男装</a>
                                        <a href="#" target="_blank">女装</a>
                                        <a href="#" target="_blank">内衣</a>
                                        <a href="#" target="_blank">国际品牌</a>

                                    </div>
                                    <div class="cate_detail" ectype="subitems_6">
                                        <dl class="dl_fore1">
                                            <dt><a href="#" target="_blank">女装</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">连衣裙</a>
                                                <a href="#" target="_blank">蕾丝/雪纺衫</a>
                                                <a href="#" target="_blank">衬衫</a>
                                                <a href="#" target="_blank">T恤</a>
                                                <a href="#" target="_blank">半身裙</a>
                                                <a href="#" target="_blank">休闲裤</a>
                                                <a href="#" target="_blank">短裤</a>
                                                <a href="#" target="_blank">牛仔裤</a>
                                                <a href="#" target="_blank">针织衫</a>
                                                <a href="#" target="_blank">吊带/背心</a>
                                                <a href="#" target="_blank">打底衫</a>
                                                <a href="#" target="_blank">打底裤</a>
                                                <a href="#" target="_blank">正装裤</a>
                                                <a href="#" target="_blank">小西服</a>
                                                <a href="#" target="_blank">马甲</a>
                                                <a href="#" target="_blank">风衣</a>
                                                <a href="#" target="_blank">羊毛衫</a>
                                                <a href="#" target="_blank">羊绒衫</a>
                                                <a href="#" target="_blank">短外套</a>
                                                <a href="#" target="_blank">棉服</a>
                                                <a href="#" target="_blank">毛呢大衣</a>
                                                <a href="#" target="_blank">加绒裤</a>
                                                <a href="#" target="_blank">羽绒服</a>
                                                <a href="#" target="_blank">皮草</a>
                                                <a href="#" target="_blank">真皮皮衣</a>
                                                <a href="#" target="_blank">仿皮皮衣</a>
                                                <a href="#" target="_blank">旗袍/唐装</a>
                                                <a href="#" target="_blank">礼服</a>
                                                <a href="#" target="_blank">婚纱</a>
                                                <a href="#" target="_blank">中老年女装</a>
                                                <a href="#" target="_blank">大码女装</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore2">
                                            <dt><a href="#" target="_blank">男装</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">T恤</a>
                                                <a href="#" target="_blank">裤子</a>
                                                <a href="#" target="_blank">POLO衫</a>
                                                <a href="#" target="_blank">针织衫</a>
                                                <a href="#" target="_blank">夹克</a>
                                                <a href="#" target="_blank">卫衣</a>
                                                <a href="#" target="_blank">风衣</a>
                                                <a href="#" target="_blank">马甲/背心</a>
                                                <a href="#" target="_blank">短裤</a>
                                                <a href="#" target="_blank">休闲裤</a>
                                                <a href="#" target="_blank">牛仔裤</a>
                                                <a href="#" target="_blank">西服</a>
                                                <a href="#" target="_blank">西裤</a>
                                                <a href="#" target="_blank">西服套装</a>
                                                <a href="#" target="_blank">真皮皮衣</a>
                                                <a href="#" target="_blank">仿皮皮衣</a>
                                                <a href="#" target="_blank">羽绒服</a>
                                                <a href="#" target="_blank">毛呢大衣</a>
                                                <a href="#" target="_blank">棉服</a>
                                                <a href="#" target="_blank">羊绒衫</a>
                                                <a href="#" target="_blank">羊毛衫</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore3">
                                            <dt><a href="#" target="_blank">服饰配件</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">配饰</a>
                                                <a href="#" target="_blank">光学镜架/镜片</a>
                                                <a href="#" target="_blank">防辐射眼镜</a>
                                                <a href="#" target="_blank">女士丝巾/围巾/披肩</a>
                                                <a href="#" target="_blank">棒球帽</a>
                                                <a href="#" target="_blank">遮阳伞/雨伞</a>
                                                <a href="#" target="_blank">遮阳帽</a>
                                                <a href="#" target="_blank">领带/领结/领带夹</a>
                                                <a href="#" target="_blank">男士腰带/礼盒</a>
                                                <a href="#" target="_blank">防晒手套</a>
                                                <a href="#" target="_blank">老花镜</a>
                                                <a href="#" target="_blank">袖扣</a>
                                                <a href="#" target="_blank">鸭舌帽</a>
                                                <a href="#" target="_blank">装饰眼镜</a>
                                                <a href="#" target="_blank">女士腰带/礼盒</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore4">
                                            <dt><a href="#" target="_blank">内衣</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">内衣配件</a>
                                                <a href="#" target="_blank">文胸</a>
                                                <a href="#" target="_blank">睡衣/家居服</a>
                                                <a href="#" target="_blank">情侣睡衣</a>
                                                <a href="#" target="_blank">文胸套装</a>
                                                <a href="#" target="_blank">少女文胸</a>
                                                <a href="#" target="_blank">女式内裤</a>
                                                <a href="#" target="_blank">男式内裤</a>
                                                <a href="#" target="_blank">商务男袜</a>
                                                <a href="#" target="_blank">休闲棉袜</a>
                                                <a href="#" target="_blank">吊带/背心</a>
                                                <a href="#" target="_blank">打底衫</a>
                                                <a href="#" target="_blank">抹胸</a>
                                                <a href="#" target="_blank">连裤袜/丝袜</a>
                                                <a href="#" target="_blank">美腿袜</a>
                                                <a href="#" target="_blank">打底裤袜</a>
                                                <a href="#" target="_blank">塑身美体</a>
                                                <a href="#" target="_blank">大码内衣</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore5">
                                            <dt><a href="#" target="_blank">运动户外</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">跑步运动</a>
                                                <a href="#" target="_blank">室内健身</a>
                                                <a href="#" target="_blank">自行车运动</a>
                                                <a href="#" target="_blank">轮滑运动</a>
                                                <a href="#" target="_blank">羽毛球/网球/乒乓球</a>
                                                <a href="#" target="_blank">足球/篮球/排球</a>
                                                <a href="#" target="_blank">运动休闲</a>
                                                <a href="#" target="_blank">钓鱼用品</a>
                                                <a href="#" target="_blank">野营烧烤</a>
                                                <a href="#" target="_blank">游泳运动</a>
                                                <a href="#" target="_blank">舞蹈运动</a>
                                                <a href="#" target="_blank">瑜伽运动</a>
                                                <a href="#" target="_blank">防狼防身</a>
                                                <a href="#" target="_blank">水上运动</a>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="cate-layer-rihgt">
                                    <h3>猜你喜欢</h3>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="categorys-item" ectype="cateItem" data-id="8" data-eveval="0">
                        <div class="item item-content">
                            <i class="iconfont icon-shoes"><img src="/static/images/sport.png"/></i>
                            <div class="categorys-title">
                                <strong>
                                    <a href="#" target="_blank">鞋靴、箱包、钟表、奢侈品</a>
                                </strong>
                                <span>
                                            <a href="#" target="_blank">奢侈品</a>
                                            <a href="#" target="_blank">功能箱包</a>
                    					</span>
                            </div>
                        </div>
                        <div class="categorys-items-layer" ectype="cateLayer">
                            <div class="cate-layer-con clearfix">
                                <div class="cate-layer-left">
                                    <div class="cate_channel" ectype="channels_8">
                                        <a href="#" target="_blank">男鞋</a>
                                        <a href="#" target="_blank">女鞋</a>
                                        <a href="#" target="_blank">箱包</a>
                                        <a href="#" target="_blank">钟表</a>
                                        <a href="#" target="_blank">奢侈品</a>
                                        <a href="#" target="_blank">女包</a>

                                    </div>
                                    <div class="cate_detail" ectype="subitems_8">
                                        <dl class="dl_fore1">
                                            <dt><a href="#" target="_blank">奢侈品</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">鞋靴</a>
                                                <a href="#" target="_blank">箱包</a>
                                                <a href="#" target="_blank">钱包</a>
                                                <a href="#" target="_blank">服饰</a>
                                                <a href="#" target="_blank">腰带</a>
                                                <a href="#" target="_blank">太阳镜/眼镜框</a>
                                                <a href="#" target="_blank">饰品</a>
                                                <a href="#" target="_blank">配件</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore2">
                                            <dt><a href="#" target="_blank">功能箱包</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">拉杆箱/拉杆包</a>
                                                <a href="#" target="_blank">旅行包</a>
                                                <a href="#" target="_blank">电脑包</a>
                                                <a href="#" target="_blank">休闲运动包</a>
                                                <a href="#" target="_blank">相机包</a>
                                                <a href="#" target="_blank">腰包/胸包</a>
                                                <a href="#" target="_blank">登山包</a>
                                                <a href="#" target="_blank">旅行配件</a>
                                                <a href="#" target="_blank">书包</a>
                                                <a href="#" target="_blank">妈咪包</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore3">
                                            <dt><a href="#" target="_blank">流行男鞋</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">休闲鞋</a>
                                                <a href="#" target="_blank">凉鞋/沙滩鞋</a>
                                                <a href="#" target="_blank">帆布鞋</a>
                                                <a href="#" target="_blank">商务休闲鞋</a>
                                                <a href="#" target="_blank">正装鞋</a>
                                                <a href="#" target="_blank">增高鞋</a>
                                                <a href="#" target="_blank">拖鞋/人字拖</a>
                                                <a href="#" target="_blank">工装鞋</a>
                                                <a href="#" target="_blank">男靴</a>
                                                <a href="#" target="_blank">传统布鞋</a>
                                                <a href="#" target="_blank">功能鞋</a>
                                                <a href="#" target="_blank">鞋配件</a>
                                                <a href="#" target="_blank">定制鞋</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore4">
                                            <dt><a href="#" target="_blank">时尚女鞋</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">凉鞋</a>
                                                <a href="#" target="_blank">单鞋</a>
                                                <a href="#" target="_blank">高跟鞋</a>
                                                <a href="#" target="_blank">坡跟鞋</a>
                                                <a href="#" target="_blank">松糕鞋</a>
                                                <a href="#" target="_blank">鱼嘴鞋</a>
                                                <a href="#" target="_blank">休闲鞋</a>
                                                <a href="#" target="_blank">帆布鞋</a>
                                                <a href="#" target="_blank">拖鞋/人字拖</a>
                                                <a href="#" target="_blank">妈妈鞋</a>
                                                <a href="#" target="_blank">防水台</a>
                                                <a href="#" target="_blank">雨鞋/雨靴</a>
                                                <a href="#" target="_blank">内增高</a>
                                                <a href="#" target="_blank">布鞋/绣花鞋</a>
                                                <a href="#" target="_blank">女靴</a>
                                                <a href="#" target="_blank">雪地靴</a>
                                                <a href="#" target="_blank">踝靴</a>
                                                <a href="#" target="_blank">马丁靴</a>
                                                <a href="#" target="_blank">鞋配件</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore5">
                                            <dt><a href="#" target="_blank">潮流女包</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">单肩包</a>
                                                <a href="#" target="_blank">手提包</a>
                                                <a href="#" target="_blank">斜跨包</a>
                                                <a href="#" target="_blank">双肩包</a>
                                                <a href="#" target="_blank">钱包</a>
                                                <a href="#" target="_blank">手拿包/晚宴包</a>
                                                <a href="#" target="_blank">卡包/零钱包</a>
                                                <a href="#" target="_blank">钥匙包</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore6">
                                            <dt><a href="#" target="_blank">精品男包</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">商务公文包</a>
                                                <a href="#" target="_blank">单肩/斜跨包</a>
                                                <a href="#" target="_blank">男生手包</a>
                                                <a href="#" target="_blank">双肩包</a>
                                                <a href="#" target="_blank">钱包/卡包</a>
                                                <a href="#" target="_blank">钥匙包</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore7">
                                            <dt><a href="#" target="_blank">钟表</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">男表</a>
                                                <a href="#" target="_blank">女表</a>
                                                <a href="#" target="_blank">儿童表</a>
                                                <a href="#" target="_blank">座钟挂钟</a>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="cate-layer-rihgt">
                                    <h3>猜你喜欢</h3>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="categorys-item" ectype="cateItem" data-id="860" data-eveval="0">
                        <div class="item item-content">
                            <i class="iconfont icon-heal"><img src="/static/images/packge.png"/></i>
                            <div class="categorys-title">
                                <strong>
                                    <a href="#" target="_blank">个人化妆、清洁用品</a>
                                </strong>
                                <span>
                                            <a href="#" target="_blank">面部护肤</a>
                                            <a href="#" target="_blank">洗发护发</a>
                                    </span>
                            </div>
                        </div>
                        <div class="categorys-items-layer" ectype="cateLayer">
                            <div class="cate-layer-con clearfix">
                                <div class="cate-layer-left">
                                    <div class="cate_channel" ectype="channels_860">
                                        <a href="#" target="_blank">清洁用品</a>
                                        <a href="#" target="_blank">美妆商城</a>
                                        <a href="#" target="_blank">官方旗舰店</a>
                                        <a href="#" target="_blank">美妆特卖</a>
                                        <a href="#" target="_blank">妆比社</a>
                                        <a href="#" target="_blank">全球购美妆</a>

                                    </div>
                                    <div class="cate_detail" ectype="subitems_860">
                                        <dl class="dl_fore1">
                                            <dt><a href="#" target="_blank">面部护肤</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">清洁</a>
                                                <a href="#" target="_blank">护肤</a>
                                                <a href="#" target="_blank">面膜</a>
                                                <a href="#" target="_blank">洗面奶</a>
                                                <a href="#" target="_blank">BB霜</a>
                                                <a href="#" target="_blank">指甲油</a>
                                                <a href="#" target="_blank">洗面泥</a>
                                                <a href="#" target="_blank">水润护肤</a>
                                                <a href="#" target="_blank">卸妆水</a>
                                                <a href="#" target="_blank">雪花膏</a>
                                                <a href="#" target="_blank">爽肤水</a>
                                                <a href="#" target="_blank">清洁套装</a>
                                                <a href="#" target="_blank">剃须</a>
                                                <a href="#" target="_blank">洁面刷</a>
                                                <a href="#" target="_blank">修眉笔</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore2">
                                            <dt><a href="#" target="_blank">洗发护发</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">洗发</a>
                                                <a href="#" target="_blank">护发</a>
                                                <a href="#" target="_blank">染发</a>
                                                <a href="#" target="_blank">造型</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore3">
                                            <dt><a href="#" target="_blank">身体护肤</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">沐浴</a>
                                                <a href="#" target="_blank">润肤</a>
                                                <a href="#" target="_blank">手足</a>
                                                <a href="#" target="_blank">美胸</a>
                                                <a href="#" target="_blank">套装</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore4">
                                            <dt><a href="#" target="_blank">口腔护理</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">牙膏/牙粉</a>
                                                <a href="#" target="_blank">牙刷/牙线</a>
                                                <a href="#" target="_blank">漱口水</a>
                                                <a href="#" target="_blank">套装</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore5">
                                            <dt><a href="#" target="_blank">香水彩妆</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">香水</a>
                                                <a href="#" target="_blank">底妆</a>
                                                <a href="#" target="_blank">腮红</a>
                                                <a href="#" target="_blank">眼部</a>
                                                <a href="#" target="_blank">美甲</a>
                                                <a href="#" target="_blank">精油放疗</a>
                                                <a href="#" target="_blank">假睫毛</a>
                                                <a href="#" target="_blank">彩妆套装</a>
                                                <a href="#" target="_blank">蜜粉</a>
                                                <a href="#" target="_blank">遮瑕</a>
                                                <a href="#" target="_blank">化妆棉</a>
                                                <a href="#" target="_blank">双眼皮贴</a>
                                                <a href="#" target="_blank">高光阴影</a>
                                                <a href="#" target="_blank">隔离</a>
                                                <a href="#" target="_blank">粉饼</a>
                                                <a href="#" target="_blank">气垫BB</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore6">
                                            <dt><a href="#" target="_blank">女性护理</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">卫生巾</a>
                                                <a href="#" target="_blank">卫生护垫</a>
                                                <a href="#" target="_blank">私密护理</a>
                                                <a href="#" target="_blank">脱毛膏</a>
                                            </dd>
                                        </dl>
                                        <dl class="dl_fore7">
                                            <dt><a href="#" target="_blank">清洁用品</a></dt>
                                            <dd>
                                                <a href="#" target="_blank">纸品湿巾</a>
                                                <a href="#" target="_blank">衣物清洁</a>
                                                <a href="#" target="_blank">清洁工具</a>
                                                <a href="#" target="_blank">家庭清洁</a>
                                                <a href="#" target="_blank">一次性用品</a>
                                                <a href="#" target="_blank">驱蚊用品</a>
                                                <a href="#" target="_blank">皮具护理</a>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="cate-layer-rihgt">
                                    <h3>猜你喜欢</h3>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                    <div class="cate-layer-right-slide">
                                        <img src="/static/images/elec1.jpg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-main" id="nav">
            <ul class="navitems">
                <li>
                    <a href="<?php echo url('index/index'); ?>" class="curr">首页</a>
                </li>
                <li>
                    <a href="#">食品特产</a>
                </li>
                <li>
                    <a href="#">服装城</a>
                </li>
                <li>
                    <a href="#">大家电</a>
                </li>
                <li>
                    <a href="#">鞋靴箱包</a>
                </li>
                <li>
                    <a href="<?php echo url('brand/index'); ?>">品牌专区</a>
                </li>
                <li>
                    <a href="#">聚划算</a>
                </li>
                <li>
                    <a href="#">积分商城</a>
                </li>
                <li>
                    <a href="#">预售</a>
                </li>
                <li>
                    <a href="#">店铺街</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="w1200_container">



















    <div style="margin-top: 20px;float: left;">
        <!--页面必要代码,img标签上请务必带上图片真实尺寸px-->
        <div id="showbox">
            <li class="goods_photo">
                <img src="/uploads/<?php echo htmlentities($info['pic']); ?>" width="280" height="280" />
            </li>
            <li class="goods_photo1">
                    <?php if(is_array($pics) || $pics instanceof \think\Collection || $pics instanceof \think\Paginator): $i = 0; $__LIST__ = $pics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <img src="/uploads/<?php echo htmlentities($vo['pic']); ?>" width="280" height="280" />
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </li>
        </div>
        <!--展示图片盒子-->
        <div id="showsum"></div>
        <!--展示图片里边-->
        <p class="showpage">
            <a href="javascript:void(0);" id="showlast">
                < </a>
            <a href="javascript:void(0);" id="shownext"> > </a>
        </p>
    </div>
    <div class="pay_content fl">
        <div class="pay_title"><?php echo htmlentities($info['content']); ?></div>
        <div class="summary">
            <div class="summary_price_warp">
                <div class="s_p_w_wrap">
                    <div class="summary_item si_shop_price">
                        <div class="si_tit">商 城 价</div>
                        <div class="si_warp">
                            <strong class="shop_price"><em>¥</em><?php echo htmlentities($info['price']); ?></strong>
                            <span class="price_notify" data-userid="63" data-goodsid="650" ectype="priceNotify">降价通知</span>
                        </div>
                    </div>
                    <div class="summary_item si_market_price">
                        <div class="si_tit">市 场 价</div>
                        <div class="si_warp">
                            <div class="m_price"><em>¥</em><?php echo htmlentities($info['price']); ?></div>
                        </div>
                    </div>
                    <div class="si_info">
                        <div class="si_cumulative">累计评价<em>0</em></div>
                        <div class="si_cumulative">累计销量<em>0</em></div>
                    </div>
                    <div class="clear"></div>
                    <div class="summary_basic_info">
                        <div class="summary_item is_stock">
                            <div class="si_tit">配送</div>
                            <div class="si_warp">
										<span class="initial_area">
                                                                                                              上海市
                                        </span>
                                <span>至</span>
                                <div class="city-choice" id="city-choice" data-ectype="dorpdown">
                                    <div class="dsc-choie dsc-cm" ectype="dsc-choie">
                                        <input type="text" value="石家庄" class="search" style="margin: 3px 0 0 0;border: none;background: #f7f8f8;width: 40px;" />
                                    </div>
                                </div>
                                <div class="store_warehouse">
                                    <div class="store_prompt"><strong>有货</strong>，下单后立即发货</div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="summary_item is_service">
                            <div class="si_tit">服务</div>
                            <div class="si_warp">
                                由
                                <a href="" class="link_red" target="_blank">本网站</a> 发货并提供售后服务
                                <span class="gary">[ 快递：<em>¥</em>4.30 ]</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="summary_item is_integral">
                            <div class="si_tit">红包</div>
                            <div class="si_warp">可用 <span class="integral">0</span></div>
                        </div>
                        <div class="summary_item is_number clear">
                            <div class="si_tit">数量</div>
                            <div class="si_warp">
                                <div class="amount_warp">
                                    <input class="text buy_num" value="1" name="number">
                                    <div class="a_btn">
                                        <a href="javascript:void(0);" class="btn_add" ><i class="iconfont icon-up">+</i></a>
                                        <a href="javascript:void(0);" class="btn_reduce btn_disabled" ><i class="iconfont icon-down">-</i></a>
                                    </div>
                                </div>
                                <span>库存&nbsp;<em id="goods_attr_num" ectype="goods_attr_num">1000</em>&nbsp;个</span>
                            </div>
                        </div>
                        <div class="summary_item regular">
                            <div class="si_tit">规格</div>
                            <div class="si_warp">
                                <ul class="regular_list">
                                    <?php if(is_array($sku) || $sku instanceof \think\Collection || $sku instanceof \think\Paginator): $i = 0; $__LIST__ = $sku;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <li> <label for="sku_<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></label>
                                        <input type="radio" name="sku" value="<?php echo htmlentities($vo['id']); ?>" id="sku_<?php echo htmlentities($vo['id']); ?>" onclick="price(<?php echo htmlentities($vo['id']); ?>)"></li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>

                                </ul>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="goods_id" id="goods_id" value="<?php echo htmlentities($info['id']); ?>">
                    <!--class="layui-btn layui-btn-normal"-->
                    <div class="choose_btns clear">
                        <a href="#" class="btn_buynow">立即购买</a>
                        <a href="#" class="btn_append layui-btn layui-btn-danger business" onclick="addToCart()"><i class="iconfont icon_carts"><img src="/static/images/cart1.png" style="margin-top: -5px;"></i>加入购物车</a>
                    </div>
                    <div class="summary_item is_service">
                        <div class="si_tit">温馨提示</div>
                        <div class="si_warp gray">
                            不支持退换货服务
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
























































    <div class="enjoy_title">
        <h3>还没逛够</h3>
    </div>
    <div class="no_enough">
        <ul>
            <li class="opacity_img1">
                <a href="#" target="_blank">
                    <div class="p_img">
                        <img src="/static/images/no_enough1.jpg" />
                    </div>
                    <div class="no_ename" title="【情侣款】Camel骆驼男靴 时尚潮流英伦风马丁靴高帮皮靴 爆卖1万双！ 情侣马丁靴 好评如潮">
                        【情侣款】Camel骆驼男靴 时尚潮流英伦风马丁靴高帮皮靴 爆卖1万双！ 情侣马丁靴 好评如潮
                    </div>
                    <div class="no_eprice">
                        <em>¥</em>555.00
                    </div>
                </a>
            </li>
            <li class="opacity_img1">
                <a href="#" target="_blank">
                    <div class="p_img">
                        <img src="/static/images/no_enough2.jpg" />
                    </div>
                    <div class="no_ename" title="春季马丁靴男真皮男靴黄靴工装军靴韩版短靴沙漠靴高帮男鞋大黄靴 头层牛皮">
                        春季马丁靴男真皮男靴黄靴工装军靴韩版短靴沙漠靴高帮男鞋大黄靴 头层牛皮
                    </div>
                    <div class="no_eprice">
                        <em>¥</em>555.00
                    </div>
                </a>
            </li>
            <li class="opacity_img1">
                <a href="#" target="_blank">
                    <div class="p_img">
                        <img src="/static/images/no_enough3.jpg" />
                    </div>
                    <div class="no_ename" title="特步女鞋2017春季新款运动鞋休闲鞋女慢跑步鞋旅游鞋轻便舒适时尚 早春特惠 爆款休闲女鞋 赠运费险">
                        特步女鞋2017春季新款运动鞋休闲鞋女慢跑步鞋旅游鞋轻便舒适时尚 早春特惠 爆款休闲女鞋 赠运费险
                    </div>
                    <div class="no_eprice">
                        <em>¥</em>555.00
                    </div>
                </a>
            </li>
            <li class="opacity_img1">
                <a href="#" target="_blank">
                    <div class="p_img">
                        <img src="/static/images/no_enough4.jpg" />
                    </div>
                    <div class="no_ename" title="新款韩版chic学生宽松短款外套上衣字母长袖连帽套头卫衣女潮">
                        新款韩版chic学生宽松短款外套上衣字母长袖连帽套头卫衣女潮
                    </div>
                    <div class="no_eprice">
                        <em>¥</em>555.00
                    </div>
                </a>
            </li>
            <li class="opacity_img1">
                <a href="#" target="_blank">
                    <div class="p_img">
                        <img src="/static/images/no_enough5.jpg" />
                    </div>
                    <div class="no_ename" title="igtt铝框行李箱拉杆箱旅行箱万向轮男女20/24/26寸密码箱登机箱子 铝合金框 加强密码锁 万向轮 终身保修">
                        igtt铝框行李箱拉杆箱旅行箱万向轮男女20/24/26寸密码箱登机箱子 铝合金框 加强密码锁 万向轮 终身保修
                    </div>
                    <div class="no_eprice">
                        <em>¥</em>555.00
                    </div>
                </a>
            </li>

        </ul>
    </div>
</div>


























<div class="clear"></div>
<div class="footer_con">
    <div class="fnc_container">
        <div class="help-list">
            <div class="help-item">
                <h3>新手上路 </h3>
                <ul>
                    <li>
                        <a href="#" title="售后流程" target="_blank">售后流程</a>
                    </li>
                    <li>
                        <a href="#" title="购物流程" target="_blank">购物流程</a>
                    </li>
                    <li>
                        <a href="#" title="订购方式" target="_blank">订购方式</a>
                    </li>
                </ul>

            </div>
            <div class="help-item">
                <h3>配送与支付 </h3>
                <ul>
                    <li>
                        <a href="#" title="货到付款区域" target="_blank">货到付款区域</a>
                    </li>
                    <li>
                        <a href="#" title="配送支付智能查询 " target="_blank">配送支付智能查询</a>
                    </li>
                    <li>
                        <a href="#" title="支付方式说明" target="_blank">支付方式说明</a>
                    </li>
                </ul>

            </div>
            <div class="help-item">
                <h3>会员中心</h3>
                <ul>
                    <li>
                        <a href="#" title="资金管理" target="_blank">资金管理</a>
                    </li>
                    <li>
                        <a href="#" title="我的收藏" target="_blank">我的收藏</a>
                    </li>
                    <li>
                        <a href="<?php echo url('flow/index'); ?>" title="我的订单" target="_blank">我的订单</a>
                    </li>
                </ul>

            </div>
            <div class="help-item">
                <h3>服务保证 </h3>
                <ul>
                    <li>
                        <a href="#" title="退换货原则" target="_blank">退换货原则</a>
                    </li>
                    <li>
                        <a href="#" title="售后服务保证" target="_blank">售后服务保证</a>
                    </li>
                    <li>
                        <a href="#" title="产品质量保证 " target="_blank">产品质量保证</a>
                    </li>
                </ul>

            </div>
            <div class="help-item">
                <h3>联系我们 </h3>
                <ul>
                    <li>
                        <a href="#" title="网站故障报告" target="_blank">网站故障报告</a>
                    </li>
                    <li>
                        <a href="#" title="选机咨询 " target="_blank">选机咨询</a>
                    </li>
                    <li>
                        <a href="#" title="投诉与建议 " target="_blank">投诉与建议</a>
                    </li>
                </ul>
            </div>
            <div class="help-item">
                <h3>关注我们 </h3>
                <img src='/static/images/erweima.png' />
            </div>
        </div>
    </div>
</div>
<!--右侧红包栏-->
<div class="bk_foot_redbag">
    <a href="#" id="red_bag">
        <img src="/static/images/red_package.png" width="100%" alt="">
    </a>
    <span class="closehd"></span>
</div>
<div class="red_bag">
    <span class="hide font"><label for="">100</label>元红包砸中了您</span><br />
    <button class="hide font" id="ensure">确定</button>
</div>
</body>
<script type="text/javascript" src="/static/js/kuCity.js"></script>
<script type="text/javascript" src="/static/js/jquery.SuperSlide.js"></script>
<script>
    $('.li_dorpdown').hover(function() {
        $('.dorpdown-layer').show();
    });
    $('.li_dorpdown').mouseleave(function() {
        $('.dorpdown-layer').hide();
    });
    $('.icon-close').click(function() {
        $('.top_banner').hide();
    });
    $('.cate-layer-right-slide img').mouseenter(function() {

        $(this).delay('300').animate(300);
    });
    $('.cate-layer-right-slide img').mouseleave(function() {
        $(this).css('border', 'none')
    });
    //alert($('.buy_num').val());
    $('.btn_add').click(function(){
        var index=$('.buy_num').val();
        index++;
        $('.buy_num').val(index++);
    });
    $('.regular_list li').click(function(){
        $(this).parent().children('li').removeClass('regular_sort');
        $(this).addClass('regular_sort');
    });
    $('.btn_reduce').click(function(){
        var index=$('.buy_num').val();
        if(index>1){
            index--;
            $('.buy_num').val(index--);
        }
    });
    //		$('.categorys-type').mouseenter(function(){
    //			$('.categorys-tab-content').show();
    //		});
    //		$('.categorys-type').mouseleave(function(){
    //			$('.categorys-tab-content').hide();
    //		});
</script>
<script>
    $('.search').kuCity();
</script>
<!--滚动展示-->
<script type="text/javascript">
    $(".closehd").click(function() { //右下角红包图标点击变小
        $(this).hide();
        $('.bk_foot_redbag a').animate({
            width: '80px',
            height: '100px'
        });
    });
    $('#red_bag').click(function() {
        $(this).hide();
        $('.closehd').hide();
        $('.font').show();
        $('.font').css('display', 'inline-block')
        $('.red_bag').animate({
            width: '400px',
            height: '300px'
        });
    });
    $('#ensure').click(function() {
        $('.red_bag').fadeOut();
    });
</script>
<script>
    layui.use(['layer','jquery'], function() { //独立版的layer无需执行这一句
        var $ = layui.jquery,
            layer = layui.layer; //独立版的layer无需执行这一句

        //触发事件
        var active = {
            setTop: function() {
                var that = this;
                //多窗口模式，层叠置顶
                layer.open({
                    type: 2 //此处以iframe举例
                    ,
                    title: '温馨提示',
                    area: ['390px', '260px'],
                    shade: 0,
                    maxmin: true,
                    offset: [ //为了演示，随机坐标
                        Math.random() * ($(window).height() - 300), Math.random() * ($(window).width() - 390)
                    ],
                    content: '添加成功！',
                    btn: ['继续购物'],
                    btn2: function() {
                        layer.closeAll();
                    },
                    zIndex: layer.zIndex,
                    success: function(layero) {
                        layer.setTop(layero); //重点2
                    }
                });
            },
            confirmTrans: function() {
                //配置一个透明的询问框
                layer.msg('大部分参数都是可以公用的<br>合理搭配，展示不一样的风格', {
                    time: 20000, //20s后自动关闭
                    btn: ['明白了', '知道了', '哦']
                });
            },
            notice: function() {
                //示范一个公告层
                layer.open({
                    type: 1,
                    title: false //不显示标题栏
                    ,
                    closeBtn: false,
                    area: '300px;',
                    shade: 0.8,
                    id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,
                    btn: ['火速围观', '残忍拒绝'],
                    btnAlign: 'c',
                    moveType: 1 //拖拽模式，0或者1
                    ,
                    content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">你知道吗？亲！<br>layer ≠ layui<br><br>layer只是作为Layui的一个弹层模块，由于其用户基数较大，所以常常会有人以为layui是layerui<br><br>layer虽然已被 Layui 收编为内置的弹层模块，但仍然会作为一个独立组件全力维护、升级。<br><br>我们此后的征途是星辰大海 ^_^</div>',
                    success: function(layero) {
                        var btn = layero.find('.layui-layer-btn');
                        btn.find('.layui-layer-btn0').attr({
                            href: 'http://www.layui.com/',
                            target: '_blank'
                        });
                    }
                });
            }
        };

        $('.business').on('click', function() {
            var othis = $(this),
                method = othis.data('method');
            active[method] ? active[method].call(this, othis) : '';
        });
    });
</script>
<script>
    function price(id)
    {
        $.ajax({
            'url':"<?php echo url('flow/price'); ?>",
            'type':'post',
            'data':{'id':id},
            'dataType':'json',
            success:function(res){
                if(res.code == 0)
                {
                    layer.msg(res.msg);
                    $('.m_price').html("<em>¥</em>"+res.price*Math.ceil(Math.random())*1.75);
                    $('.shop_price').html("<em>¥</em>"+res.price);
                    $('#goods_attr_num').html(res.num);
                }
            }
        })
    }

    function addToCart() {
        var goods_num = $("input[name='number']").val();
        var goods_id = $('#goods_id').val();
        var goods_sku = $(".regular_sort input").val();
        $.ajax({
            'url':"<?php echo url('flow/addToCart'); ?>",
            'type':'post',
            'data':{'num':goods_num,'id':goods_id,'sku':goods_sku},
            'dataType':'json',
            success:function(res){
                if(res.code == 0)
                {
                    layer.msg(res.msg);
                }
                else
                {
                    layer.msg(res.msg);
                }
            }
        })
    }
</script>
</html>