<!DOCTYPE html>
<html id="aos">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Cache-Control" content="no-cache,no-store,must-revalidate"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<title>用户中心</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo $this->_var['template_path']; ?>css/common.css?v=<?php echo $this->_var['aos_version']; ?>" rel="stylesheet" />
<link href="<?php echo $this->_var['template_path']; ?>css/user.css?v=<?php echo $this->_var['aos_version']; ?>" rel="stylesheet" />
<script src="<?php echo $this->_var['template_path']; ?>js/jquery.min.js?v=<?php echo $this->_var['aos_version']; ?>"></script>
<script src="<?php echo $this->_var['template_path']; ?>js/common.js?v=<?php echo $this->_var['aos_version']; ?>"></script>
</head>
<body id="user">
<?php echo $this->fetch('inc/header.htm'); ?>
<section id="container" class="container pdb" style="display:none">
    <div class="my_head">
        <dl>
            <dt><img src="<?php if ($this->_var['info']['headimgurl']): ?><?php echo $this->_var['info']['headimgurl']; ?><?php else: ?><?php echo $this->_var['template_path']; ?>images/avatar.png<?php endif; ?>"></dt>
            <dd>
                <h3><?php echo $this->_var['info']['nickname']; ?><i class="iconfont icon-level-<?php echo $this->_var['rank']['rank_id']; ?>"></i></h3>
                <p><a href="index.php?c=user&a=rank">升级至V<?php echo $this->_var['rank']['next_rank']; ?>还需<?php echo $this->_var['rank']['cha_point']; ?><?php echo $this->_var['points_name']; ?></a></p>
            </dd>
        </dl>
        <a href="index.php?c=user&a=profile" class="my_head_edit"><i class="iconfont">&#xe612;</i></a>
    </div>
	<div class="my_wallet">
	    <ul>
		    <li><a class="s1" href="index.php?c=user&a=account_detail"><?php echo $this->_var['info']['user_money']; ?></a></li>
			<li><a class="s2" href="index.php?c=user&a=bonus"><?php echo $this->_var['num']['bonus']; ?></a></li>
			<li><a class="s3" href="index.php?c=user&a=integral"><?php echo $this->_var['info']['pay_points']; ?></a></li>
		</ul>
	</div>
	<div class="nav">
        <div class="nav_order">
            <div class="nav_item_order_hd">
			    <a href="index.php?c=user&a=order_list">
                <div class="nav_item_order">我的订单</div>
                <div class="nav_item_order_bd">查看全部订单</div>
				</a>
            </div>
            <div class="nav_item_bd">
                <a href="index.php?c=user&a=order_list&default=1">
                    <i class="iconfont">&#xe619;</i>
                    <span>待付款</span>
                    <?php if ($this->_var['num']['await_pay']): ?><em><?php echo $this->_var['num']['await_pay']; ?></em><?php endif; ?>
                </a>
                <a href="index.php?c=user&a=order_list&default=2">
                    <i class="iconfont">&#xe6fc;</i>
                    <span>待成团</span>
                    <?php if ($this->_var['num']['await_tuan']): ?><em><?php echo $this->_var['num']['await_tuan']; ?></em><?php endif; ?>
                </a>
                <a href="index.php?c=user&a=order_list&default=3">
                    <i class="iconfont">&#xe615;</i>
                    <span>待核销</span>
                    <?php if ($this->_var['num']['await_veri']): ?><em><?php echo $this->_var['num']['await_veri']; ?></em><?php endif; ?>
                </a>
                <a href="index.php?c=user&a=order_list&default=4">
                    <i class="iconfont">&#xe60a;</i>
                    <span>待发货</span>
                    <?php if ($this->_var['num']['await_ship']): ?><em><?php echo $this->_var['num']['await_ship']; ?></em><?php endif; ?>
                </a>
                <a href="index.php?c=user&a=order_list&default=5">
                    <i class="iconfont">&#xe61f;</i>
                    <span>待收货</span>
                    <?php if ($this->_var['num']['await_receipt']): ?><em><?php echo $this->_var['num']['await_receipt']; ?></em><?php endif; ?>
                </a>
                <a href="index.php?c=user&a=order_list&default=6">
                    <i class="iconfont">&#xe6b7;</i>
                    <span>待评价</span>
                    <?php if ($this->_var['num']['await_comment']): ?><em><?php echo $this->_var['num']['await_comment']; ?></em><?php endif; ?>
                </a>
            </div>
        </div>
    </div>
	
	<div class="nav">
        <ul class="nav_list">
            <li>
                <a href="index.php?c=user&a=tuan_list">
                    <i class="iconfont">&#xe6e7;</i>
                    <p>我的拼团</p>
                </a>
            </li>

            <li>
                <a href="index.php?c=user&a=lottery_list">
                    <i class="iconfont">&#xe6b8;</i>
                    <p>我的抽奖</p>
                </a>
            </li>
            <!--li>
                <a href="index.php?c=user&a=bonus">
                    <i class="iconfont">&#xe625;</i>
                    <p>我的优惠券</p>
                    <?php if ($this->_var['num']['bonus']): ?>
                    <em><?php echo $this->_var['num']['bonus']; ?></em>
                    <?php endif; ?>
                </a>
            </li-->
            <li>
				<a href="index.php?c=user&a=collection_list">
                    <i class="iconfont">&#xe70a;</i>
                    <p>我的收藏</p>
				</a>
            </li>
            <li>
				<a href="index.php?c=user&a=address_list">
                    <i class="iconfont">&#xe66d;</i>
                    <p>收货地址</p>
				</a>
            </li>
            <li>
				<a href="index.php?c=exchange">
                    <i class="iconfont">&#xe60c;</i>
                    <p>积分商城</p>
				</a>
            </li>
            <li>
                <a href="index.php?c=user&a=comment_list">
                    <i class="iconfont">&#xe6b7;</i>
                    <p>我的评论</p>
                </a>
            </li>
            <!--li>
                <a href="index.php?c=user&a=refund_list">
                    <i class="iconfont">&#xe621;</i>
                    <p>退款售后</p>
                </a>
            </li-->
            <li>
                <a href="index.php?c=faq&a=list">
                    <i class="iconfont">&#xe602;</i>
                    <p>常见问题</p>
                </a>
            </li>
            <li>
                <a href="index.php?c=dist">
                    <i class="iconfont">&#xe602;</i>
                    <p>推广中心</p>
                </a>
            </li>
            <?php if ($this->_var['wxuser']): ?>
            <li>
                <a href="index.php?c=user&a=veri">
                    <i class="iconfont">&#xe615;</i>
                    <p>我的核销</p>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    <?php echo $this->fetch('inc/footer.htm'); ?> 
</section>		  
</body>
</html>
