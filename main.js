function handleCredentialResponse(response) {
    const data = jwtDecode(response.credential);
    console.log(data);

    // Enviar dados para o servidor usando AJAX
    const xhr = new XMLHttpRequest();
    const url = 'recebeGoogle.php';

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(data));
}

window.onload = function() {
    google.accounts.id.initialize({
        client_id: "823004310549-5kntcr67239n6iuqtn2mans9lag01vv9.apps.googleusercontent.com",
        callback: handleCredentialResponse
    });

    google.accounts.id.renderButton(
        document.getElementById("buttonDiv"), {
            theme: "outline",
            size: "large"
        }
    );

    google.accounts.id.prompt();
}