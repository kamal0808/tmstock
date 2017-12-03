$(document).on("focus","select",function(){
        $(this).attr("size",10);
    })

$(document).on("blur","select",function(){
        $(this).attr("size",0);
    })

$(document).on("keydown",".new-order-row",function(e){
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code==13)
        {
            var newRow=$(".order-row").last().html();
            var orderid=$(".orderid").last().html();
            $(this).removeClass("new-order-row");
            $(".order-table").append("<tr class=\"order-row \">"+newRow+"</tr>");
            $(".orderid").last().html(++orderid);
            $(".order-row:last").find(".has-success").each(function(){
                $(this).removeClass("has-success");
            });
            
        }
});

$(document).on("keydown",".new-order-row-edit",function(e){
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code==13)
        {
            var newRow=$(".order-row-edit").last().html();
            var orderid=$(".orderid").last().html();
            $(this).removeClass("new-order-row-edit");
            $(".order-table").append("<tr class=\"order-row-edit \">"+newRow+"</tr>");
            $(".orderid").last().html(++orderid);
            
        }
});
    
$(function(){
    $(".focus").focus();
})

$(function () {
$('#example1').dataTable({
  "bPaginate": false,
  "bLengthChange": false,
  "bFilter": true,
  "bSort": true,
  "bInfo": true,
  "bAutoWidth": true
});
});

$(document).on("change",".item-godown",function(){
    var classid=$(this).index(".item-godown");
    var itemid=$(this).val();
    var src="items/"+itemid+".jpg";
    $(".modal-body").html("<img src='"+src+"' alt='"+src+"' width='600'/>");        
//    $(".modal-body").html("hi");        
    $("#myModal").modal('show');
    $(".item-id").eq(classid).val(itemid);
    if(itemid<10)
        itemid="00"+itemid;
    else if(itemid>=10&&itemid<100)
        itemid="0"+itemid;
    itemid="IT-"+itemid;
    $(".itemid").eq(classid).val(itemid)
})

$(document).on("change",".supplier",function(){
    var classid=$(this).index(".supplier");
    var suppliercity=$(".city").val();
    $(".suppliercity").eq(classid).val(suppliercity);
})

$(document).on("click",".delete-row",function(){
    $(this).parent().parent().remove();
    var count=1;
    $(".orderid").each(function(){
        $(this).html(count);
        count=count+1;
    $(".order-row:last").find(".item-quantity").addClass("new-order-row");
    })
})

$(function(){
    $(".price").first().focus();
})

$(document).on("keyup",".price",function(e){
        var sum=0,roundoff,subtotal,total;
        var row=$(this).index(".price");
        var price=$(this).val();
        var quantity=$(".quantity").eq(row).html();
        var amount=parseFloat(price*quantity).toFixed(2);
        $(".amount").eq(row).html(amount);
        $(".amount").each(function(){
            sum=sum+parseFloat($(this).html());
        })
        subtotal=sum.toFixed(2)
        $(".sub-total").html("Rs. "+subtotal);
        var dec=subtotal-parseInt(subtotal);
        if(dec>0.50)
            {
                subtotal++;
            }
        total=parseInt(subtotal);
        if(dec>0.50)
            {
             subtotal--;   
            roundoff=(total-subtotal).toFixed(2);
            }
        else
            roundoff=(total-subtotal).toFixed(2);
        $(".total").html("Rs. "+total+".00");
        $(".round-off").html("Rs. "+roundoff);
})

$(function(){
        var sum=0,roundoff,subtotal,total;
        $(".price").each(function(){
            var row=$(this).index(".price");
            var price=$(this).val();
            var quantity=$(".quantity").eq(row).html();
            var amount=parseFloat(price*quantity).toFixed(2);
            $(".amount").eq(row).html(amount);
            sum=sum+parseFloat(amount);
        })
            subtotal=sum.toFixed(2)
            $(".sub-total").html("Rs. "+subtotal);
            var dec=subtotal-parseInt(subtotal);
            if(dec>0.50)
                {
                    subtotal++;
                }
            total=parseInt(subtotal);
            if(dec>0.50)
                {
                 subtotal--;   
                roundoff=(total-subtotal).toFixed(2);
                }
            else
                roundoff=(total-subtotal).toFixed(2);
            $(".total").html("Rs. "+total+".00");
            $(".round-off").html("Rs. "+roundoff);
})

