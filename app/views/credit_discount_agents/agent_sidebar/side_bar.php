<div class="main-left">
    <div class="main-left-top">
        <img id="top_logo" src="<?php echo IMGROOT?>/Logo.png" alt="logo">
        <h3>ECO PLUS</h3>
    </div>
    <div class="main-left-middle">
        <h1>OVERVIEW</h1>
        <div class="main-left-middle-content" onclick="redirect_dashboard()" id="dashboard">
            <div class=" main-left-middle-content-icon">
                <i class='bx bxs-dashboard'></i>
            </div>
            <h3>Dashboard</h3>
        </div>
        <div class="main-left-middle-content" onclick="redirect_API()" id="api">
            <div class=" main-left-middle-content-icon">
                <i class='bx bx-send'></i>
            </div>
            <h3>API</h3>
        </div>
        <div class="main-left-middle-content" onclick="redirect_history()" id="history">
            <div class=" main-left-middle-content-icon">
                <i class='bx bx-timer'></i>
            </div>
            <h3>History</h3>
        </div>
        <div class="main-left-middle-content" onclick="redirect_edit_profile()" id="edit_profile">
            <div class="main-left-middle-content-icon">
                <i class='bx bx-user-pin'></i>
            </div>
            <h3>Profile</h3>
        </div>

    </div>
    <div class="main-left-down">
        <h1>SETTINGS</h1>
        <a href="<?php echo URLROOT?>/CreditDiscountsAgent/logout">

            <div class="main-left-middle-content">
                <div class="main-left-middle-content-icon">
                    <i style="color:#F13E3E" class='bx bx-log-out'></i>
                </div>
                <h3 style="color:#F13E3E">Logout</h3>
            </div>
        </a>

        <div class="main-left-middle-content">
            <div class="main-left-middle-content-icon">
                <i class='bx bx-moon'></i>
            </div>
            <h3>Dark Mode</h3>
            <div class="toggle-container">
                <input type="checkbox" id="toggle-checkbox">
                <label class="toggle-button" for="toggle-checkbox">
                    <div class="toggle-indicator"></div>
                </label>
            </div>
        </div>
    </div>
</div>

<script>
let myChart;

function redirect_dashboard() {
    var linkUrl = "<?php echo URLROOT?>/CreditDiscountsAgent"; // Replace with your desired URL
    window.location.href = linkUrl;
}

function redirect_API() {
    var linkUrl = "<?php echo URLROOT?>/CreditDiscountsAgent/validateUser"; // Replace with your desired URL
    window.location.href = linkUrl;
}

function redirect_history() {
    var linkUrl = "<?php echo URLROOT?>/CreditDiscountsAgent/history"; // Replace with your desired URL
    window.location.href = linkUrl;
}

function redirect_edit_profile() {
    var linkUrl = "<?php echo URLROOT?>/CreditDiscountsAgent/editprofile"; // Replace with your desired URL
    window.location.href = linkUrl;
}
var checkbox = document.getElementById('toggle-checkbox');

function setDarkModeStyle(isDarkMode) {
    const root = document.documentElement;
    const logo = document.getElementById('top_logo');
    const textColor = isDarkMode ? "#fff" : "#414143";
    const color = isDarkMode ? "#fff" : "#47b076";
    const progressStartValue = 0;

    root.style.setProperty("--background-color-main", isDarkMode ? "#001f3f" : "#fff");
    root.style.setProperty("--background-color-right", isDarkMode ? "#001f3f" : "#fbfbfb");
    root.style.setProperty("--main-text-color", isDarkMode ? "#fff" : "#414143");
    root.style.setProperty("--green-color-one", isDarkMode ? "#fff" : "#1ca557");
    root.style.setProperty("--green-color-two", isDarkMode ? "#fff" : "#47b076");
    root.style.setProperty("--notification-hover", isDarkMode ? "#1ca557" : "#64d798");
    root.style.setProperty("--background-color-two", isDarkMode ? "#001f3f" : "#f5f6fa");
    root.style.setProperty("--yellow-color", isDarkMode ? "#fff" : "#f6e58d");

    root.style.setProperty("--box-shadow", isDarkMode ? "0.5px 0.5px 1px 0.5px rgba(255, 255, 255, 1)" :
        "0 1px 1px 0px rgba(0, 0, 0, 0.1)");
    root.style.setProperty("--table-header", isDarkMode ? "#001f3f" : "#e9f6ef");
    logo.style.display = isDarkMode ? "none" : "flex";
    // circularProgress.style.background =
    //     `conic-gradient(${color}, ${progressStartValue * 3.6}deg, ${isDarkMode ? "#001f3f" : "#ededed"} 0deg)`;
}

function getDarkModeSetting() {
    const storedValue = localStorage.getItem("darkMode");
    return storedValue ? JSON.parse(storedValue) : true;
}

const initialDarkModeSetting = getDarkModeSetting();
checkbox.checked = initialDarkModeSetting;

setDarkModeStyle(initialDarkModeSetting);
checkbox.addEventListener("change", function() {
    const isDarkMode = checkbox.checked;
    setDarkModeStyle(isDarkMode);
    console.log("as");

    localStorage.setItem("darkMode", JSON.stringify(isDarkMode));
});
</script>