<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <!-- document.addEventListener('DOMContentLoaded', () => {
            
            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            
            // Add a click event on each of them
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementById(target);
                
                // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
                
            });
        });

    }); -->
    <!-- <script src="../js/ajax.js"></script> -->
 <script>
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
    
    ajaxForms.forEach(form => {
        form.addEventListener('submit', sendFormAjax);
    });
    
</script>