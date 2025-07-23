$(document).on("submit", "#filterForm", function (event) {
  event.preventDefault();

  const formData = $(this).serialize();

  $.ajax({
    url: "https://php-user-management-production.up.railway.app/filter-users",
    method: "POST",
    data: formData,
    success: function (res) {
      $("#userTableContainer").html(res);
    },
    error: function () {
      alert("Erro ao Carregar Usuário");
    },
  });
});
