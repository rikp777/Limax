<template>
<footer class="page-footer">
    <div class="footer-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{ new Date().getFullYear() }}

                        <a href="http://www.limax.nl" target="_blank">Limax</a>
                        . {{ $t("footer.allRightReserved") }}

                    </span>
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                        {{ $t("footer.madeBy") }}
                        <a href="http://www.linkedin.com/in/rikpeeters-nl" target="_blank">Rik Peeters</a>
                        &
                        <a href="https://www.linkedin.com/in/tomvvegchel/" target="_blank">Tom van Vegchel</a>
                    </span>

                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ul class="breadcrumb pt-0 pr-0 float-right">
                        <li class="breadcrumb-item mb-0">
<!--                            <span class="text-muted float-none float-sm-right d-block mt-1 mt-sm-0 text-center">{{ $t("footer.handMade") }} <i class="simple-icon-heart font-weight-bolder" style="color: #eb5b65"></i></span>-->
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                                {{ $t("footer.madeBy") }}
                                <a href="http://www.linkedin.com/in/rikpeeters-nl" target="_blank">Rik Peeters</a>
                                &
                                <a href="https://www.linkedin.com/in/tomvvegchel/" target="_blank">Tom van Vegchel</a>
                            </span>
                        </li>
<!--                        <router-link tag="a" to="/app/dashboards/default" class="breadcrumb-item mb-0">-->
<!--                            {{$t('menu.docs.main')}}-->
<!--                        </router-link>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
</template>
<script>
import DarkMode from "../components/menu/DarkMode";

export default {
    components: {
        DarkMode
    },
}
</script>
