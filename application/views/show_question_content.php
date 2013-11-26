<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo base_url();?>statics/css/style.css" rel="stylesheet" media="screen" type="text/css" />
		<script charset="utf-8" src="<?php echo base_url()?>extension/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="<?php echo base_url()?>extension/kindeditor/lang/en.js"></script>
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
		<div style="width:800px; height:auto;padding:10px;background:#fff;padding:10px;text-align:left;margin:0 auto;border:1px solid #4d98e5;">
			<?php

			echo $question_content;

			?>
		</div>
		<br />
		
			<?php

			if(isset($message)){echo "<b>".$message."</b>";}
			else {
				$num = 1;
				foreach($show_answer as $answer)
				{
					echo "<div style='width:800px;padding:10px;height:auto;background:#fff;padding:10px;text-align:left;margin:0 auto;border:1px solid #4d98e5;'>";
					echo "<b>#".$num."&nbsp;&nbsp;&nbsp;".$answer['username']."</b> <font style='font-size:10px;'>".$answer['add_time']."</font><br />";
					echo "<p>".$answer['answer_content']."</p><br />";
					$num++;
					echo "</div>";
				}
			}

			?>
		<br />

		<?php if ($this->session->userdata('is_logged_in'))
		{ ?>
			<div style="width:820px;height:40px;text-align:left;margin:0 auto;" class="divheader">
			<div style="margin:10px;text-weight:bold;"><b>Your Answer:</b></div>
			</div>
			<div style="width:800px;background:#fff;height:auto;padding:10px;text-align:center;margin:0 auto;border:1px solid #4d98e5;">
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
    <?php $this->load->view('footer');?> 
	<script language="javascript">

var index = 0;    //�ؼ����б�������
var count = 0;    //�ؼ����б�����
function showKeywordsList(){    //��ʾ�ؼ��������б�
    var keycode = event.keyCode;        //�û�������ASCII��
    if(keycode != 40 && keycode != 38){      //����������Ϻ����·����
        index = 0;                        //�ؼ���������0
        if($("#keywords").val() == "" || $.trim($("#keywords").val()) == ""){
            $("#searchLayer").css("display", "none");   //����û�������ַ���ո������������б�
        }else{
            //$("#searchLayer").css("display", "block");
			setTimeout("reSearch()", 150);    //����ÿ��150�������һ��reSearch()����
        } 
    }
}
/*
function reSearch(){
	var keyword = $("#keywords").attr("value");
	//alert(keyword);
    if($("#keywords").val() != ""){                       //����û�¼��Ĺؼ��ֲ�Ϊ��
        $.get("<?php //echo base_url();?>main/list_keywords?keyword="+keyword, null, function(data){
                                                          //ͨ��jQuery�����������GET����
            if($.trim(data) == ""){                       //�����������Ϊ�գ������������б��
                $("#searchLayer").css("display", "none");
            }else{
                $("#searchLayer").html(data);             //����������ݲ�Ϊ������ʾ�����б�
                $("#searchLayer").css("display", "block");
            	count = parseInt($("#totalList").val());   //��ȡ�б��йؼ��ָ���
            }
        });
    }
}  
        
        
function selectList(){
    var keycode = event.keyCode;                   //��ȡ�û�¼���ַ���ASCII
    if(keycode == 40){                             //����û������·����
    	$("#listItem_"+index).css("background-color", "#158CD0");  //���ĵ�ǰ��ѡ��ı���ɫ
    	$("#listItem_"+index).css("color", "#FFFFFF");             //���ĵ�ǰ��ѡ���ǰ��ɫ
    	$("#keywords").val($.trim($("#listItem_li_"+index).html())); //����ǰ��ѡ����ʾ���ı�����
    	if(index > 0){                   
    	    $("#listItem_"+parseInt(index-1)).css("background-color", "#FFFFFF");   //���ĵ�ǰ��ǰһ��ı���ɫ
    	    $("#listItem_"+parseInt(index-1)).css("color", "#333333");            //���ĵ�ǰ��ǰһ���ǰ��ɫ
        }
        if(index < count-1){            //�����ǰ����С���ܹؼ�������1
    	    index++;                  //��������1
        }
    }else if(keycode == 38){   //����û������Ϸ����
    	if(index > 0){             //�����������0
        	$("#listItem_"+parseInt(index-1)).css("background-color", "#158CD0");   //���ĵ�ǰ��ǰһ���ɫ
        	$("#listItem_"+parseInt(index-1)).css("color", "#FFFFFF");          //���ĵ�ǰ��Ǯһ��ǰ��ɫ
        	$("#keywords").val($.trim($("#listItem_li_"+parseInt(index-1)).html()));       //����ǰ��ѡ����ʾ���ı����� 
    	}
	    $("#listItem_"+index).css("background-color", "#FFFFFF");       //���� ��ǰ���ɫ 
	    $("#listItem_"+index).css("color", "#333333");                   //���ĵ�ǰ��ǰ��ɫ
        if(index > 1){                                                     //�����������1
    	    index--;                                                     //������1
        }
    }
}*/
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
		/*	var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="answer"]', {
					cssPath : '<?php echo base_url();?>extension/kindeditor/themes/simple/simple.css',
					filterMode : true,
					resizeType : 2,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
			});*/

  
    </script> 
</body>
</html>