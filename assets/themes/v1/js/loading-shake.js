$("button").on("click", function(e) {
    e.preventDefault();
    $(".login-page").addClass("headShake");
    setTimeout(function() {
        $(".login-page").removeClass("headShake");
    }, 500);
});
