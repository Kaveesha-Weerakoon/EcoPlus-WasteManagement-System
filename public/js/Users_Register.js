const browseButton = document.querySelector(".profile_image"); // Should be profile_image_trigger
const inputPath = document.querySelector("#profile_image");
let file;

browseButton.onclick = () => {
    inputPath.click();
}

inputPath.addEventListener("change", function () {
    file = this.files[0];
    showImage();
})

function showImage() {
    let fileType = file.type;
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"];

    if (validExtensions.includes(fileType)) {
        let fileReader = new FileReader();
        fileReader.onload = () => {
            let fileURL = fileReader.result;
            document.querySelector(".profile_image_trigger").setAttribute('src', fileURL); // Changed the selector here
        }

        fileReader.readAsDataURL(file);
    }
    else {
        alert("Please select an image file (JPEG/JPG/PNG).");
    }
}
