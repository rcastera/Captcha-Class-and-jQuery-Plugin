<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Captcha</title>
<meta charset=utf-8 />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
  body {
    margin: 0px;
    padding: 0px;
    top: 0px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    font-family: serif;
  }
  header {
    background-color: #000;
  }
    header h1 {
      margin: 0px;
      padding: 10px;
      color: #fff;
    }
  #content {
    margin: 20px 0px 0px 20px;
  }
    #content #captcha_form p {
      margin: 0px;
      padding: 10px 0px;
    }
      #content #captcha_form input {
        padding: 5px;
        width: 200px;
      }
      #content #captcha_form .captcha_image {
        position: absolute;
        margin: 0px 0px 0px 10px;
      }
</style>
</head>
<body>
  <header id="header">
    <h1>Captcha jQuery Plugin</h1>
  </header>

  <div id="content">
    <?php
      if($_POST) {
        if($_SESSION['security_code'] == $_POST['human_test']) {
          echo 'Hi ' . (($_POST['name']) ? $_POST['name'] : 'Anonymous') . '! You have a valid security code.';
        }
        else {
          echo 'Hi ' . (($_POST['name']) ? $_POST['name'] : 'Anonymous') . '! You have an invalid security code.';
        }
      }
    ?>
    <form id="captcha_form" name="captcha_form" action="" method="post">
      <p>
        <label for="name">Name</label><br />
        <input type="text" id="name" name="name" value="" placeholder="Your name" />
      </p>
      <p>
        <label for="human_test">Human test</label><br />
        <input type="text" id="human_test" name="human_test" value="" class="captcha" placeholder="Are you human?" />
      </p>
      <p>
        <input type="submit" id="submit_button" name="submit_button" value="Submit" />
      </p>
    </form>
  </div>  

  <script src="//code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="plugin.captcha.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {        
      $('.captcha').captcha({
        font: 'fonts/monofont.ttf',
        background: '6aa72d',
        noise: '4e8616',
        color: 'ffffff',
        width: 100,
        height: 30,
        length: 6
      });   
    });
  </script>

</body>
</html>