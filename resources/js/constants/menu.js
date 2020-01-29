const data = [
    {
        id: "docs",
        icon: "iconsminds-library",
        label: "menu.docs.main",
        to: "/app/docs"
    },
    {
        id: "palletlabel",
        icon: "simple-icon-tag",
        label: "menu.palletlabel.main",
        to: "/app/palletlabel",
        subs: [
            {
                id: "palletlabelCreate",
                icon: "iconsminds-add",
                label: "menu.palletlabel.create",
                to: "/app/palletlabel/create"
            }
        ],
    },
    {
        id: "article",
        icon: "iconsminds-shop-4",
        label: "menu.article.main",
        to: "/app/article",
        subs: [
            {
                icon: "iconsminds-add",
                label: "menu.article.create",
                to: "/app/article/create"
            },
        ]
    }
];
export default data;
