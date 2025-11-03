$(document).ready(function () {
  $(document).on("input", "#filterForm", function () {
    const value = $(this).val().trim();

    if (value === "") {
      $("#userTableFilter").empty();
      return;
    }

    $.ajax({
      url: "http://31.97.163.121:8081/filter-users-for-send-msg",
      method: "GET",
      data: { search: value },
      success: function (res) {
        $("#userTableFilter").html(res);
      },
      error: function () {
        alert("Erro ao carregar usuários");
      },
    });
  });
});
