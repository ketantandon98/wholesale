<section class='container'>
    <div class="success-text">Sorry there was an issue with your payment info.</div>
    This page will redirect you to the homepage in <span id="countdown">10</span> seconds.
</section>


<script>
    // Function to start the countdown
    function startCountdown() {
        var count = 10;
        var countdownElement = document.getElementById("countdown");

        var countdownInterval = setInterval(function () {
            countdownElement.innerHTML = count;
            count--;

            if (count < 0) {
                clearInterval(countdownInterval);
                setTimeout(function () {
                    window.location.href = "/wholesale";
                }, 1000);
            }
        }, 1000);
    }

    window.onload = startCountdown;
</script>