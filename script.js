const wrapper = document.querySelector(".wrapper");
const qrInput = wrapper.querySelector(".form input");
const generateBtn = wrapper.querySelector(".form button");
const qrImg = wrapper.querySelector(".qr-code img");
let preValue = "";

generateBtn.addEventListener("click", async () => {
    const qrValue = qrInput.value.trim()  
    
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
