// Confirmar antes de excluir o evento
function confirmDelete() {
    return confirm("Tem certeza que deseja excluir este evento?");
}

// Validação do formulário (caso necessário)
document.querySelector("form").addEventListener("submit", function(event) {
    let isValid = true;
    const formElements = this.querySelectorAll("input, textarea, select");

    // Verificando se todos os campos obrigatórios foram preenchidos
    formElements.forEach(function(element) {
        if (element.required && !element.value) {
            isValid = false;
            alert("Por favor, preencha todos os campos obrigatórios!");
        }
    });

    if (!isValid) {
        event.preventDefault();  // Impede o envio do formulário
    }
});
