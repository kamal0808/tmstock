<html>
    <head>
        <title>Welcome</title>
        <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <script>
            $(function(){
                $(".delete").focus();
            })
            $(document).on("click",".delete",function(){
                var res=confirm("Are you sure to delete?")
                if(!res)
                    return false;
                return true;
            })
        </script>
    </head>
    <body>
        <a href="another.php?func=delete">
            <button tabindex="0" class="delete">Another Page</button>
        </a>
    </body>
</html>