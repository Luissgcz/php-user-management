$(document).ready(function () {
  $(document).on("input", "#filterForm", function () {
    const value = $(this).val().trim();

    if (value === "") {
      $("#userTableContainer").empty();
      return;
    }

    $.ajax({
      url: "http://localhost/mvc/filter-users-for-send-msg",
      method: "GET",
      data: { search: value },
      success: function (res) {
        $("#userTableContainer").html(res);
      },
      error: function () {
        alert("Erro ao carregar usuários");
      },
    });
  });
});
