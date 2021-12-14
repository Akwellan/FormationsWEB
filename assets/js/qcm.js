var aff_courant;
var nbFaites = 0;
var correction_auto = 0; // pas de correction automatique = 0, sinon 1
var separateur = '|';

function init(){
	nbFaites = 0;
	aff_courant = 0;
	affichage(aff_courant);
	document.getElementById('btnPrec').disabled = true;
	document.getElementById('btnSuiv').disabled = false;
	document.getElementById('btnPrec').style.visibility = 'visible';
	document.getElementById('btnSuiv').style.visibility = 'visible';
	document.getElementById('btnPrec').style.display = 'inline';
	document.getElementById('btnSuiv').style.display = 'inline';
	if(correction_auto==1){
		document.getElementById('btnPrec').style.visibility = 'hidden';
	}
};

var questions = new Array();
var no = 0;
questions[no++] = ['Lorem ipsum dolor sit amet','test|miaou|france','0|1'];
questions[no++] = ['Pellentesque porttitor mollis mauris, sit amet interdum erat pellentesque ut. Sed et arcu quis mi interdum porta. Nunc sit amet velit velit. Duis sed eros at dui congue elementum.','oauis|sterne|j&#39;aime le vo','1'];
questions[no++] = ['Vivamus porta porta sem eget porttitor. Aenean laoreet maximus turpis nec facilisis. Pellentesque a neque aliquam, cursus odio quis, ultrices lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.','tests|fdgfdgf|6355','1|2'];
questions[no++] = ['Praesent tellus dolor, auctor nec sapien non, efficitur mattis sem. Mauris enim lorem, rhoncus vel luctus a, scelerisque quis justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus mollis, ante vel tristique sagittis, purus arcu eleifend eros, eget ornare ante dolor vel ante. Integer tristique nunc nec vulputate consequat. Sed faucibus in lacus sed tempor. Aliquam fringilla placerat velit, eget imperdiet mauris pharetra nec. Maecenas ac ipsum at libero tincidunt consectetur id nec arcu. Aenean quis luctus felis. Donec sed lacus non nibh elementum molestie vel at sem. Aenean mattis nisi nulla, ac molestie ex tempus at. Ut nec odio blandit, commodo felis vel, cursus diam. Cras non dignissim dolor. Duis massa nunc, bibendum ac ex quis, finibus dignissim dolor. Aliquam erat volutpat. Duis sodales mattis lectus, sit amet ultrices lectus fringilla vel.','gdfgf|63|Amerique du sud|France|632062','0|3|4'];
questions[no++] = ['Nunc felis nisi, euismod sit amet rutrum vel, gravida condimentum mi.','852158|551|521','1'];
questions[no++] = ['Donec bibendum, orci eu accumsan ultrices, magna turpis tempus tellus, in efficitur est tellus eget mi. Nulla ac nulla sit amet risus mollis porta eu vitae nisl. Duis sollicitudin interdum enim, ac consectetur urna imperdiet at. Aenean luctus faucibus faucibus. Fusce rhoncus ligula sit amet nulla varius, et pharetra odio commodo. Cras a commodo magna. Nam condimentum lectus sed massa facilisis, eget dictum ex lacinia.','sgfd|695|rthyu','0|1|2'];

function shuffle(a){
   var j = 0; var valI = ''; var valJ = valI; var l = a.length - 1;
   while(l > -1){
	   j = Math.floor(Math.random() * l); valI = a[l];valJ = a[j];a[l] = valJ; a[j] = valI; l = l - 1;
   }
   return a;
}
questions = shuffle(questions);

reponses = new Array();

function affichage(index){
	titre = '<h4>Question ' + (index + 1) + ' sur ' + (questions.length) + '</h4><br><p>Une ou plusieurs réponses sont attendues.</p>';
	document.getElementById('question').innerHTML = titre;
	var main;
	main = '<li> ' + questions[index][0] + '</li><br>';
	choix = questions[index][1].split(separateur);
	if (choix.length > 1){
		if (questions[index][2].split(separateur).length>1){
			for (x=0;x<choix.length;x++){main += '<input type="checkbox" id="rep' + x + '" value="'+x+'"> ' + choix[x] + '<br>';}
		}
		else{
			for (x=0;x<choix.length;x++){
				main += '<input type="radio" name="rep" id="rep'+x+'" value="'+x+'"';
				main += '> ' + choix[x] + '<br>';
			}
		}
	}
	else{main += '<input type="text" id="reponse" style="width:100%;">';}
	document.getElementById('main').innerHTML = main;
	rafraichir_details('courant');
};

