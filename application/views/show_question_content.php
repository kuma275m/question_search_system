<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo base_url();?>statics/css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url();?>extension/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
	<title><?php echo $question_title;?></title>
</head>
<body>
<?php $this->load->view('header');?>
	<div id="container">
		<div class="span20"></div>
			<div style="width:100%;height;auto;margin-left:10px;text-align:center;">
					<h1>TECHNIQUE QUESTION SEARCH</h1>
			<div style="width:480px;margin:0 auto;border-bottom:1px solid #ffffff;">
				<div class='navigation_tag navigation_active' id="ALL"><a href="#" onclick="activeTag('ALL','')" >ALL</a></div>
			<?php 
				foreach ($category as $row)
					{?>
						<div class='navigation_tag' id="<?php echo $row['category_name'];?>"><a href="#" onclick="activeTag('<?php echo $row['category_name'];?>','<?php echo $row['id'];?>')" ><?php echo $row['category_name'];?></a></div>
			<?php 		}
			?>
			</div>
			<form action="<?php echo base_url()."main/search" ?>" method="post" accept-charset="utf-8" id="search" autocomplete="off" onsubmit="return chkinput(this)">
				<input type="text" name="keywords" value="" id="keywords" onkeyup="showKeywordsList()" onkeydown="selectList()" />
				<input type="hidden" name="category" value="" id="category" />
				<input type="submit" name="search" value="Search" />
				<div id="searchLayer" style="display:none;margin-left:55px;width:415px;z-index:1;min-height:50px;height:auto;background:#f1f3f5;"></div>
			</form>
		</div>
		<div class="span60"></div>
		<div style="width:820px;height:40px;text-align:left;margin:0 auto;" class="divheader">
			<div style="margin:10px;text-weight:bold;"><b><?php echo $question_title;?></b>    <font style="font-size:10px;"><?php echo $add_time;?></font></div>
		</div>
		<div style="width:800px; height:auto;padding:10px;text-align:left;margin:0 auto;border:1px solid #4d98e5;">
			<?php

			echo $question_content;

			?>
		</div>
		<br />
		<div style="width:800px; height:auto;padding:10px;text-align:left;margin:0 auto;border:1px solid #4d98e5;">
			<?php

			if(isset($message)){echo "<b>".$message."</b>";}
			else {
				$num = 1;
				foreach($show_answer as $answer)
				{
					echo "<b>#".$num."&nbsp;&nbsp;&nbsp;".$answer['username']."(".$answer['add_time']."):</b><br />";
					echo "<p style='border-bottom:1px dashed #4d98e5;'>".$answer['answer_content']."</p><br />";
					$num++;
				}
			}

			?>
		</div>
		<br />

		<?php if ($this->session->userdata('is_logged_in'))
		{ ?>
			<div style="width:820px;height:40px;text-align:left;margin:0 auto;" class="divheader">
			<div style="margin:10px;text-weight:bold;"><b>Your Answer:</b></div>
			</div>
			<div style="width:800px; height:auto;padding:10px;text-align:left;margin:0 auto;border:1px solid #4d98e5;">
			<form action="<?php echo base_url()."answerController/reply_question" ?>" method="post" accept-charset="utf-8" id="search" autocomplete="off" onsubmit="return check(this)">
				<textarea name="answer" id="answer" style="padding:10px;" /></textarea>
				<input type="hidden" name="question_id" value="<?php echo $question_id;?>" id="question_id" />
				<input type="hidden" name="category_id" value="<?php echo $category_id;?>" id="category_id" />
				<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('username');?>" id="user_id" />
				<br />
				<input type="submit" name="reply" value="Reply" />
			</form>
			</div>
			<br />
		<?php }
		?>

	</div>
	<script language="javascript">

