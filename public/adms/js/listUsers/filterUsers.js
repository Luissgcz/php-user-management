$(document).on("submit", "#filterForm", function (event) {
  event.preventDefault();

  const formData = $(this).serialize();

  $.ajax({
    url: "http://localhost:8080/filter-users",
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
