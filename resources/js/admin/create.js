const imageUploadContainer = document.getElementById('imageUploadContainer');
const imageUploadInput = document.getElementById('imageUploadInput');
const imageContainer = document.getElementById('imageContainer');
const imageName = document.getElementById('imageName');
const imageSize = document.getElementById('imageSize');
const cancelButton = document.getElementById('cancelButton');
const caption = document.getElementById('caption');

imageUploadContainer.addEventListener('click', () => {
    imageUploadInput.click();
});

imageUploadInput.addEventListener('change', () => {
    console.log("changed");
    let file = imageUploadInput.files[0];
    if (file) {

        if (file.size / 1024 < 3072) {
            console.log("1", file);
            imageName.innerHTML = file.name
            imageSize.innerHTML = (file.size / 1024 / 1024).toFixed(2) + " Mega Octets"
            imageUploadContainer.classList.add("hidden")

            imageContainer.classList.remove("hidden");
            imageContainer.classList.add("flex");
            displayImage(file);
        } else {
            alert("La taille de l'image dépasse 3 mégaoctets.");
        }
    }

    cancelButton.onclick = () => {
        imageContainer.classList.remove("flex");
        imageContainer.classList.add("hidden");
        imageUploadContainer.classList.remove("hidden");
        file = null;
        imageUploadInput.value = '';
        caption.value = "";
    };

});

function displayImage(file) {
    const reader = new FileReader();
    reader.onload = function (event) {
        const imageUrl = event.target.result;
        imagePreview.src = imageUrl;
    };
    reader.readAsDataURL(file);
};