var index = 0;    //关键字列表项索引
var count = 0;    //关键字列表总数
function showKeywordsList(){    //显示关键字下拉列表
    var keycode = event.keyCode;        //用户按键的ASCII码
    if(keycode != 40 && keycode != 38){      //如果不是向上和向下方向键
        index = 0;                        //关键字索引归0
        if($("#keywords").val() == "" || $.trim($("#keywords").val()) == ""){
            $("#searchLayer").css("display", "none");   //如果用户输入空字符或空格则隐藏下拉列表
        }else{
            //$("#searchLayer").css("display", "block");
			setTimeout("reSearch()", 150);    //否则每隔150毫秒调用一次reSearch()方法
        } 
    }
}

function reSearch(){
	var keyword = $("#keywords").attr("value");
	//alert(keyword);
    if($("#keywords").val() != ""){                       //如果用户录入的关键字不为空
        $.get("<?php echo base_url();?>main/list_keywords?keyword="+keyword, null, function(data){
                                                          //通过jQuery向服务器发送GET请求
            if($.trim(data) == ""){                       //如果返回数据为空，则隐藏下拉列表层
                $("#searchLayer").css("display", "none");
            }else{
                $("#searchLayer").html(data);             //如果返回数据不为空则显示下拉列表
                $("#searchLayer").css("display", "block");
            	count = parseInt($("#totalList").val());   //获取列表中关键字个数
            }
        });
    }
}  
        
        
function selectList(){
    var keycode = event.keyCode;                   //获取用户录入字符的ASCII
    if(keycode == 40){                             //如果用户按向下方向键
    	$("#listItem_"+index).css("background-color", "#158CD0");  //更改当前所选项的背景色
    	$("#listItem_"+index).css("color", "#FFFFFF");             //更改当前所选项的前景色
    	$("#keywords").val($.trim($("#listItem_li_"+index).html())); //将当前所选项显示在文本框中
    	if(index > 0){                   
    	    $("#listItem_"+parseInt(index-1)).css("background-color", "#FFFFFF");   //更改当前项前一项的背景色
    	    $("#listItem_"+parseInt(index-1)).css("color", "#333333");            //更改当前项前一项的前景色
        }
        if(index < count-1){            //如果当前索引小于总关键字数减1
    	    index++;                  //索引数增1
        }
    }else if(keycode == 38){   //如果用户按向上方向键
    	if(index > 0){             //如果索引大于0
        	$("#listItem_"+parseInt(index-1)).css("background-color", "#158CD0");   //更改当前项前一项背景色
        	$("#listItem_"+parseInt(index-1)).css("color", "#FFFFFF");          //更改当前项钱一项前景色
        	$("#keywords").val($.trim($("#listItem_li_"+parseInt(index-1)).html()));       //将当前所选项显示在文本框中 
    	}
	    $("#listItem_"+index).css("background-color", "#FFFFFF");       //更改 当前项背景色 
	    $("#listItem_"+index).css("color", "#333333");                   //更改当前项前景色
        if(index > 1){                                                     //如果索引大于1
    	    index--;                                                     //索引减1
        }
    }
}
    function activeTag(tag,id) {
		<?php foreach ($category as $row) {
		?>
			$('#<?php echo $row['category_name'];?>').removeClass("navigation_active");
		<?php
		}?>
		$('#ALL').removeClass("navigation_active");
		$('#'+tag).addClass("navigation_active");
		$('#category').attr("value", id);
	}    
        function setText(x){
             $("#keywords").val(x);
             $("#searchLayer").css("display", "none");
        }
		function check(form) {
		    if($.trim(form.answer.value)==""){
               alert("Please input your answer.");
               form.answer.focus();
               return false;
           } 
           return true;
		}

       function chkinput(form){
           if($.trim(form.keywords.value)==""){
               alert("Please input keyword.");
               form.keywords.focus();
               return false;
           } 
           return true;
       }
   /*CKEDITOR.replace( 'answer', {

   filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

   filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',

   filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',

   filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

   filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

   filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

   });*/

  
    </script> 
</body>
</html>