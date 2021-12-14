<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>ICARE - QCM Bonne pratique</title>

<link rel="stylesheet" href="../assets/css/qcm.css" />


</head>
<body onload='init();'>
	<form action='#'>
		<table border='0'>
			<tr>
        <td colspan='3'>
          <div id='question'></div>
        </td>
      </tr>
			<tr><td colspan='3'><hr></td></tr>
			<tr>
  			<td style='text-align:left'><input type='button' id='btnPrec' value='<' onclick='prec();' disabled='true'></td>
  				<td>
            <div id='main'></div>
          </td>
  				<td style='text-align:right'>
            <input type='button' id='btnSuiv' value='>' onclick='suiv();'>
        </td>
			</tr>
			<tr>
        <td colspan='3'>
          <hr>
        </td>
      </tr>
			<tr>
        <td colspan='3'>
          <div id='details'>
          </div>
        </td>
      </tr>
		</table>
	</form>



  <script src="../assets/js/qcm.js"></script>

</body>
</html>
