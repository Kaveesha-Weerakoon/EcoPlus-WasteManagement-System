<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Announcements ">


        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                    </div>
                    <div class="main-right-top-two">
                        <h1>Annoucements</h1>
                        <button id="open">Add</button>
                    </div>

                </div>

                <div class="main-right-bottom"> <?php foreach ($data['annoucements'] as $announcement): ?>
                    <div class="cont">
                        <div class="left slide-top">
                            <h2><?php echo $announcement->header; ?></h2>
                            <p><?php echo $announcement->date; ?></p>
                            <img src="<?php echo IMGROOT . '/img_upload/Annoucement/' . $announcement->img; ?>"
                                alt="logo">
                        </div>
                        <div class="right ">
                            <div class="cont slide-top">
                                <p><?php echo $announcement->text ?></p>
                            </div>
                        </div>
                        <div class="delete-icon">
                            <i class="fa-solid fa-trash" onclick="opendelete(<?php echo $announcement->id?>)"></i>

                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <form class=" add" id="add" action="<?php echo URLROOT;?>/admin/announcements" method="post"
            enctype="multipart/form-data">
            <div class="cont">
                <img src="<?php echo IMGROOT?>/close_popup.png" alt="" id="closeadd">

                <h1>New Announcement</h1>
                <img src="<?php echo IMGROOT?>/camera.jpg" alt="" class="camera" id="camera">
                <input type="file" id="cameraupload" name="cameraupload" onchange="displayImage()"
                    style="display: none;">
                <div class="input-cont">
                    <p>Header</p>
                    <input type="text" id="header" name="header">
                </div>
                <div class="input-cont">
                    <p>Text</p>
                    <input type="text" class="text" id="text" name="text">
                </div>
                <button>Make Announcement</button>
            </div>
        </form>
        <div class=" overlay" id="overlay">

        </div>

        <div class="delete" id="delete">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                <h2>Delete the Announcement?</h2>
                <p>This action will Delete the announcement </p>
                <div class="btns">
                    <a id="cancelLink"><button type="button" class="deletebtn">Delete</button></a>
                    <button id="close_cancel" type="button" class="cancelbtn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById("open").addEventListener("click", function() {
    document.getElementById("add").classList.add('active');
    document.getElementById('overlay').style.display = "flex";
});
document.getElementById("closeadd").addEventListener("click", function() {
    document.getElementById("add").classList.remove('active');
    document.getElementById('overlay').style.display = "none";
});
document.getElementById("close_cancel").addEventListener("click", function() {
    document.getElementById("delete").classList.remove('active');
    document.getElementById('overlay').style.display = "none";
});



function opendelete($id) {
    var annoucementId = $id;
    var newURL = "<?php echo URLROOT?>/admin/deleteAnnouncement/" + annoucementId;
    document.getElementById('cancelLink').href = newURL;
    document.getElementById("delete").classList.add('active');
    document.getElementById('overlay').style.display = "flex";


}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('add');
    const headerInput = document.getElementById('header');
    const textInput = document.getElementById('text');
    const fileInput = document.getElementById('cameraupload');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        if (headerInput.value.length < 10 || headerInput.value.length > 55) {
            alert('Header must be between 10 and 55 characters long.');
            return;
        }
        console.log(textInput.value.length);

        if (textInput.value.length < 20 || textInput.value.length > 600) {

            alert('Text must be between 20 and 300 characters long.');
            return;
        }

        // Check if a file is selected
        if (fileInput.files.length === 0) {
            alert('Please select an image.');
            return;
        }

        // Get the file extension
        const fileName = fileInput.files[0].name;
        const fileExtension = fileName.split('.').pop().toLowerCase();

        // Check if the file extension is valid
        if (!['png', 'jpeg', 'jpg'].includes(fileExtension)) {
            alert('Please upload a PNG, JPEG, or JPG image.');
            return;
        }

        form.submit();
    });
});

function displayImage() {
    const fileInput = document.getElementById('cameraupload');
    const cameraImage = document.getElementById('camera');

    const file = fileInput.files[0];
    const fileType = file.type;
    const validExtensions = ["image/jpeg", "image/jpg", "image/png"];

    if (validExtensions.includes(fileType)) {
        const fileReader = new FileReader();
        fileReader.onload = () => {
            const fileURL = fileReader.result;
            cameraImage.src = fileURL;
        };

        fileReader.readAsDataURL(file);
    } else {
        alert("Not an image file");
    }
}


const cameraImage = document.getElementById('camera');
const cameraInput = document.getElementById('cameraupload');
cameraImage.addEventListener('click', function() {
    cameraInput.click();
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>