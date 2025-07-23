$(document).ready(function () {
  $(document).on("input", "#filterForm", function () {
    const value = $(this).val().trim();

    if (value === "") {
      $("#userTableFilter").empty();
      return;
    }

    $.ajax({
      url: "https://php-user-management-production.up.railway.app/filter-users-for-send-msg",
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
