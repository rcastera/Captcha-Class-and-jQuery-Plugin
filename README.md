Captcha Class & jQuery Plugin
=============

What is Captcha? Captcha is used to ensure that the response from a form submission is 
not generated by a computer but rather a human. This Captcha class generates a customizable 
anti-spam image to use in your projects. I wrote it a while back because there weren't any on 
the market which offered the flexibility to modify the look and feel to complement different 
website designs. 

It can be used with the jQuery plugin or stand-alone.

Requirements
-----------
Always make sure that you start a session at the top of your page.

Usage as a jQuery plugin.
-----------

    <script src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="plugin.captcha.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {        
        $('.captcha').captcha({
          font: 'fonts/monofont.ttf', // Font and path.
          background: '6aa72d', // Background color.
          noise: '4e8616', // Noise color.
          color: 'ffffff', // Font color.
          width: 100, // Width.
          height: 30, // Height.
          length: 6 // Length of characters.
        });   
      });
    </script>

Usage as an image.
-----------

    <img border="0" class="captcha_image" src="/captcha.php?f=fonts/monofont.ttf&amp;b=6aa72d&amp;n=4e8616&amp;c=ffffff&amp;w=100&amp;h=30&amp;l=6">
    Where:
    1. f = Font and path.
    2. b = Background color.
    3. n = Noise color.
    4. c = Font color.
    5. w = Width.
    6. h = Height.
    7. l = Length of characters.

Contributing
------------

1. Fork it.
2. Create a branch (`git checkout -b my_branch`)
3. Commit your changes (`git commit -am "Added something"`)
4. Push to the branch (`git push origin my_branch`)
5. Create an [Issue][1] with a link to your branch
6. Enjoy a refreshing Coke and wait
