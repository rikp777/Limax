<template>
    <div>
        <b-row>
            <b-colxx xxs="12">
                <piaf-breadcrumb :heading="$t('menu.settings.main')" />
                <div class="separator mb-5"></div>
            </b-colxx>
        </b-row>

        <router-view />

    </div>

</template>
