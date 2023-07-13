<style type="text/css">
    .loader {
        position: fixed;
        left: 240px;
        top: 0px;
        width: -webkit-fill-available;
        height: -webkit-fill-available;
        z-index: 9999;
        background: center / contain no-repeat url('<?= base_url() ?>media/imagenes/cargando.gif'), 50% 50%, rgb(249, 249, 249);
        background-size: inherit;
        opacity: .8;
        display: none;
    }

    @media screen and (max-width: 991px) {
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: -webkit-fill-available;
            height: -webkit-fill-available;
            z-index: 9999;
            background: center / contain no-repeat url('<?= base_url() ?>media/imagenes/cargando.gif'), 50% 50%, rgb(249, 249, 249);
            background-size: inherit;
            opacity: .8;
            display: none;
        }
    }
</style>