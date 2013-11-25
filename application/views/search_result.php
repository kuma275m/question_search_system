<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo base_url();?>statics/css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
	<title>Technique Search Engine</title>
</head>
<body>
<?php $this->load->view('header');?>
	<div id="container">
		<div class="span20"></div>
			<div style="width:100%;height;auto;margin-left:10px;text-align:center;">
			<div style="width:480px;margin:0 auto;border-bottom:1px solid #ffffff;">
				<h1>TECHNIQUE QUESTION SEARCH</h1>
				<div class='navigation_tag navigation_active' id="ALL"><a href="#" onclick="activeTag('ALL','')" >ALL</a></div>
			<?php 
				if(isset($category)){
				foreach ($category as $row)
					{?>
						<div class='navigation_tag' id="<?php echo $row['category_name'];?>"><a href="#" onclick="activeTag('<?php echo $row['category_name'];?>','<?php echo $row['id'];?>')" ><?php echo $row['category_name'];?></a></div>
			<?php 		}}
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
		<div style="width:600px;height;auto;margin:0 auto;text-align:justfiy;">
		<div class="span20"></div>
		<?php
			if($sum != 0) {
			foreach($list as $row) {
			?>
				<div style="padding:5px;border-bottom:1px dashed #4d98e5;">
				<div class="span20"></div>
				<a style="font-size:20px;" href="<?php echo base_url();?>questionController/show_question/<?php echo $row['id'];?>"><?php echo $row['question_title'];?></a>
				&nbsp;&nbsp;&nbsp;<b style="font-size:10px;"><?php echo $row['question_browse'];?> Answers</b>
				<br />
				<br />
				<?php echo substr(strip_tags($row['question_content']),0,100)."......";?>
				</div>
			<?php
			}
			}
			else {
				echo "We are sorry, The question can not be found. You can ask this question via here.";
			}
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

function reSearch(){
	var keyword = $("#keywords").attr("value");
	//alert(keyword);
    if($("#keywords").val() != ""){                       //����û�¼��Ĺؼ��ֲ�Ϊ��
        $.get("<?php echo base_url();?>main/list_keywords?keyword="+keyword, null, function(data){
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


       function chkinput(form){
           if($.trim(form.keywords.value)==""){
               alert("Please input keyword.");
               form.keywords.focus();
               return false;
           } 
           return true;
       }
        
    </script> 
</body>
</html>