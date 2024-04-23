<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Mail_Subscriptions">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>

                    <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                </div>

                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Mail Subscriptions</h1>
                    </div>
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Subscription Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date & Time</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">

                        <table class="table">
                            <?php foreach($data['subscriptions'] as $subscription) : ?>
                            <tr class="table-row">
                                <td>S<?php echo $subscription->id?></td>
                                <td><?php echo $subscription->name?></td>
                                <td><?php echo $subscription->email?></td>
                                <td><?php echo $subscription->date_time?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>

                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
<script>
function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');
    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var status = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
        var date = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
        var time = row.querySelector('td:nth-child(4)').innerText.toLowerCase();


        if (id.includes(input) || status.includes(input) || date
            .includes(
                input) || time.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });

}

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>