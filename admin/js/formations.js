
function demDelete(ours, chevre) {
  let text = 'Voulez-vous supprimer la formation : '+ours;
  if (window.confirm(text)) {
    document.location.href='?delete='+ours+'&video='+chevre;
  }
}

function Retour() {
    document.location.href='/Formation/SiteWEB/admin/formations.php';
}
