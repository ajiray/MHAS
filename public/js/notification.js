// var csrfToken = document.documentElement.dataset.csrf; // Incorrect
var csrfToken = document.documentElement.dataset.csrf; // Correct

function fadeOutAlert(alertId) {
    setTimeout(function() {
        var alert = document.getElementById(alertId);
        if (alert) {
            alert.style.transition = "opacity 1s";
            alert.style.opacity = 0;
            setTimeout(function() {
                alert.style.display = "none";
            }, 1000);
        }
    }, 2500); // 2500 milliseconds (2.5 seconds)
}

// Call the fadeOutAlert function for each alert message
fadeOutAlert("alert");

function toggleNotifications() {
    // Get the CSRF token from the meta tag

    // Make an AJAX request to update the read_at column
    $.ajax({
        url: "/mark-notifications-as-read",
        method: "POST",
        data: {
            _token: csrfToken
        },
        success: function(response) {
            // Update the UI as needed
            var notificationsContainer = document.getElementById('notificationsContainer');
            notificationsContainer.classList.toggle('hidden');
            // You can update the notification count or any other UI element here
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}

function copyToClipboard(text) {
    // Update the value of the 'meetingId' input with the copied text
    var input = document.getElementById('meetingId');
    input.value = text;
}
