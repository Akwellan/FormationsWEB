
function demDelete(ours, chevre, id) {
  let text = 'Voulez-vous supprimer la formation : \"'+ours+'\" ainsi que toutes ces questions ?';
  if (window.confirm(text)) {
    document.location.href='?delete='+ours+'&video='+chevre+'&id='+id;
  }
}

function Retour() {
    document.location.href='/Formation/SiteWEB/admin/formations.php';
}
