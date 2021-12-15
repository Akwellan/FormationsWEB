<link rel="stylesheet" href="../assets/css/main.css" />
<link rel="stylesheet" href="../assets/css/checkbox.css" />

<form style="" name="quiz">
  <b>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b><br>
  <input type="checkbox" name="q1" value="Praesent ">Praesent69 <br>
  <input type="checkbox" name="q1" value="hendrerit">hendrerit<br>
  <input type="checkbox" name="q1" value="accumsan ">accumsan <br>
  <input type="checkbox" name="q1" value="Curabitur ">Curabitur <br>

    <div class="form-group">
      <input type="checkbox" id="css">
      <label for="css">CSS</label>
    </div>
    <div class="form-group">
      <input type="checkbox" id="javascript">
      <label for="javascript">Javascript</label>
    </div>
  <p>

  <b>2. Pellentesque dignissim vehicula mauris, eget ornare nunc lobortis ac. </b><br>
  <input type="checkbox" name="q2" value="orci">orci<br>
  <input type="checkbox" name="q2" value="sed ">sed <br>
  <input type="checkbox" name="q2" value="Praesent ">Praesent <br>
  <input type="checkbox" name="q2" value="pharetra">pharetra<br>
  <p>

  <b>3. Duis venenatis libero vestibulum cursus pharetra. Nam quis nunc orci.</b><br>
  <input type="checkbox" name="q3" value="Curabitur ">Curabitur <br>
  <input type="checkbox" name="q3" value="congue ">congue <br>
  <input type="checkbox" name="q3" value="ullamcorper ">ullamcorper <br>
  <input type="checkbox" name="q3" value="Praesent ">Praesent <br>
  <p>

  <input type="button" value="Score" onClick="getScore(this.form)">
  <input type="reset" value="RAZ"><p>
    Score = <input type=text size=15 name="percentage"><br>
    Réponses correctes :<br>
  <textarea name="solutions" wrap="virtual" rows="4" cols="40"></textarea>

</form>
