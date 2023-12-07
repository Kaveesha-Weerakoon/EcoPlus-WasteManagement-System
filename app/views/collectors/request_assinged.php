<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">

    <div class="Collector_Request_Top">
        <div class="Collector_Reuqest_Assigned">
            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&callback=initMap" async
                defer></script>

            <div class="main">
                <div class="main-left">
                    <div class="main-left-top">
                        <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                        <h1>Eco Plus</h1>
                    </div>

                    <div class="main-left-middle">
                        <a href="<?php echo URLROOT?>/collectors">
                            <div class="main-left-middle-content ">
                                <div class="main-left-middle-content-line1"></div>
                                <img src="<?php echo IMGROOT?>/Home.png" alt="">
                                <h2>Dashboard</h2>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-left-middle-content current ">
                                <div class="main-left-middle-content-line"></div>
                                <img src="<?php echo IMGROOT?>/Request.png" alt="">
                                <h2>Requests</h2>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/collectors/collector_assistants">
                            <div class="main-left-middle-content Collector">
                                <div class="main-left-middle-content-line1"></div>
                                <img src="<?php echo IMGROOT?>/CollectorAssis.png" alt="">
                                <h2>Collector Assistants</h2>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/collectors/editprofile">
                            <div class="main-left-middle-content ">
                                <div class="main-left-middle-content-line1"></div>
                                <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                                <h2>Edit Profile</h2>
                            </div>
                        </a>

                    </div>
                    <div class="main-left-bottom">
                        <a href="<?php echo URLROOT?>/collectors/logout">
                            <div class="main-left-bottom-content">
                                <img src="<?php echo IMGROOT?>/logout.png" alt="">
                                <p>Log out</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-one-search">
                                <img src="<?php echo IMGROOT?>/Search.png" alt="">
                                <input id="searchInput" type="text" placeholder="Search">
                            </div>

                            <div class="main-right-top-one-content">
                                <p><?php echo $_SESSION['collector_name']?></p>
                                <img src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $_SESSION['collector_profile']?>"
                                    alt="">
                            </div>

                        </div>
                        <div class="main-right-top-two">
                            <h1>Requests</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="">
                                <div class="main-right-top-three-content">
                                    <p><b style="color: #1B6652;">Assigned</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/collectors/request_completed">
                                <div class="main-right-top-three-content">
                                    <p>Completed</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/collectors/request_cancelled">
                                <div class="main-right-top-three-content">
                                    <p>Cancelled</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                        </div>
                        <div class="main-right-top-four">
                            <div class="main-right-top-four-left">
                                <p>Date</p>
                                <input type="date" id="selected-date">
                                <button onclick="loadLocations()">Filter</button>
                            </div>
                            <div class="main-right-top-four-right">

                                <div class="main-right-top-four-component" style="background-color: #ecf0f1"
                                    id="tables">
                                    <img src="<?php echo IMGROOT?>/cells.png" alt="">
                                    <p>Tables</p>
                                </div>


                                <div class="main-right-top-four-component" id="maps">
                                    <img src="<?php echo IMGROOT?>/map.png" alt="">
                                    <p>Maps</p>
                                </div>


                            </div>
                        </div>
                    </div>
                    <?php if(!empty($data['assigned_requests'])) : ?>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-one" id="main-right-bottom-one">
                            <div class="main-right-bottom-top">
                                <table class="table">
                                    <tr class="table-header">
                                        <th>Req ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Customer</th>
                                        <th>C ID</th>
                                        <th>Contact No</th>
                                        <th>Instructions</th>
                                        <th>Complete</th>
                                        <th>Cancel</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">

                                <table class="table">
                                    <?php foreach($data['assigned_requests'] as $request) : ?>
                                    <tr class="table-row">
                                        <td>R<?php echo $request->req_id?></td>
                                        <td><?php  echo $request->date?></td>
                                        <td><?php  echo $request->time?></td>
                                        <td><?php  echo $request->name?></td>
                                        <td><?php  echo $request->customer_id?></td>
                                        <td><?php  echo $request->contact_no?></td>
                                        <td><?php  echo $request->instructions?></td>
                                        <td class="cancel-open">
                                            <a
                                                href="<?php echo URLROOT ?>/Collectors/enterWaste_And_GenerateEcoCredits/<?php echo $request->customer_id ?>">
                                                <img class="complete_image" src="<?php echo IMGROOT ?>/assign.png"
                                                    alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <img onclick="cancel(<?php echo $request->req_id ?>)" class="cancel"
                                                src="<?php echo IMGROOT?>/close_popup.png" alt="">
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>

                            </div>
                        </div>
                        <div class="main-right-bottom-two" id="main-right-bottom-two">
                            <div class="map-locations" id="map-loaction">

                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-content">
                            <img src="<?php echo IMGROOT?>/Center_Manager_Request_Assign_Empty.jpg" alt="">
                            <h1>You have No Assinged Requests</h1>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if($data['popup']=='True') : ?>
                <div class="personal-details-popup-box" id="personal-details-popup-box">
                    <div class="personal-details-popup-form" id="popup">
                        <div class="form-container">
                            <div class="form-title">Eco Credits Calculation</div>
                            <form action="<?php echo URLROOT;?>/collector/enterWaste_And_GenerateEcoCredits"
                                class="main-right-bottom-content" method="post">
                                <div class="user-details">
                                    <div class="left-details">
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Polythene</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-trash"></i>
                                                <input name="polythene_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['Polythene_err']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Plastic</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-box"></i>
                                                <input name="plastic_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['Plastic_err']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Glass</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-glass-whiskey"></i>
                                                <input name="glass_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['Glass_err']?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-details">
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Paper Waste</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-file-alt"></i>
                                                <input name="paper_waste_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['Paper_Waste_err']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Electronic Waste</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-laptop"></i>
                                                <input name="electronic_waste_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['Electronic_Waste_err']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Metals</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-box"></i>
                                                <input name="metals_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['Metals_err']?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wide-note">
                                        <div class="main-right-bottom-content-content A">
                                            <span class="details">Note</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-sticky-note"></i>
                                                <input name="note" class="note-input" type="text"
                                                    placeholder="Enter Note">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['Note_err']?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-button">
                                    <button type="submit">Calculate Eco Credits</button>
                                    <a href="<?php echo URLROOT?>/collectors/request_assinged"><button type="button"
                                            class="cancel-button">Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>


                <div class="cancel-confirm" id="cancel-confirm">
                    <form class="cancel-confirm-content" id="cancel-form" method="post"
                        action="<?php echo URLROOT?>/collectors/request_assinged">
                        <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                        <h2>Cancel the Request?</h2>
                        <p>This action will cancel the request </p>
                        <input name="reason" type="text" placeholder="Input the Reason">
                        <input name="id" type="text">
                        <div class="btns" id="btns">
                            <button onclick="validateCancelForm()" class="deletebtn">OK</button>
                            <button id="cancel-pop" type="button" class="cancelbtn">Cancel</button></a>
                        </div>

                    </form>
                </div>


            </div>

        </div>
    </div>