$(document).ready(function () {
    $('.dropdown').on('shown.bs.dropdown', function () {
        var $dd = $(this);
        $(document).on('keydown.dd', function (e) {
            if (e.which == 39) {
                $dd.next('.dropdown').find('.dropdown-toggle').focus().trigger('click');
            } else if (e.which == 37) {
                $dd.prev('.dropdown').find('.dropdown-toggle').focus().trigger('click');
            }
        });
    }).on('hide.bs.dropdown', function () {
        $(document).off('keydown.dd');
    });
});

$(document).ready(function(){
    $(document).on("blur",".mandatory",function(){
        if($(this).val()=="")
        {
            $(this).parent().removeClass("has-success");
            $(this).parent().addClass("has-error");
        }
    else if($(this).val()!="")
        {
            $(this).parent().removeClass("has-error");
            $(this).parent().addClass("has-success");
        }
    })
})

$(function(){
    $(".mandatory:text").each(function(){
        if($(this).val()!="")
            $(this).parent().addClass("has-success");
            
    })
        
})

var formsubmit=0;
$(function(){
    $(".myform").submit(function(){
        var flag=0;
        $(":focus").blur();
        var curpath=window.location.href;
    var index = curpath.lastIndexOf("/")+1;
    var lastindex=curpath.lastIndexOf("?");
    var filename;
    if(lastindex!=-1)
         filename = curpath.substring(index, lastindex);
    else
         filename = curpath.substring(index);
    var myarray=["viewcustomers.php","viewitems.php","vieworders.php","viewpurchase.php","viewrentalsfrom.php","viewrentalsto.php","viewsuppliers.php"]
                $(this).find(".mandatory").each(function(){
                    if(!$(this).parent().hasClass("has-success"))
                        {
                            flag=1
                            $(this).focus();
                            $(this).parent().addClass("has-error");
                            event.preventDefault();
                            return false
                        }
                        return true
                })
    if(myarray.indexOf(filename)==-1)
        {
                if(flag==0)
                    {
                        var aconfirm=confirm("Save Changes?");
                        if(!aconfirm)
                            {
                                $(".item-quantity").last().focus();
                                return false;
                            }
                        else    
                            formsubmit=1;    

                    }
                    return true;
            
        }
            })
})
$(function(){
    $(".simpleform").submit(function(){
        formsubmit=1;
    })
})

$(function(){
    $(".logout-button").click(function(){
            window.location.replace("destroy.php");
    })
    
})

$(document).on("change",".item-name",function(){
    var value=$(this).val();
    if(value=="other")
        {
              $(".other-item-name").removeAttr("disabled");
              $(".other-item-name").addClass("mandatory");
        }
        else
        {
             $(".other-item-name").attr("disabled","disabled");
             $(".other-item-name").removeClass("mandatory");
        }
        var curpath=window.location.href;
        var index = curpath.lastIndexOf("/")+1;
        var filename = curpath.substr(index);
        index=$(this).index(".item-name");
        $(".item-type").eq(index).load("ajax.php",{itemname:value,filename:filename,app:'itemtype'});
})

$(document).on("change",".item-type",function(){
    var value=$(this).val();
    if(value=="other")
        {
              $(".other-item-type").removeAttr("disabled");
              $(".other-item-type").addClass("mandatory");
        }
        else
        {
             $(".other-item-type").attr("disabled","disabled");
             $(".other-item-type").removeClass("mandatory");
        }
    var curpath=window.location.href;
    var index = curpath.lastIndexOf("/")+1;
    var filename = curpath.substr(index);
    index=$(this).index(".item-type");
    var itemname=$(".item-name").eq(index).val();
    
    $(".item-description").eq(index).load("ajax.php",{item:itemname,itemtype:value,app:'itemdescription'})   
});

$(document).on("change",".item-description",function(){
    var value=$(this).val();
    var index=$(this).index(".item-description");
    var itemname=$(".item-name").eq(index).val();
    var itemtype=$(".item-type").eq(index).val();
    var myitemsid=[];
    $(".item-id").each(function(){
        myitemsid.push($(this).val());
    })
    var itemdesc=$(this).find(":selected").text();
//    alert(itemdesc)
    var myarray=itemdesc.split("-");
//    var tex;
//    for(var i=0;i<myarray.length;i++)
//        tex=tex+myarray[i]+"-";
//    alert(tex)
    var business=myarray[(myarray.length)-1];
    business=business.trim(" ");
    $(".item-godown").eq(index).load("ajax.php",{myitemsid:myitemsid,itemname:itemname,itemtype:itemtype,itemdesc:value,business:business,app:'itemgodown'});   
});

