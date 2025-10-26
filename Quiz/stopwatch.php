<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stylish Countdown Timer</title>
    <style>
      .timing {
        font-family: "Arial", sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
      .countdown {
        text-align: center;
      }
      #time {
        font-size: 100px;
        font-weight: bold;
        margin-bottom:40px;
        border:10px solid orange;
        border-radius:50%;
        background-color: black;
        color:white;
      }
      
      #resetBtn,#startBtn {
        visibility:hidden;
      }
    </style>
  </head>
  <body>
    <div class="countdown">
      <div id="time">00</div>
      <button id="startBtn">Start</button>
      <button id="resetBtn">Reset</button>
    </div>

    <script>
      let countdown;
      let isCounting = false;
      let remainingTime = <?php echo substr(@$_GET['sec'],0,2);?>; // 20 seconds in milliseconds (600000 ms)

      const timeDisplay = document.getElementById("time");
      const startBtn = document.getElementById("startBtn");
      const resetBtn = document.getElementById("resetBtn");
      function formatTime(time) {
        const seconds = String(time).padStart(2, "0");
        return `${seconds}`;
      }

      function updateCountdown() {
        remainingTime -= 1;
        if(remainingTime==0)
        nextQ();
        if (remainingTime <= -1) {
          clearInterval(countdown);
          remainingTime = -1;
          resetBtn.click();
          startBtn.click();
          isCounting = false;
        }
        timeDisplay.textContent = formatTime(remainingTime);
      }

      startBtn.addEventListener("click", function () {
        if (isCounting) {
          clearInterval(countdown);
        } else {
          countdown = setInterval(updateCountdown, 1000);
        }
        isCounting = !isCounting;
      });
      startBtn.click();
      resetBtn.addEventListener("click", function () {
        clearInterval(countdown);
        remainingTime = <?php echo substr(@$_GET['sec'],0,2);?> // Reset to 10 minutes
        timeDisplay.textContent = formatTime(remainingTime);
        isCounting = false;
      });

      timeDisplay.textContent = formatTime(remainingTime);
    </script>
  </body>
</html>
