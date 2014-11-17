



$(document).ready(function(){

  // 首次加载，刷新
  $.get("post.php",
  {
    type:"all"
  },
  function(data){
    $("#content").html(data);
    $("[del]").click(function(){
      $.post("post.php",
        {
          "type":"del",
          "delid":$(this).attr("del")
        });
      $(this).parent().parent().hide();
    });
  });

  // 提交按钮被点击
  $("#submit").click(
    function (){
      if($("#input").val()!=""){
        $.post("post.php",
          {
            content:$("#input").val()
          },
          function(){
            $.get("post.php",
            {
              type:"new"
            },
            function(data){
              $("#content").prepend(data);
              $("[del]").click(function(){
                $.post("post.php",
                  {
                    "type":"del",
                    "delid":$(this).attr("del")
                  });
                $(this).parent().parent().hide();
              });
            });
          });
        $("#input").val("");
        
      }else{
        alert("随便输点东西好不好！");
      }
    }
    );
  //回车发送内容
  $("#input").keydown(function(event){
    if(event.which == 13){
      if($("#input").val()!=""){
        $.post("post.php",
          {
            content:$("#input").val()
          },
          function(){
            $.get("post.php",
            {
              type:"new"
            },
            function(data){
              $("#content").prepend(data);
              $("[del]").click(function(){
                $.post("post.php",
                  {
                    "type":"del",
                    "delid":$(this).attr("del")
                  });
                $(this).parent().parent().hide();
              });
            });
          });
        $("#input").val("");
        
      }else{
        alert("随便输点东西好不好！");
      }
    }
  });


  $("#login").click(function(){
    $.post("login.php",
    {
      "username":$("#username").val(),
      "password":$("#password").val()
    },function(data){
      var nickname = data.split("|")[0].trim();
      var userid = data.split("|")[1].trim();
      $("#input_panel").css("display","");
      $("#login_panel").hide();
      $("#welcome_text").text("Welcome Back! "+nickname);
      $("[noauth]").filter(function(){
        return $(this).attr("noauth") == userid;
      }).css("display","");


    }
      );
    
  });

  $("#navbar_changelog").click(function(){
    $("#main").load("changelog.txt");
  });

  $("#navbar_about").click(function(){
    swal("About", "这里是关于信息", "success");
  });
});