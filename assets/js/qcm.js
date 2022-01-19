var numQues = 3;
var numChoi = 3;
var score = 0;
var user;
var nb_ques;

var answers = new Array();

function ConfirmMessage() {
   let URL = "../bdd/insert-reussi.php?db=formations&score="+score+"&name="+user+"&numQCM="+nb_ques;
   if (confirm("Avez vous fini le QCM ?")) {
       // Clic sur OK
       document.location.href=URL;
   }
}

function getScore(form) {
  score = 0;
  var currElt;
  var currSelection;
  var rempSelect = "";
  var bon = false;

  for (i=0; i<numQues; i++) {
    currElt = i*numChoi;
    bon=false;
    for (j=0; j<numChoi; j++) {
      currSelection = form.elements[currElt + j];
      rempSelect = currSelection.value;
      rempSelect = rempSelect.replaceAll("'", "\'");
      if ((currSelection.checked)&&(answers[i].indexOf(rempSelect) != -1)) {
        bon=true;}
      if ((currSelection.checked)&&(answers[i].indexOf(rempSelect) == -1)) {
        bon=false;
        break;
        }
      if (!(currSelection.checked)&&(answers[i].indexOf(rempSelect) != -1)) {
        bon=false;
        break;
        }
    }
    if (bon==true) {score++}
  }

  score = Math.round(score/numQues*100);
  //form.percentage.value = score + "% - "+ user+ " - "+ nb_ques;

}

function main(form) {
  getScore(form);
  ConfirmMessage();
}
