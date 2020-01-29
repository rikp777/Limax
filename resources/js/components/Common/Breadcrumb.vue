<template>
    <span>
      <h1 v-if="heading && heading.length>0">{{ heading }}</h1>
      <b-nav class="pt-0 breadcrumb-container d-none d-sm-block d-lg-inline-block">
          <b-breadcrumb :items="items"/>
      </b-nav>
    </span>
</template>

<script>
    import menuItems   from '../../constants/menu'
    import { defaultStartPath } from "../../constants/config";

    export default {
        props: ['heading'],
        data () {
            return {
                items: [],
                menuItems,
                defaultStartPath,
            }
        },
        methods: {
            getUrl (path, sub, index) {
                var pathToGo = '/' + path.split(sub)[0] + sub
                if (pathToGo === '/app') {
                    pathToGo = '/'
                }
                return pathToGo
            }
        },
        mounted () {
            let path = this.$route.path.substr(1);
            let rawPaths = path.split('/');
            // console.log(path);
            console.log(rawPaths);
            // console.log(this.$route.params);

            for (var pName in this.$route.params) {
                if (rawPaths.includes(this.$route.params[pName])) {
                    rawPaths = rawPaths.filter(x => x !== this.$route.params[pName])
                }
            }
            const menuItem = this.menuItems.find(
                x => x.id === rawPaths[1]
            );
            this.items.push({
                text: this.$t('menu.app'),
                to: defaultStartPath
            });
            this.items.push({
                text: this.$t(menuItem.label),
                to: menuItem.to
            });
            if(rawPaths[2]) {
                path = rawPaths[2];
                path = menuItem.id + path.charAt(0).toUpperCase() + path.slice(1)
                const item = menuItem.subs.find(
                    x => x.id === path
                );
                console.log(item);
                if (item) {
                    this.items.push({
                        text: this.$t(item.label),
                        to: item.to
                    });
                }
            }
        }
    }
</script>
