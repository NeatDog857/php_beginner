// $(document).ready(function(){
//     $("#button").click(function(){
//         $("#asd").load("text.txt");
//     });
// });

// $(document).ready(function(){
//     $("button").click(function(){
//         $.post("form_task.php",{name:"Jake"},function(data,status){
//             alert(data+"\n"+status);
//         });
//     });
// });

$(document).ready(function(){
    
    $("#button").click(function(){

        let name= $("#name").val();
        let age= $("#age").val();
        let cell= $("#cell").val();
        let address= $("#address").val();
        let email= $("#email").val();
        let date= $("#date").val();
        let checkbox= $("#checkbox").prop("checked");

        $.post("form_task_add.php",{
            "name":name,
            "age":age,
            "cell":cell,
            "address":address,
            "email":email,
            "date":date,
            "checkbox":checkbox
        },function(data){
            let rtn_obj=JSON.parse(data);
            
            if(rtn_obj.status){
                alert(rtn_obj.msg);
            }else{
                alert(rtn_obj.msg);
            }
            
        });
    });

    $("#check").click(function(){
        
        $.get("form_task_check.php",function(data){
            
            console.log(data);
            data= JSON.parse(data);
            console.log(data);
            
        });
    });
});