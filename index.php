
<?php include 'header.php' ?>

<title>Home - PIC</title>


<main>

  <div class="container col-xl-10 col-xl-8 px-1 py-5">

    <div class="row align-items-center g-lg-5 py-5 justify-content-center">
      <div class="col-lg-7 text-center text-lg-start">
        <img class="d-none d-sm-block w-75" src="images/login_svg.svg" alt="">
      </div>


      <div class="col-md-10 mx-auto  col-lg-5">

        <h2 class="text-center font-weight-bold mb-3 text-info">Welcome to Beehost</h2>

        <form id="login" method="POST" action="" class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
          <h1 class="h3 text-center fw-bold mb-3 text-uppercase">account login </h1>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="username" id="username" placeholder="name@example.com">
            <label for="floatingInput">username / email address</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" name="password" class="form-control" id="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>

          <!-- ERROR MeSSAGE -->
          <div style="display: none;" id="notify" class="alert   text-center alert-dismissible fade show" role="alert">
            <b id="error_show"></b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            
          </div>


          <button id="loginbtn" class="w-100 btn btn-lg btn-primary" >Sign in</button>
          <hr class="my-4">
        </form>
        
      </div>
    </div>
  </div>


</main>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/color-modes.js"></script>

</body>
</html>

<script>
  $(document).ready(function(e) {
    $("#notify").hide();
    //$("#error_show").hide();
  });

  $("form#login").submit(function(e) {
    e.preventDefault();
    var username = $("#username").val();
    var password = $("#password").val();

    if (username == "" || password =="") {
      $("#notify").show().addClass('alert-danger');
      $("#error_show").html("No fields must be empty").show();
      <?php $_SESSION['username'] = "admin" ?>
      setTimeout(' window.location.reload(); ', 5000);
    }else if(username == "admin" && password =="Admin2024"){
      $("#notify").show().addClass('alert-success');

      $("#error_show").html("Login is successful. Redirecting to Dashboard... <span class='fas fa-1x fa-spinner fa-pulse'></span>").show();



      setTimeout(' window.location.href = "./dashboard"; ', 5000);
    }else{
     $("#notify").show().addClass('alert-danger');
     $("#error_show").html("Username or Password is incorrect").show();

     setTimeout(' window.location.reload(); ', 5000);
   }

 });
</script>