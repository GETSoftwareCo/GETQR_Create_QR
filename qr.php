<!DOCTYPE html>
 <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">  
    <title>Generate QR of everything | GETSoftware</title>
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style.css">

  </head>
  <body>
    <?php

    // Önceden saklanan sayıyı alma veya varsayılan değeri atama
    $loginCount = isset($_COOKIE['login_count']) ? $_COOKIE['login_count'] : 0;
    
    // Kullanıcının yeni girişini kaydetme
    $loginCount++;
    
    // Kullanıcının giriş sayısını bir cookie'ye saklama (10 yıl süreyle)
    setcookie('login_count', $loginCount, time() + (10 * 365 * 24 * 60 * 60));
    
    // Cookie'de saklanan giriş sayısını alma
    if (isset($_COOKIE['login_count'])) {
        $loginCountFromCookie = $_COOKIE['login_count'];
     }
    
    
    ?>
    <div class="wrapper">
      <header>
        <h1 style="text-align: center">Generate QR of Everything</h1>
        <p>Visited <?=$loginCountFromCookie?>> times</p>
        <p>Paste a url or enter text to generate a QR code!
          </p>
<i>         <small>**Your data is never recorded in the database. Only instant QR generation is allowed.</small>
</i>
        </header>
      <div class="form">
        <input type="text" spellcheck="false" placeholder="Enter text or url">
        <button>Generate QR Code</button>
      </div>
      <div class="qr-code">
        <img src="" alt="qr-code">
        
        
      </div>

<div style="margin-top: 30px">
<a href="https://getsoftwarecompany.com/" target="_blank" style="text-decoration:none"><h3 style="text-align: center; color: #fff">GET Software</h3></a>

</div>
    </div>

<script src="script.js"></script>

  </body>
</html>
