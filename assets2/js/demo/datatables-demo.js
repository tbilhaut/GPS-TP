// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});

// Capturez le login lorsque le bouton "Modifier" est cliqué
$('#modifierModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var loginToModify = button.data('login');
  var modal = $(this);
  modal.find('#loginToModify').val(loginToModify);
});

// Capturez le login lorsque le bouton "Supprimer" est cliqué
$('#supprimerModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var loginToDelete = button.data('login');
  var modal = $(this);
  modal.find('#loginToDelete').val(loginToDelete);
});