(function($){
$.fn.aotime=function(){
	var data="";
	var _DOM=null;
	var TIMER;
	createdom =function(dom){
		_DOM=dom;
		data=$(dom).attr("data");
		data = data.replace(/-/g,"/");
		data = Math.round((new Date(data)).getTime()/1000);
		$(_DOM).append("<em class='J_hour'></em>:<em class='J_minute'></em>:<em class='J_second'></em>")
		reflash();
	};
	reflash=function(){
		var	range  	= data-Math.round((new Date()).getTime()/1000),
			  sechour = 3600,
				hours	= parseInt(range/sechour),
				min		= parseInt((range%sechour)/60),
				sec		= (range%sechour)%60;
		if(range>0){			
			$(_DOM).find(".J_hour").html(nol(hours));
			$(_DOM).find(".J_minute").html(nol(min));
			$(_DOM).find(".J_second").html(nol(sec));
		}else{
			changeAuto();
			window.location.reload();
		}
	};
	TIMER = setInterval( reflash,1000 );
	nol = function(h){
		return h>9?h:'0'+h;
	}
	return this.each(function(){
		var $box = $(this);
		createdom($box);
	});
}
})(jQuery);
$(function(){
	$(".aotime").each(function(){
		$(this).aotime();
	});
});