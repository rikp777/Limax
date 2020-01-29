<template>
    <div>
        <h1 class="bd-title" id="content">{{$t('docs.introduction.title')}}</h1>
        <p class="bd-lead">{{$t('docs.introduction.text')}}</p>

        <h2 id="quick-start"><span class="bd-content-title">Get started<a class="anchorjs-link "
                                                                          href="#quick-start"
                                                                          aria-label="Anchor"
                                                                          data-anchorjs-icon="#"
                                                                          style="padding-left: 0.375em;"></a></span>
        </h2>

        <h4>How to get your application ready?</h4>
        <p>Navigate to the menu, left hand side of your screen. The menu contains various elements:<br> -
            Dashboard (your here),<br> - And your farm(s) <span
                v-for="farmer in farmers">{{farmer.name}}, </span><br>
            <br>Your farm has a sub menu containing:<br>
            - PalletLabel,<br>
            - ShippingLabel,<br>
            - Settings,<br>
            These menu items can be pressed to navigate to your desired location.<br><br>
            If you want to logout, click on your name top right of the screen and press logout.
        </p>
        <hr>
        <h3 id="palletlabel"><span class="bd-content-title">PalletLabel<a class="anchorjs-link " href="#palletlabel"
                                                                          aria-label="Anchor" data-anchorjs-icon="#"
                                                                          style="padding-left: 0.375em;"></a></span>
        </h3>

        <p>Navigate to the menu, left hand side of your screen. and click on your farm (<span
            v-for="farmer in farmers"> {{farmer.name}}</span> )<br>
            A sub menu will open, click on PalletLabel followed by Create.<br>
            Now that you are on the PalletLabel page you can start to create your label.<br>
        </p>
        <div class="alert alert-warning" role="alert">
            <h6>If this is your first time making a label you might encounter one or two red warnings in
                your screen telling you to add cells and articles.<br>
                If that is the case, please do so by following the instructions provided on that page.</h6>
        </div>
        <p>
            You have to fill in every field in order to show the next field, this to ensure that your label will
            contain all the data needed.<br><br>
            Fields that you will have to fill in:<br>
            - Article,<br>
            - Pallet Type (is filled automatically, only have to change this if its not correct),<br>
            - Cell,<br>
            - Flight,<br>
            - Flight Day,<br>
            - Crop Date (is filled automatically to the current day to save you time, only have to change this
            if its not correct),<br>
            - Amount (do not go over max),<br>
            - Note (don't have to fill this in, only when you have a comment or message),<br>
            - <input type="checkbox" name="1" value="1"> / <input type="checkbox" name="1" value="1" checked> Is
            everything correct? (if everything is correct, click to show the print button)<br>
            - Print,<br><br>
            You will now be redirected to the generated labels, simply click on the label and print it. (it
            automatically prints 2 labels).<br>
            If you want to make another label, simply press "New", if not redirect back to your desired page
            using the menu on the left hand side of your screen.

        </p>
        <hr>
        <h3 id="shippinglabel"><span class="bd-content-title">ShippingLabel<a class="anchorjs-link " href="#shippinglabel"
                                                                              aria-label="Anchor" data-anchorjs-icon="#"
                                                                              style="padding-left: 0.375em;"></a></span>
        </h3>

        <p>Navigate to the menu, left hand side of your screen. and click on your farm (<span
            v-for="farmer in farmers"> {{farmer.name}}</span> )<br>
            A sub menu will open, click on ShippingLabel followed by Create.<br>
            Now that you are on the ShippingLabel page you can start to create your label.<br>
            You have to fill in every field in order to show the next field, this to ensure that your label will
            contain all the data needed.<br><br>
            Fields that you will have to fill in:<br>
            - Trucker,<br>
            - License,<br>
            - Delivery Date (labels made for that day will be shown),<br>
            Select all the labels you want on the ShippingLabel,<br>
            If your happy with all the labels selected, proceed to print.<br><br>
            You will now be redirected to the generated labels, simply click on the label and print it. (it
            automatically prints 2 labels).<br>
            If you want to make another label, simply press "New", if not redirect back to your desired page
            using the menu on the left hand side of your screen.
        </p>

        <hr>
        <h2 id="contact"><span class="bd-content-title">Contact<a class="anchorjs-link " href="#contact" aria-label="Anchor" data-anchorjs-icon="#" style="padding-left: 0.375em;"></a></span></h2>

        <p>Do you have questions, comments and/or suggestions? Please contact:</p>

        <ul>
            <li>Mail: <a href="mailto:Henk.vandenBogaard@limax.nl" target="_top">Henk van den Bogaard</a> - Henk.vandenBogaard@limax.nl.</li>
            <li>Mail: <a href="mailto:tom.van.vegchel@limax.nl">Tom van Vegchel</a> - tom.van.vegchel@limax.nl.</li>
        </ul>

        <!--                                        <p>You can also follow <a href="https://twitter.com/getbootstrap">@getbootstrap on Twitter</a> for the latest gossip and awesome music videos.</p>-->

    </div>
</template>

<script>
    export default {
        name: "welcome"
    }
</script>

<style scoped>

</style>
