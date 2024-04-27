<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">

        <div class="Admin_Center_Main_Stock_Releases">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <a
                                href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                                <div class="main-right-top-back-button">
                                    <i class='bx bxs-chevrons-left'></i>
                                </div>
                            </a>
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>

                            <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                        </div>
                        <div class="main-right-top-two">
                            <h1>Center Garbage Details</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/Admin/waste_handover/<?php echo $data['center_region']?>"
                                id="waste_handover">
                                <div class="main-right-top-three-content" >
                                    <p>Waste Handover</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/center_main_garbage_stock/<?php echo $data['center_region']?>"
                                id="garbage_stock">
                                <div class="main-right-top-three-content" >
                                    <p>Garbage Stock</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/stock_releases/<?php echo $data['center_region']?>"
                                id="stock_releases">
                                <div class="main-right-top-three-content" id="current">
                                    <p>Stock Releases</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <?php if(!empty($data['release_details'])) : ?>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Date & Time</th>
                                    <th>Released Person</th>
                                    <th>Release Note</th>
                                    <th>Release Details</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['release_details'] as $release) : ?>
                                <tr class="table-row">
                                    <td> <?php echo $release->released_date_time?></td>
                                    <td><?php echo $release->released_person?></td>
                                    <td> <?php echo $release->release_note?></td>
                                    <td class="cancel-open">
                                        <img onclick="view_release_details(<?php echo htmlspecialchars(json_encode($release), ENT_QUOTES, 'UTF-8') ?>)"
                                            src="<?php echo IMGROOT?>/info.png" alt="">
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-content">
                            <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                            <h1>There are no stock releases yet</h1>
                            <p>All the released garbage details will appear here</p>


                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="overlay" id="overlay"></div>

                    <div class="release_garbage_details_popup" id="release_garbage_details_popup">
                        <img src="<?php echo IMGROOT?>/close_popup.png" alt="" id="close_release_garbage_details_popup">
                        <h1>Released Garbage Details</h1>
                        <div class="Eco_Credit_Per_Cont">
                            <div class="Cont">
                                <h3>Plastic</h3>
                                <i class="icon fas fa-box"></i>
                                <p id="plastic"></p>
                            </div>
                            <div class="Cont">
                                <h3>Polythene</h3>
                                <i class="icon fas fa-trash"></i>
                                <p id="polythene"></p>
                            </div>
                            <div class="Cont">
                                <h3>Metal</h3>
                                <i class="icon fas fa-box"></i>
                                <p id="metals"></p>
                            </div>
                            <div class="Cont">
                                <h3> Glass</h3>
                                <i class="icon fas fa-glass-whiskey"></i>
                                <p id="glass"></p>
                            </div>

                            <div class="Cont">
                                <h3>Paper</h3>
                                <i class="icon fas fa-file-alt"></i>
                                <p id="paper_waste"></p>
                            </div>
                            <div class="Cont">
                                <h3>Electronic</h3>
                                <i class="icon fas fa-laptop"></i>
                                <p id="electronic_waste"></p>
                            </div>
                        </div>
                        <h2>* Weights are in kilograms</h2>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<script>
function view_release_details(release) {
    var releasePop = document.getElementById('release_garbage_details_popup');
    releasePop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    document.getElementById('polythene').innerText = release.polythene;
    document.getElementById('plastic').innerText = release.plastic;
    document.getElementById('glass').innerText = release.glass;
    document.getElementById('paper_waste').innerText = release.paper_waste;
    document.getElementById('electronic_waste').innerText = release.electronic_waste;
    document.getElementById('metals').innerText = release.metals;

}

document.addEventListener("DOMContentLoaded", function() {

    const close_release = document.getElementById("close_release_garbage_details_popup")

    close_release.addEventListener("click", function() {
        var releasePop = document.getElementById('release_garbage_details_popup');
        releasePop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";

    });

});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>