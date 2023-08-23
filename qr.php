<!DOCTYPE html>
 <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">  
    <title>Generate QR of everything | GETSoftware</title>
    <style>
      /* Import Google Font - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.qr-code img {
  border-radius: 10px;
  background-color: rgba(13, 226, 112, 0.3);
  padding: 10px;
  box-shadow: 0 0 5px rgba(13, 226, 112, 0.3);
}

body{
  display: flex;
  padding: 0 10px;
  min-height: 100vh;
  align-items: center;
  background: #15954a;
  justify-content: center;
}
::selection{
  color: #fff;
  background: #15954a;
}
.wrapper{
  height: 350px;
  max-width: 410px;
  background: #fff;
  border-radius: 7px;
  padding: 20px 25px 0;
  transition: height 0.2s ease;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.wrapper.active{
  height: 530px;
}
header h1{
  font-size: 21px;
  font-weight: 500;
}
header p{
  margin-top: 5px;
  color: #575757;
  font-size: 16px;
}
.wrapper .form{
  margin: 20px 0 25px;
}
.form :where(input, button){
  width: 100%;
  height: 55px;
  border: none;
  outline: none;
  border-radius: 5px;
  transition: 0.1s ease;
}
.form input{
  font-size: 18px;
  padding: 0 17px;
  border: 1px solid #999;
}
.form input:focus{
  box-shadow: 0 3px 6px rgba(0,0,0,0.13);
}
.form input::placeholder{
  color: #999;
}
.form button{
  color: #fff;
  cursor: pointer;
  margin-top: 20px;
  font-size: 17px;
  background: #15954a;
}
.qr-code{
  opacity: 0;
  display: flex;
  padding: 5px 0;
  border-radius: 5px;
  align-items: center;
  pointer-events: none;
  justify-content: center;
  border: 1px solid #ccc;
}
.wrapper.active .qr-code{
  opacity: 1;
  pointer-events: auto;
  transition: opacity 0.5s 0.05s ease;
}
.qr-code img{
  width: 170px;
}

@media (max-width: 430px){
  .wrapper{
    height: 350px;
    padding: 16px 20px;
  }
  .wrapper.active{
    height: 510px;
  }
  header p{
    color: #696969;
  }
  .form :where(input, button){
    height: 52px;
  }
  .qr-code img{
    width: 160px;
  }  
}


/* Responsive Tasarım */
@media screen and (max-width: 768px) {
  .wrapper {
      padding: 10px;
  }

  h1 {
      font-size: 24px;
  }

  p {
      font-size: 14px;
  }

  input[type="text"],
  button {
      font-size: 14px;
  }
}

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<script>
  const wrapper = document.querySelector(".wrapper");
const qrInput = wrapper.querySelector(".form input");
const generateBtn = wrapper.querySelector(".form button");
const qrImg = wrapper.querySelector(".qr-code img");
let preValue = "";

generateBtn.addEventListener("click", async () => {
    const qrValue = qrInput.value.trim();
    
    if (!qrValue || preValue === qrValue) {
        return;
    }

    preValue = qrValue;
    generateBtn.innerText = "Generating QR Code...";
    
    try {
        const response = await fetch(`https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(qrValue)}`);
        
        if (!response.ok) {
            throw new Error("QR code generation failed");
        }

        qrImg.src = URL.createObjectURL(await response.blob());

        qrImg.addEventListener("load", () => {
            wrapper.classList.add("active");
            generateBtn.innerText = "Generate QR Code";
        });
    } catch (error) {
        console.error("QR code generation error:", error);
        generateBtn.innerText = "Generate QR Code";
    }
});

qrInput.addEventListener("keyup", () => {
    const trimmedValue = qrInput.value.trim();
    
    if (!trimmedValue) {
        wrapper.classList.remove("active");
        preValue = "";
    }
});

</script>

  </body>
</html>