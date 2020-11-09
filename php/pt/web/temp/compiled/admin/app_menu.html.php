<?php echo $this->fetch('header.htm'); ?>
<div class="main">
  <div class="col_side">
    <?php echo $this->fetch('side_menu.htm'); ?>
  </div>
  <div class="col_main">
    <div class="main_hd">
      <h2>菜单管理</h2>
    </div>
    <div class="main_bd">
      <table class="table">
        <thead>
        <tr>
          <th>ID</th>
          <th>名称</th>
          <th>图标</th>
          <th>链接</th>
          <th>排序</th>
          <th>启用</th>
        </tr>
        </thead>
        <tbody>
        <form name="theForm" action="index.php?act=app&op=app_menu" method="post" enctype="multipart/form-data">
        <?php $_from = $this->_var['menu_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'menu');$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from AS $this->_var['menu']):
        $this->_foreach['menu']['iteration']++;
?>
        <tr>
          <td><?php echo $this->_var['menu']['menu_id']; ?><input type="hidden" name="menu_id[]" value="<?php echo $this->_var['menu']['menu_id']; ?>"/></td>
          <td><input name="menu_name[]" type="text" value="<?php echo $this->_var['menu']['menu_name']; ?>" size="10" /></td>
          <td>
            <div class="upimg skuimg">
              <input name="menu_img[]" type="file" id="up_img_<?php echo ($this->_foreach['menu']['iteration'] - 1); ?>" />
              <img src="<?php if ($this->_var['menu']['menu_img']): ?>../<?php echo $this->_var['menu']['menu_img']; ?><?php else: ?>static/images/preview.png<?php endif; ?>" id="show_img_<?php echo ($this->_foreach['menu']['iteration'] - 1); ?>"/>
              <span></span>
              <i class="fa fa-edit"></i>
            </div>
          </td>
          <td><input name="menu_url[]" type="text" value="<?php echo $this->_var['menu']['menu_url']; ?>" size="40" /></td>
          <td><input name="sort_order[]" type="text" value="<?php echo $this->_var['menu']['sort_order']; ?>" size="5" /></td>
          <td class="binding" width="50">
            <span><i class="fa <?php if ($this->_var['menu']['enabled']): ?>fa-toggle-on<?php else: ?>fa-toggle-off<?php endif; ?>" onclick="toggle(this, 'toggle_enabled', <?php echo $this->_var['menu']['menu_id']; ?>)"></i></span>
          </td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <tr>
          <td colspan="6">新增一个</td>
        </tr>
        <tr>
          <td><input type="hidden" name="menu_id[]" value=""/></td>
          <td><input name="menu_name[]" type="text" value="" size="10"/></td>
          <td></td>
          <td><input name="menu_url[]" type="text" value="" size="40"/></td>
          <td><input name="sort_order[]" type="text" value="10" size="5" /></td>
          <td></td>
        </tr>
        <tr class="tfoot">
          <td colspan="6"><input name="submit" type="submit" value="修改" class="btn" /></td>
        </tr>
        </form>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="static/js/uploadPreview.js"></script>
<script language="JavaScript">
$(function(){
  var menu_num = $(".skuimg").length;
  for(var i=0; i<menu_num;i++){
    new uploadPreview({UpBtn: "up_img_"+i, ImgShow: "show_img_"+i}); 
  }
})

$(function(){
  var delParent;
  var defaults = {
    fileType:["jpg","png","jpeg"],   // 上传文件的类型
    fileSize:1024 * 1024 * 1  // 上传文件的大小 1M
  };
  /*点击图片的文本框*/
  $(".file").change(function(){  
    var idFile = $(this).attr("id");
    var itemIndex = $(this).index();
    var file = document.getElementById(idFile);
    var uplist = $(this).parents(".uplist"); //存放图片的父亲元素
    var fileList = file.files; //获取的图片文件
    var input = $(this).parent();//文本框的父亲元素
    var imgArr = [];

    fileList = validateUp(fileList);
    for(var i = 0;i<fileList.length;i++){
      var imgUrl = window.URL.createObjectURL(fileList[i]);
        imgArr.push(imgUrl);
      var $upimg = $("<li class='upimg loading'><span class='opcity'></span>");
        uplist.prepend($upimg);
      var $close = $("<a href='javascript:;' class='up-close' title='删除'>").on("click",function(event){
        delParent = $(this).parent();
        delParent.remove(); 
      });   
      $close.appendTo($upimg);
      var $trash = $("<i class='fa fa-trash'>");
      $trash.appendTo($close);
      var $img = $("<img class='up-img up-opcity'>");
      $img.attr("src",imgArr[i]);
      $img.appendTo($upimg);
    }

    setTimeout(function(){
      $(".upimg").removeClass("loading");
      $(".up-img").removeClass("up-opcity");
    },450);
  });

  function validateUp(files){
    var arrFiles = [];//替换的文件数组
    for(var i = 0, file; file = files[i]; i++){
      //获取文件上传的后缀名
      var newStr = file.name.split("").reverse().join("");
      if(newStr.split(".")[0] != null){
          var type = newStr.split(".")[0].split("").reverse().join("");
          console.log(type+"===type===");
          if(jQuery.inArray(type, defaults.fileType) > -1){
            // 类型符合，可以上传
            if (file.size >= defaults.fileSize) {
              alert(file.size);
              alert('您这个"'+ file.name +'"文件大小过大');  
            } else {
              // 在这里需要判断当前所有文件中
              arrFiles.push(file);  
            }
          }else{
            alert('您这个"'+ file.name +'"上传类型不符合'); 
          }
        }else{
          alert('您这个"'+ file.name +'"没有类型, 无法识别');  
        }
    }
    return arrFiles;
  }

})
</script>
<?php echo $this->fetch('footer.htm'); ?>