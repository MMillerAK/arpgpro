<!DOCTYPE html>
<html lang="en">
<header></header>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<p id="t">hello, look at this item<span></span> </p>


<script>
    $(document).ready(function ()
    {
        $("p").click(function () {
            $(span).load("/item");
        });
    });
</script>

</body>
