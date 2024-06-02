const ajaxForms = document.querySelectorAll('.ajax_form');

function sendFormAjax(e) {
    e.preventDefault();

    let send = confirm("Deseas enviar el formulario?");
    
    if (send) {
        let data = new FormData(this);
        let method = this.getAttribute('method');
        let action = this.getAttribute('action');
        
        let headers = new Headers();

        let config = {
            method: method,
            Headers: headers,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };

        fetch(action, config)
        .then(response => response.text())
            .then(response => {
                let container = document.querySelector('.form-rest');
                container.innerHTML = response;
            });
            
    }
};

let container = document.querySelector('.form-rest');
let msg = '<div class="d-flex justify-content-center flex-column alert alert-succsess fs-5 text-center caquita" role="alert"> <strong>¡Usuario registrado con éxito!</strong><br></div>'
console.log(container.innerHTML)

if (container.innerHTML == msg) document.querySelector('.ajax-form').reset();

ajaxForms.forEach(form => {
    form.addEventListener('submit', sendFormAjax);
});
