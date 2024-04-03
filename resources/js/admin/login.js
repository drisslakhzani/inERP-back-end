var pass = document.getElementById('pass');
var showHidePass = document.getElementById('showHidePass');

showHidePass.onclick = () => {
    pass.type === "password" ?
        pass.type = "text" :
        pass.type = "password";

    showHidePass.src.endsWith("eyeOpen.svg") ?
        showHidePass.src = "/icons/eyeClose.svg" :
        showHidePass.src = "/icons/eyeOpen.svg";
};

