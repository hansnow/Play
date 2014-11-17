



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
    if($("#username").val() && $("#password").val()){
      $.post("login.php",
      {
        "username":$("#username").val(),
        "password":md5($("#password").val())
      },function(data){
        response = JSON.parse(data);
        if(response.status == 0){
          $("#input_panel").css("display","");
          $("#login_panel").hide();
          $("#welcome_text").text("Welcome Back! "+response.nickname);
          $("[noauth]").filter(function(){
            return $(this).attr("noauth") == response.userid;
          }).css("display","");
        }else if(response.status == 404){
          swal({title:"登录失败",
              text: "没有找到你所输入的用户名和密码，或者用户名密码填错了",
              type: "error",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "好吧",
              closeOnConfirm: false });
        }else{
          swal({title:"登录失败",
              text: "发生了莫名其妙的错误，错误代码 "+response.status+" ，请联系管理员协助解决问题",
              type: "error",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "好吧",
              closeOnConfirm: false });
        }
      }
        );
    }else{
      swal({title:"信息不全",
          text: "用户名或密码为空，请重新输入",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "好吧",
          closeOnConfirm: false });
    }
    
  });

  // 回车登录
  $("#password").keydown(function(event){
    if(event.which == 13){
      if($("#username").val() && $("#password").val()){
        $.post("login.php",
        {
          "username":$("#username").val(),
          "password":md5($("#password").val())
        },function(data){
          response = JSON.parse(data);
          if(response.status == 0){
            $("#input_panel").css("display","");
            $("#login_panel").hide();
            $("#welcome_text").text("Welcome Back! "+response.nickname);
            $("[noauth]").filter(function(){
              return $(this).attr("noauth") == response.userid;
            }).css("display","");
          }else if(response.status == 404){
            swal({title:"登录失败",
                text: "没有找到你所输入的用户名和密码，或者用户名密码填错了",
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "好吧",
                closeOnConfirm: false });
          }else{
            swal({title:"登录失败",
                text: "发生了莫名其妙的错误，错误代码 "+response.status+" ，请联系管理员协助解决问题",
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "好吧",
                closeOnConfirm: false });
          }
        }
          );
      }else{
        swal({title:"信息不全",
            text: "用户名或密码为空，请重新输入",
            type: "error",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "好吧",
            closeOnConfirm: false });
      }
    }
  });

  $("#navbar_changelog").click(function(){
    $("#main").load("changelog.txt");
  });

  $("#navbar_about").click(function(){
    swal("About", "这里是关于信息", "success");
  });
});