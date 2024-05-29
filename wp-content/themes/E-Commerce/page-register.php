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
    <form id="form" method="post" class="mx-auto p-2 grid gap-3 row gy-1" style="width: 450px;margin-top: 54px;">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Register your password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Write your Occupation</label>
            <input type="text" name="Occupation" class="form-control" id="formGroupExampleInput" placeholder="Occupation">
        </div>
        <p id="response"></p>
        <button type="submit" name="submit" class="btn btn-primary" value="Register">Register</button>
    </form>

    <script>
        $(()=>{
            $("#form").on('submit',(e)=>{
                e.preventDefault();
                var formData = new FormData($('#form')[0]);
                formData.append("action", "register_user");
                for( var [key,value] of formData.entries()){
                    console.log(key,"=>",value)
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
                        $("#response").css('color','green');
                    }
                })
            })
        })
    </script>
</body>
    
<?php get_footer();?>

