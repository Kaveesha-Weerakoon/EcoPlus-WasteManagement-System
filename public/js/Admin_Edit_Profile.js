const browseButton = document.querySelector(".edit-profile-second-image");
let inputPath = document.querySelector("#profile_image");


browseButton.onclick = () => {
    inputPath.click();
}

inputPath.addEventListener("change", function () {
    file = this.files[0];  //Take the first selected file
    showimage();
})

function showimage() {
    let fileType = file.type;
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"];

    if (validExtensions.includes(fileType)) {
        let fileReader = new FileReader();
        fileReader.onload = () => {
            let fileURL = fileReader.result;
            document.querySelector("#profile_image_placeholder").setAttribute('src', fileURL);
        }

        fileReader.readAsDataURL(file);


    }
    else {
        alert("not an image file");
        dropArea.classList.remove("active")
    }
}
