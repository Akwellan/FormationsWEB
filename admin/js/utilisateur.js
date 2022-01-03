function ConfirmMessage() {
   let URL = "../bdd/insert-reussi.php?db=formations&score="+score+"&name="+user+"&numQCM="+nb_ques;
   if (confirm("Avez vous fini le QCM ?")) {
       // Clic sur OK
       document.location.href=URL;
   }
}

function demDelete(ours) {
  let text = 'Voulez-vous supprimer l\'utilisateur : '+ours;
  if (window.confirm(text)) {
    document.location.href='?delete='+ours;
  }
}

function Retour() {
    document.location.href='/Formation/SiteWEB/admin/users.php';
}
