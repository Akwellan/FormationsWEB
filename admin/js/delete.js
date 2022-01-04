
function demDelete(ours, chevre) {
  let text = 'Voulez-vous supprimer les questions de la formation : '+ours;
  if (window.confirm(text)) {
    document.location.href='?delete='+chevre;
  }
}

function Retour() {
    document.location.href='/Formation/SiteWEB/admin/formations.php';
}
