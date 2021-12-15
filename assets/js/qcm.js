var numQues = 3;
var numChoi = 4;

var answers = new Array();

function getScore(form) {
  var score = 0;
  var currElt;
  var currSelection;
  var bon = false;

  for (i=0; i<numQues; i++) {
    currElt = i*numChoi;
    bon=false;
    for (j=0; j<numChoi; j++) {
      currSelection = form.elements[currElt + j];
      if ((currSelection.checked)&&(answers[i].indexOf(currSelection.value) != -1)) {
        bon=true;}
      if ((currSelection.checked)&&(answers[i].indexOf(currSelection.value) == -1)) {
        bon=false;
        break;
        }
      if (!(currSelection.checked)&&(answers[i].indexOf(currSelection.value) != -1)) {
        bon=false;
        break;
        }
    }
    if (bon==true) {score++}
  }

  score = Math.round(score/numQues*100);
  form.percentage.value = score + "%";

  var correctAnswers = "";
  for (i=1; i<=numQues; i++) {
    correctAnswers += i + ". " + answers[i-1] + "\r\n";
  }
  form.solutions.value = correctAnswers;

}