$(document).on("change",".item-godown",function(){
    var index=$(this).index(".item-godown");
    var value=$(this).find(":selected").text();
//    alert(value)
    var myarray=value.split("-");
//    var tex;
//    for(var i=0;i<myarray.length;i++)
//        tex=tex+myarray[i]+"-";
//    alert(tex)
    var quantity=myarray[(myarray.length)-1];
    quantity=parseInt(quantity);
    var curpath=window.location.href;
    var slash= curpath.lastIndexOf("/")+1;
    var filename;
     filename = curpath.substring(slash);
     if((filename=="addorders.php"||filename=="addrentalsto.php"))
         {
//                alert(filename)
            $(".item-quantity").eq(index).attr("max",quantity);
             
         }
})

$(document).on("keydown",":text,select,input[type='number']",function(e){
    
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code == 13) {
            var tabables = $(".form-control");
            var index = tabables.index(this);
            if(tabables.eq(index + 1).attr("disabled")=="disabled")
                tabables.eq(index + 2).focus();
            else
                tabables.eq(index + 1).focus();
                
            event.preventDefault();
        }        
    });
    
$(function(){
    $(".focusable").keydown(function(e){
        var code=e.keyCode ? e.keyCode : e.which;
        var index=$(this).index(".focusable");
        if(code==39)
        {
            $(".focusable").eq(index+1).focus();
        }
        else if (code==37)
        {
            $(".focusable").eq(index-1).focus();
        }
        else if(code==13)
        {
            var classn=this.className;
            if(classn.indexOf("delete")==-1)
                {
                    var link=$(this).parent().attr("href");
                    window.location.replace(link);
                    
                }
        }

    })
    
})    

$(document).on("focus",".focusable",function(){
        var classname=this.className;
        var color;
        var myclass=classname.split(' ');
        for(var i=0;i<myclass.length;i++)
            {
                if(myclass[i].indexOf("bg-")!=-1)
                    {
                        color=myclass[i];
                        
                    }
            }
        $(this).removeClass("bg-green")
        $(this).addClass(color+"-active")
        $(".small-box-footer").hide();
        $(this).children(".small-box-footer").show();
//        alert($(this).html())
    })

$(document).on("blur",".focusable",function(){
        var classname=this.className;
        var color;
        var myclass=classname.split(' ');
        for(var i=0;i<myclass.length;i++)
            {
                if(myclass[i].indexOf("bg-")!=-1)
                    {
                        color=myclass[i];
                        
                    }
            }
        $(this).removeClass(color);
        if(color!=undefined)
            {
//                alert(color+"color")
                var index=color.indexOf("-active");
                color=color.substring(0, index);
            $(this).addClass(color);
                
            }
    })
    
