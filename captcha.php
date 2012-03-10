<?php
/**
 * Captcha Class in PHP5
 * @author Richard Castera
 * @link http://www.richardcastera.com/projects/captcha-class-in-php
 * @license GNU LESSER GENERAL Public LICENSE
 */

class Captcha {
  /**
   * Default font to use.
   * @var String
   */
  private $font = 'fonts/monofont.ttf';
  
  /**
   * Default background color of the captcha image.
   * @var String
   */
  private $background = '000000';
  
  /**
   * Default color for background noise.
   * @var String
   */
  private $noise = '000000';
  
  /**
   * Default color for captcha text.
   * @var String
   */
  private $color = 'ffffff';
  
  /**
   * Default width of captcha image.
   * @var String
   */
  private $width = 100;
  
  /**
   * Default height of captcha image.
   * @var String
   */
  private $height = 30;
  
  /**
   * Default length of the captcha text.
   * @var String
   */
  private $length = 6;
  
  /**
   * Constructor.
   */ 
  public function __construct() {
    session_start();
    $this->font = isset($_GET['f']) ? $_GET['f'] : $this->font;
    $this->background = isset($_GET['b']) ? $_GET['b'] : $this->background;
    $this->noise = isset($_GET['n']) ? $_GET['n'] : $this->noise;
    $this->color = isset($_GET['c']) ? $_GET['c'] : $this->color; 
    $this->width = isset($_GET['w']) ? $_GET['w'] : $this->width;
    $this->height = isset($_GET['h']) ? $_GET['h'] : $this->height;
    $this->length = isset($_GET['l']) ? $_GET['l'] : $this->length; 
    $this->createCaptcha();
  }
  
  /**
   * Destructor.
   */ 
  public function __destruct() {
    unset($this);
  }
  
  /**
   * Generates security image.
   */ 
  private function createCaptcha() {
    // Generate the code.
    $characters = $this->generateCode($this->length);
  
    // Font size will be 60% of the image height.
    $size = $this->height * 0.60;
  
    // Create the image.
    $image = imagecreate($this->width, $this->height) or die('Cannot initialize new GD image stream.');
  
    // Set the background color of the image.
    $rgb = $this->getRGB($this->background);
    $background = imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
  
    // Set the background noise color of the image.
    $rgb = $this->getRGB($this->noise);
    $noise = imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
  
    // Set the text color of the image.
    $rgb = $this->getRGB($this->color);
    $color = imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
  
    // Generate random dots in background.
    for($i=0; $i<($this->width * $this->height)/3; $i++)  {
      imagefilledellipse($image, mt_rand(0, $this->width), mt_rand(0, $this->height), 1, 1, $noise);
    }
  
    // Generate random lines in background.
    for($i = 0; $i < ($this->width * $this->height)/150; $i++) {
      imageline($image, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $noise);
    }
  
    // Create box
    $textbox = imagettfbbox($size, 0, $this->font, $characters) or die('Error in imagettfbbox function');
  
    // This is our coordinates for X and Y.
    $x = $textbox[0] + ($this->width / 2) - ($textbox[4] / 2);
    $y = $textbox[1] + ($size / 2) - ($textbox[5] / 2);
  
    // Add text.
    imagettftext($image, $size, 0, $x, $y, $color, $this->font, $characters) or die('Error in imagettftext function');
  
    // Output Captcha image to Browser.
    header('Content-Type: image/jpeg');
    imagejpeg($image, '', 100);
    imagedestroy($image);
    $_SESSION['security_code'] = $characters;
  }
  

  /**
   * Generates the code for the captcha.
   * @param Integer $length - The number of characters to generate. 
   * @return String - The character code.
   */
  private function generateCode($length = 6)  {
    // All possible characters, similar looking characters and vowels have been removed
    $matrix = '23456789bcdefghjkmnpqrstvwxyz';
    $code = '';
    
    // Generate a random string of characters.
    for($i=0; $i < $length; $i++) {
      $code .= substr($matrix, mt_rand(0, strlen($matrix)-1), 1);
    }
    
    return $code;
  }
  
  /**
   * Returns RGB value of a hexadecimal color.
   * @param String $color - The hexadecimal value.  
   * @return Array - RGB.
   */
  private function getRGB($color = '000000') {
    $color = str_replace('#', '', $color);
    $r = hexdec(substr($color, 0, 2));
    $g = hexdec(substr($color, 2, 2));
    $b = hexdec(substr($color, 4, 2)); 
    return array($r, $g, $b); 
  }
};
  
// Outputs security image.
$c = new Captcha();
unset($c);
