<p class="text-end me-3 btn-back">
        <a href="#" class="btn btn-primary"><- Regresar atrás</a>
    </p>
    <script type="text/javascript">
        let btn_back = document.querySelector(".btn-back");

        btn_back.addEventListener('click', function (e) {
            e.preventDefault();
            window.history.back();
        });
    </script>