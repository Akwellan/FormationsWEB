<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="../assets/css/qcm.css" />

<body>

  <div class="container">
    <div id="quiz">
      <h1><span>Q</span>uiz <i class="far fa-question-circle"></i></h1>

      <h2 id="question"></h2>

      <h3 id="score"></h3>

      <div class="choices">
        <button id="guess0" class="btn">
          <p id="choice0"></p>
        </button>

        <button id="guess1" class="btn">
          <p id="choice1"></p>
        </button>

        <button id="guess2" class="btn">
          <p id="choice2"></p>
        </button>

        <button id="guess3" class="btn">
          <p id="choice3"></p>
        </button>
      </div>

      <p id="progress"></p>

    </div>
  </div>

</body>

<script src="../assets/js/qcm.js"></script>

</html>
