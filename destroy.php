<?php
session_start();
session_destroy();
echo<<<_END
    <script type="text/javascript">
        window.location.replace("index.php");
    </script>
_END;
?>