function aff_resultat(){
document.getElementById('btnPrec').style.display = 'none';
document.getElementById('btnSuiv').style.display = 'none';
	titre = '<h4 style="font-size:120%;font-weight:bold;">Résultats</h4>';
	document.getElementById('question').innerHTML = titre;
	var main;
	main = '<table border="1">';
	main += '<tr><td><b>Réponses données</b></td><td><b>Réponses attendues</b></td></tr>';
	for (x=0;x<reponses.length;x++){
		main += '<tr><td colspan="2" class="quest"><i>'+(x+1)+'. '+(questions[x][0])+'</i></td></tr>';
		if (questions[x].length > 2){
			main += '<tr><td id="ga'+x+'">';
			numeros1 = reponses[x].split(separateur);
			textes = questions[x][1].split(separateur);
			for (y=0;y<numeros1.length;y++){main += textes[numeros1[y]] + ', ';}
			main = main.substring(0,main.length-2);
			main += '</td><td id="dr'+x+'">';
			numeros2 = questions[x][questions[x].length-1].split(separateur);
			for (y=0;y<numeros2.length;y++){main += textes[numeros2[y]] + ', ';}
			main = main.substring(0,main.length-2);
			if(main.indexOf('undefined') != -1){main = main.replace('undefined','<span class="noResponse">(pas de réponse)</span>');}
			main += '</td></tr>';
		}
		else if (questions[x].length < 3){
			if(reponses[x] ==''){reponses[x] = "<span class='noResponse'>(pas de réponse)</span>";}
			main += '<tr><td id="ga'+x+'">' + reponses[x] + '</td>';
			main += '<td id="dr'+x+'">' + questions[x][1] + '</td></tr>';
		}
	}
	main += '</table>';
	main += '<br><input type="button" value="Recommencer" onclick="init();">';
	document.getElementById('main').innerHTML = main;
	for (x=0;x<reponses.length;x++){
		if(document.getElementById('ga'+x).innerText == document.getElementById('dr'+x).innerText){
			document.getElementById('ga'+x).style.backgroundColor = 'lime';
			document.getElementById('ga'+x).style.color = 'white';
		}
		else if(document.getElementById('ga'+x).innerText != '(pas de réponse)'){
			document.getElementById('ga'+x).style.backgroundColor = 'red';
		}
	}
	rafraichir_details('final');
};

function rafraichir_details(moment){
	if (aff_courant > nbFaites){nbFaites = aff_courant;}
	nbBonneRep = 0;
	if (correction_auto == 1 || moment == 'final'){
		for (x=0;x<nbFaites;x++){
			if (reponses[x] == questions[x][(questions[x].length-1)] ||reponses[x] == questions[x][1]){nbBonneRep += 1;}
		}
		var details;
		details = '<span style="color:red;font-weight:bold;">Score ' + moment + ' : '  + nbBonneRep + ' / ' + nbFaites + '</span>';
		if (aff_courant != 0){details += ' (' + Math.round((nbBonneRep/nbFaites*100)*10)/10 + '%)';}
	}
	else{details = ' ';}
	document.getElementById('details').innerHTML = details;
};

function suiv(){
	enregistre_rep();
	if (aff_courant < questions.length - 1){
		aff_courant += 1;
		affichage(aff_courant);
		if (correction_auto == 1){
			document.getElementById('btnPrec').disabled = true;
			document.getElementById('btnPrec').style.visibility = 'hidden';
		}
		else{
			document.getElementById('btnPrec').disabled = false;
			document.getElementById('btnPrec').style.visibility = 'visible';
		}
	}
	else if (aff_courant == questions.length-1){
		aff_courant += 1;
		aff_resultat();
		document.getElementById('btnPrec').disabled = true;
		if(correction_auto==1){document.getElementById('btnPrec').style.visibility = 'hidden';}
		document.getElementById('btnSuiv').disabled = true;
	}
};

function prec(){
	enregistre_rep();
	if (aff_courant > -1){
		aff_courant -= 1;
		affichage(aff_courant);
		document.getElementById('btnSuiv').disabled = false;
		if (aff_courant == 0){document.getElementById('btnPrec').disabled = true;}
		if(correction_auto==1){document.getElementById('btnPrec').style.visibility = 'hidden';}
	}
};

function enregistre_rep(){
	rep = '';
	if (aff_courant != questions.length){
		choix = questions[aff_courant][1].split(separateur);
		if (choix.length > 1){
			for (x=0;x<choix.length;x++){
				if (document.getElementById('rep'+x).checked){rep += x + separateur;}
			}
			rep = rep.substring(0,rep.length-1);
		}
		else{rep += document.getElementById('reponse').value;}
		reponses[aff_courant] = rep;
	}
};
