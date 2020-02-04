const data = [
    {
        id: "docs",
        icon: "iconsminds-library",
        label: "menu.docs.main",
        to: "/farmer/docs"
    },
    {
        id: "settings",
        icon: "simple-icon-settings",
        label: "menu.settings.main",
        to: "/farmer/settings"
    },
    {
        id: "palletlabel",
        icon: "simple-icon-tag",
        label: "menu.palletlabel.main",
        to: "/farmer/palletlabel",
        subs: [
            {
                id: "palletlabelCreate",
                icon: "iconsminds-add",
                label: "menu.palletlabel.create",
                to: "/farmer/palletlabel/create"
            }
        ],
    },
    {
        id: "shippinglabel",
        icon: "simple-icon-tag",
        label: "menu.shippinglabel.main",
        to: "/farmer/shippinglabel",
        subs: [
            {
                id: "shippinglabelCreate",
                icon: "iconsminds-add",
                label: "menu.shippinglabel.create",
                to: "/farmer/shippinglabel/create"
            }
        ],
    },
    {
        id: "article",
        icon: "iconsminds-shop-4",
        label: "menu.article.main",
        to: "/farmer/article",
        subs: [
            {
                icon: "iconsminds-add",
                label: "menu.article.create",
                to: "/farmer/article/create"
            },
        ]
    }
];
export default data;
