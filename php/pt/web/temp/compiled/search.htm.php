<!DOCTYPE html>
<html id="aos">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Cache-Control" content="no-cache,no-store,must-revalidate"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<title><?php echo $this->_var['page_title']; ?></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo $this->_var['template_path']; ?>css/common.css?v=<?php echo $this->_var['aos_version']; ?>" rel="stylesheet" />
<link href="<?php echo $this->_var['template_path']; ?>css/goods.css?v=<?php echo $this->_var['aos_version']; ?>" rel="stylesheet" />
<script src="<?php echo $this->_var['template_path']; ?>js/jquery.min.js?v=<?php echo $this->_var['aos_version']; ?>"></script>
<script src="<?php echo $this->_var['template_path']; ?>js/common.js?v=<?php echo $this->_var['aos_version']; ?>"></script>
<script src="<?php echo $this->_var['template_path']; ?>js/dropload.min.js?v=<?php echo $this->_var['aos_version']; ?>"></script>
<script src="<?php echo $this->_var['template_path']; ?>js/jquery.lazyload.js?v=<?php echo $this->_var['aos_version']; ?>"></script>
</head>
<body>
<?php echo $this->fetch('inc/header.htm'); ?>
<section id="container" class="container pdb" style="display:none">
    <div class="search-top">
        <div class="form" onclick="search()">
            <i class="search-icon"></i>
            <input type="hidden" name="c" value="search">
            <input type="text" name="key" id="key" value="<?php echo $this->_var['key']; ?>" class="key" placeholder="输入商品名称">
            <i class="search-clear"></i>
        </div>
        <a href="index.php" class="cancel-view">取消</a>
    </div>
    <div class="tuan-list">
        <ul class="J_search_list">
        </ul>
    </div>
    <?php echo $this->fetch('inc/searchbar.htm'); ?>
</section>
<?php echo $this->fetch('inc/footer.htm'); ?>
<script>
window.onload = function() {
  $('#loading').css('display','none'); 
  $('#container').css('display','');
  changes();
}
function search()
{
    $(".search-view").toggle();
}
</script>
<script>
$(function(){
    
    var tab1LoadEnd = false;
    var num = 0;
    var page= 0;
    var dropload = $('.container').dropload({
    scrollArea : window,
    loadDownFn : function(me){
        // 加载菜单一的数据
            page++;
            var counter = page,last = num,amount = 8;
            var key = $('#key').val();
            $.ajax({
                type: 'POST',
                data: {last,amount,page,key},
                url: 'index.php?c=search&a=ajax_goods',
                dataType: 'json',
                success: function(data){
                    var result = '';
                    num = amount * counter;
                    last = num;
                    if(typeof(data.info)!="undefined"){
                          for(i = 0; i < data.info.length; i++){
                              result +=data.info[i];
                          }
                        }
                    // 为了测试，延迟1秒加载
                    setTimeout(function(){
                        $('.J_search_list').append(result);
                        $("img.lazy_"+page).lazyload({effect: "fadeIn"});
                        if(last >= data.count){
                            // 数据加载完
                            tab1LoadEnd = true;
                            // 锁定
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        // 每次数据加载完，必须重置
                        me.resetload();
                    },1);

                },
                error: function(xhr, type){
                    layer.open({content: 'Ajax error!',skin: 'msg',time: 2});
					//window.location.reload();
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        }
    })
})

</script>
<?php echo $this->fetch('inc/wx_config.htm'); ?>
<?php if ($this->_var['stats_code']): ?><?php echo $this->_var['stats_code']; ?><?php endif; ?>
</body>
</html>