</div>

<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map-loaction'), {
        center: {
            lat: 7.8731,
            lng: 80.7718
        },
        zoom: 7.2
    });;
    var incomingRequests = <?php echo $data['jsonData']; ?>;
    incomingRequests.forEach(function(coordinate) {
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat(coordinate.lat),
                lng: parseFloat(coordinate.longi)
            },
            map: map,
            title: 'Marker'
        });
        marker.addListener('click', function() {
            handleMarkerClick(marker, coordinate);
        });
    });
}

function cancel($id) {
    var inputElement = document.querySelector('input[name="id"]');

    inputElement.style.display = 'none';

    inputElement.value = $id;
    document.getElementById("cancel-confirm").style.display = "flex";
    setTimeout(function() {
        document.getElementById("btns").style.display = "flex";
        document.querySelector("#cancel-confirm img").style.display = "flex";
        document.querySelector("#cancel-confirm h2").style.display = "flex";
        document.querySelector("#cancel-confirm input").style.display = "flex";
        document.querySelector("#cancel-confirm p").style.display = "flex";

    }, 350);

}

function validateCancelForm() {
    var reasonInput = document.getElementsByName("reason")[0].value;
    if (reasonInput.trim() === "" || reasonInput.split(/\s+/).length > 200) {
        alert("Please enter a reason");
    } else {
        document.getElementById("cancel-form").submit();
    }
}

