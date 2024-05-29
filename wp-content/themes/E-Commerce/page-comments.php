<?php 
// Template Name: Register
get_header();
?>

<body>
    <!-- heading -->
    <h3 class="lead"  style="display:flex;justify-content:center;margin-top: 154px;">
        <?php
            the_title();
        ?>
    </h3>
    <form id="form" method="post" class="mx-auto p-2 grid gap-25 row gy-2" style="width: 450px; margin-top: 54px;">

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Write your reviews</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="textarea"></textarea>
    </div>
    
    <div class="ratings">
        <br/>
            <label for="input-1" class="control-label">Bootstrap star rating</label><br>
            <input id="input-1" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" placeholder="out of 5">
        <br/>
    </div>
        <p id="response"></p>
        <button type="submit" name="submit" class="btn btn-primary" value="Submit">Submit</button>
    </form>

    <script>
    $(()=>{
        $("#form").on('submit',(e)=>{
            e.preventDefault();
            var formData = new FormData($('#form')[0]);
            formData.append("action", "user_comments");
            for( var [key,value] of formData.entries()){
                console.log(key,"=>",value);
            }
            $.ajax({
                type:"POST",
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success:(res)=>{
                    $("#response").html(res.data);
                    $("#response").css('color', res.success ? 'green' : 'red');
                }
            });
        });
    });
</script>

</body>
    
<?php get_footer();?>

