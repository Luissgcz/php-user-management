$(document).on("submit", "#filterForm", function (event) {
  event.preventDefault();

  const formData = $(this).serialize();

  $.ajax({
    url: "http://31.97.163.121:8081/filter-users",
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
