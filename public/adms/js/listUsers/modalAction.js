$(document).on("show.bs.modal", "#modalEditUser", function (event) {
  const button = $(event.relatedTarget); // botão que abriu o modal
  const userId = button.data("user-id");
  const name = button.data("user-name");
  const email = button.data("user-email");
  const token = button.data("user-token");
  const modal = $(this); // o modal que vai abrir

  // Define o valor do input escondido no modal
  modal.find("#user_id").val(userId);
  modal.find("#name").val(name);
  modal.find("#email").val(email);
  modal.find("#csfr_tokens").val(token);
  console.log(userId);
  console.log(name);
  console.log(email);
  console.log(token);
});

$(document).on("submit", "#formEditUser", function (event) {
  event.preventDefault();
  const form = $(this);
  const formData = form.serialize();

  const userId = form.find("#user_id").val();

  $.ajax({
    url: ` http://31.97.163.121:8081/edit-user/${userId}`,
    method: "POST",
    data: formData,
    dataType: "json",
    success: function (res) {
      if (res.success) {
        alert("Usuário Atualizado com Sucesso");
        $("#modalEditUser").modal("hide");
        location.reload();
      } else {
        alert(res.message);
        location.reload();
      }
    },
    error: function () {
      alert("Erro ao Atualizar os Dados");
    },
  });
});

$(document).on("show.bs.modal", "#modalDeleteUser", function (event) {
  const button = $(event.relatedTarget); // botão que abriu o modal
  const userId = button.data("user-id"); // valor do atributo data-user-id
  const token = button.data("user-token");
  const modal = $(this); // o modal que vai abrir
  console.log(userId);

  // Define o valor do input escondido no modal
  modal.find("#user_id").val(userId);
  modal.find("#csfr_tokens").val(token);
});

$(document).on("submit", "#formDeleteUser", function (event) {
  event.preventDefault();
  const form = $(this);
  const formData = form.serialize();
  // Pega o user_id corretamente do próprio formulário
  const userId = form.find("#user_id").val();

  $.ajax({
    url: ` http://31.97.163.121:8081/delete-user/${userId}`,
    method: "POST",
    data: formData,
    dataType: "json",
    success: function (res) {
      if (res.success) {
        alert("Usuário Deletado com Sucesso");
        $("#modalEditUser").modal("hide");
        location.reload();
      } else {
        alert("Erro ao Deletar Usuário " + res.message);
      }
    },
    error: function (e) {
      alert("Erro ao enviar os dados");
      console.log(e);
    },
  });
});

$(document).on("show.bs.modal", "#modalViewUser", function (event) {
  const button = $(event.relatedTarget); // botão que abriu o modal
  const userId = button.data("user-id"); // valor do atributo data-user-id
  const name = button.data("user-name"); // valor do atributo data-user-id
  const email = button.data("user-email"); // valor do atributo data-user-id
  const password = button.data("user-password"); // valor do atributo data-user-id
  const created_at = button.data("user-created"); // valor do atributo data-user-id
  const updated_at = button.data("user-updated"); // valor do atributo data-user-id
  const modal = $(this); // o modal que vai abrir

  // Define os valores no modal de visualização
  modal.find("#user_id").val(userId); // se for input hidden, continua com .val()
  modal.find("#user_name").text(name);
  modal.find("#user_email").text(email);
  modal.find("#password").text(password);
  modal.find("#user_created_at").text(created_at);

  if (updated_at) {
    modal.find("#user_updated_at").text(updated_at);
    modal.find("#updated_at_container").show();
  } else {
    modal.find("#updated_at_container").hide();
  }
});
