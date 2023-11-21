function handleCredentialResponse(response) {
    const data = jwtDecode(response.credential);

    // Enviar dados para o servidor usando AJAX
    const xhr = new XMLHttpRequest();
    const url = 'http://localhost:80/teste2/pagina_de_entrada.php';

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(data));
}

window.onload = function() {
    google.accounts.id.initialize({
        client_id: "823004310549-5kntcr67239n6iuqtn2mans9lag01vv9.apps.googleusercontent.com",
        callback: handleCredentialResponse,
        // context: "signin",
        ux_mode: "redirect",
        login_uri: "http://localhost:80/teste2/pagina_de_entrada.php", //url de redirecionamento após login
        // auto_select: "true",
        // itp_support: "true"
    });

    google.accounts.id.renderButton(
        document.getElementById("buttonDiv"), {
            theme: "outline",
            size: "large",
            type: "standard",
            shape: "pill",
            theme: "filled_black",
            text: "continue_with",
            size: "large",
            logo_alignment: "left"
        }
    );

    google.accounts.id.prompt();
}