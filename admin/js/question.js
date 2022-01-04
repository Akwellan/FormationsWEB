
function demDelete(ours, id,id_forma,titre_forma) {
  let text = 'Voulez-vous supprimer la question : \"'+ours+'\" ?';
  if (window.confirm(text)) {
    document.location.href='?delete='+ours+'&id='+id+'&id_forma='+id_forma+'&titre_forma='+titre_forma;
  }
}

function Retour() {
    document.location.href='/Formation/SiteWEB/admin/questions.php';
}