$(document).on("keydown",document,function(e){
    var code=e.keyCode?e.keyCode:e.which;
//    alert(code)
    if(code==81&&e.ctrlKey)     //ctrl+q
        {
            $(".menu-focus").eq(0).click();
        }
    else if(code==70&&e.ctrlKey)   //ctrl+f
        {
            event.preventDefault()
            $(".focus").first().focus();
            
        }
    else if(code==76&&e.ctrlKey)   //ctrl+l
    {
        event.preventDefault()
        var flag=0;
           $(":input").each(function(){
               var value=$(this).val();
               if(!(value==""||value=="on"||value==null))
               {
//                   alert(value)
                   flag=1;
               }
           })
               if(flag==1)
               {
                   var res=confirm("There are unsaved changes. Leave?")
                   if(!res)
                        return false;
               }
        window.location.replace("logout.php")
    }
    else if(code==72&&e.ctrlKey)    //ctrl+h
    {
        event.preventDefault()
         flag=0;
           $(":input").each(function(){
               var value=$(this).val();
               if(!(value==""||value=="on"||value==null))
               {
//                   alert(value)
                   flag=1;
               }
           })
               if(flag==1)
               {
                   res=confirm("There are unsaved changes. Leave?")
                   if(!res)
                        return false;
               }
        window.location.replace("home.php")
    }
    else if(code==83&&e.ctrlKey)    //ctrl+s
    {
        event.preventDefault();
        $("body").removeClass("sidebar-collapse")
        $(".focus").focus();
        $(".business-menu").focus();
    }
    else if(code==69&&e.ctrlKey)    //ctrl+e
        {
            event.preventDefault();
            $(".item").eq(0).focus();
        }
    else if(code==83&&e.altKey)    //alt+s
        {
            event.preventDefault();
            $(":focus").closest("form").find(".submit").click();
        }
    else if(code==27)   //esc key
        {
            if($("#myModal").css("display")=="block")
                {
                    $("#myModal").modal("hide");
//                    event.preventDefault();
                    return false;
                }
            
            if($(":focus").index()!=-1)
                {
                    $(":focus").blur();
                    event.preventDefault();
                }
            var sidebar=$("body").attr("class");
            if(sidebar.indexOf("sidebar-collapse")==-1)
            {
                $("body").addClass("sidebar-collapse");
                return false;
            }
            var curpath=window.location.href;
            var index = curpath.lastIndexOf("/")+1;
            var lastindex=curpath.lastIndexOf("?");
            var filename;
            var goback=0;
            if(lastindex!=-1)
                {
                     filename = curpath.substring(index, lastindex);
                     goback=1;
                }
            else
                 filename = curpath.substring(index);
            var myarray=["addcustomers.php","additems.php","addorders.php","addpurchase.php","addrentalsfrom.php","addrentalsto.php","addsuppliers.php","viewcustomers.php","viewitems.php","vieworders.php","viewpurchase.php","viewrentalsfrom.php","viewrentalsto.php","viewsuppliers.php","godowns.php","managers.php","logout.php"];
            var myarray1=["customer.php","item.php","order.php","purchase.php","rentalfrom.php","rentalto.php","supplier.php","godown.php"];
           
            if(myarray.indexOf(filename)!=-1)
                {
                    if(goback==0)
                        window.location.replace("home.php");
                    else
                        window.location.replace(filename)
                }
            if(myarray1.indexOf(filename)!=-1)
                history.go(-1);
        }
        return true;
})
    
$(document).on("keydown",".menu-focus",function(e){
    var code=e.keyCode?e.keyCode:e.which;
    if(code==27)
        $(".focus").focus();
})

$(document).on("keydown",".order-row,.order-row-edit",function(e){
    var code=e.keyCode?e.keyCode:e.which;
    if(code==68&&e.ctrlKey) //ctrl+d
        {
            event.preventDefault();
            $(this).children().children(".delete-row").click();
            $(".item-quantity").last().focus();
        }
     var rowcount=$(this).index();
     if(code==40&&e.ctrlKey)   //ctrl+down
         {
             event.preventDefault();
             $(".order-row,.order-row-edit").eq(rowcount).children().children().children(".item").focus();
         }
     if(code==38&&e.ctrlKey)   //ctrl+up
         {
             event.preventDefault();
             $(".order-row,.order-row-edit").eq(rowcount-2).children().children().children(".item").focus();
         }
})

$(document).on("click",".cancel",function(){
    var e=$.Event("keydown");
    e.which=27;
    $(document).trigger(e);
})

$(window).on('beforeunload', function(){
    var flag=0;
    var curpath=window.location.href;
    var index = curpath.lastIndexOf("/")+1;
    var lastindex=curpath.lastIndexOf("?");
    var filename;
    if(lastindex!=-1)
         filename = curpath.substring(index, lastindex);
    else
         filename = curpath.substring(index);
    var myarray=["viewcustomers.php","viewitems.php","vieworders.php","viewpurchase.php","viewrentalsfrom.php","viewrentalsto.php","viewsuppliers.php"]
    if(myarray.indexOf(filename)==-1)
        {
           $(":input").each(function(){
               var value=$(this).val();
                   alert(value)
               if(!(value==""||value=="on"||value==null))
               {
                   flag=1;
               }
           })
               if(flag==1&&formsubmit==0)
               {
//                  return 'You have unsaved changes. Are you sure you want to leave?';
                   return("There are unsaved changes. Leave?")
//                   if(!res)
//                      $(".focus").focus();
//                        return false;
               }
            
        }
});

$(document).on("change",".item-name-edit",function(){
    var index=$(this).index();
    $(".item-id").eq(index).val("0");
})

$(document).on("click",".delete",function(){
    var isGood=confirm("Are you sure you want to delete this?")
    if(!isGood)
        return false;
    
})

$(document).on('hidden.bs.modal','#myModal', function () {
    $(".item-godown").last().focus();
})