function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');

    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
        var time = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
        var customer = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
        var cid = row.querySelector('td:nth-child(5)').innerText.toLowerCase();
        var conctact_no = row.querySelector('td:nth-child(6)').innerText.toLowerCase();
        var instructions = row.querySelector('td:nth-child(7)').innerText.toLowerCase();

        if (time.includes(input) || id.includes(input) || date.includes(input) || customer.includes(input) ||
            cid.includes(input) || conctact_no.includes(input) || instructions.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });


}

function handleMarkerClick(marker, coordinate) {
    const adddetails = document.getElementById("View");
    var assign_reqid = document.getElementById('assign_reqid');
    assign_reqid.innerHTML = coordinate.req_id;
    adddetails.style.display = "flex";
}

function loadLocations() {
    var selectedDate = document.getElementById('selected-date').value;
    if (selectedDate.trim() !== "") {
        updateMapForDate(selectedDate);

        var rows = document.querySelectorAll('.table-row');
        rows.forEach(function(row) {
            console.log('d');
            var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            if (date.includes(selectedDate)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    } else {
        var rows = document.querySelectorAll('.table-row');
        rows.forEach(function(row) {

            row.style.display = '';

        });

        var map = new google.maps.Map(document.getElementById('map-loaction'), {
            center: {
                lat: 7.8731,
                lng: 80.7718
            },
            zoom: 7.2
        });

        var incomingRequestsForDate = <?php echo $data['jsonData']; ?>;

        incomingRequestsForDate.forEach(function(coordinate) {
            var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(coordinate.lat),
                    lng: parseFloat(coordinate.longi)
                },
                map: map,
                title: 'Marker'
            });

            marker.addListener('click', function() {
                handleMarkerClick(marker);
            });
        });
    }
}

function updateMapForDate(selectedDate) {
    var map = new google.maps.Map(document.getElementById('map-loaction'), {
        center: {
            lat: 7.8731,
            lng: 80.7718
        },
        zoom: 7.2
    });

    var incomingRequestsForDate = <?php echo $data['jsonData']; ?>;
    var filteredRequests = incomingRequestsForDate.filter(function(coordinate) {
        return coordinate.date === selectedDate;
    });

    filteredRequests.forEach(function(coordinate) {
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat(coordinate.lat),
                lng: parseFloat(coordinate.longi)
            },
            map: map,
            title: 'Marker'
        });

        marker.addListener('click', function() {
            handleMarkerClick(marker);
        });
    });
}

document.addEventListener("DOMContentLoaded", function() {
    const maps = document.getElementById("maps");
    const table = document.getElementById("tables");
    const main_right_bottom = document.getElementById("main-right-bottom-one");
    const main_right_bottom_two = document.getElementById("main-right-bottom-two");
    const closeButton = document.getElementById("cancel-pop");
    const cancel_popup = document.getElementById("cancel-confirm");
    const cancel_form = document.getElementById("cancel-form");
    const btns = document.getElementById("btns");

    maps.addEventListener("click", function() {
        if (main_right_bottom !== null) {
            main_right_bottom.style.display = "none";
        }
        if (main_right_bottom_two !== null) {
            main_right_bottom_two.style.display = "flex";
        }
        maps.style.backgroundColor = "#ecf0f1";
        table.style.backgroundColor = "";
    });

    table.addEventListener("click", function() {
        if (main_right_bottom !== null) {
            main_right_bottom.style.display = "flex";
        }
        if (main_right_bottom_two !== null) {
            main_right_bottom_two.style.display = "none";
        }
        table.style.backgroundColor = "#ecf0f1";
        maps.style.backgroundColor = "";

    });

    closeButton.addEventListener("click", function() {
        cancel_form.style.width = "0px";
        cancel_form.style.height = "0px";
        cancel_popup.style.display = "none";
        btns.style.display = "none";
        document.querySelector("#cancel-confirm img").style.display = "none";
        document.querySelector("#cancel-confirm h2").style.display = "none";
        document.querySelector("#cancel-confirm input").style.display = "none";
        document.querySelector("#cancel-confirm p").style.display = "none";
    });

});

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>