let dropArea = document.querySelector(".form-drag-area");
let dropText = document.querySelector(".description")
const browseButton = document.querySelector(".form-upload");
let inputPath = document.querySelector("#profile_image");

let file;

browseButton.onclick = () => {

    inputPath.click();
}

inputPath.addEventListener("change", function () {
    file = this.files[0];
    showimage();
})

dropArea.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropArea.classList.add("active");
    dropText.textContent = "Release to upload the File"
});

dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("active");
    dropText.textContext = "Drag & Drop to upload File";
});

dropArea.addEventListener("drop", (event) => {
    event.preventDefault();
    file = event.dataTransfer.files[0];
    let list = new DataTransfer();
    list.items.add(file);
    inputPath.file - list.files;

    showimage();
    dropArea.classList.remove("active");
});

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

        let validate = document.querySelector(".profile-image-validation");
        validate.classList.add("active");
    }
    else {
        alert("not an image file");
        dropArea.classList.remove("active")
    }
}
