var csrfToken = document.documentElement.dataset.csrf;

function confirmDeletePost(postId) {
    if (confirm('Are you sure you want to delete this post?')) {
        document.getElementById('delete-form-' + postId).submit();
    }
}

function showCommentPopup(postId) {
    
    var modal = document.getElementById("commentSection-" + postId);
    modal.classList.toggle("hidden"); // Toggle the 'hidden' class to show/hide the modal
}

function confirmDeleteComment(commentId) {
    if (confirm("Are you sure you want to delete this comment?")) {
        // Trigger the form submission
        document.getElementById("delete-form-comment-" + commentId).submit();
    }
}


function updateReactionCount(postId, reactionType) {
    $.ajax({
        url: `/reaction-count/${postId}/${reactionType}`,
        method: "GET",
        success: function(response) {
            $(`#reaction-count-${reactionType}-${postId}`).text(response.count);
        },
        error: function(error) {
            console.error(error);
            // Handle errors here (e.g., display an error message)
        },
    });
}


function react(postId, reactionType, color, button) {
    // Toggle the button's color immediately
    $(button).toggleClass(`text-gray-500 text-${color}`);

    // Send an AJAX request to the respective reaction route
    $.ajax({
        url: `/${reactionType}React/${postId}`,
        method: "POST",
        data: {
            _token: csrfToken
        },
        success: function(response) {
            // Handle any success response here (if needed)
            console.log(response);
        },
        error: function(error) {
            // Handle any errors here (if needed)
            console.error(error);
            // Revert the button's color if there was an error
            $(button).toggleClass(`text-${color} text-gray-500`);
        },
    });
    updateReactionCount(postId, reactionType);
}


