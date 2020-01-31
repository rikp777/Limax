const data = [
    {
        id: "article",
        icon: "simple-icon-tag",
        label: "menu.article.main",
        to: "/admin/article",
        subs: [
            {
                id: "articleCreate",
                icon: "iconsminds-add",
                label: "menu.article.create",
                to: "/admin/article/create"
            }
        ],
    },
    {
        id: "farmer",
        icon: "iconsminds-tractor",
        label: "menu.farmer.main",
        to: "/admin/farmer",
        subs: [
            {
                id: "farmerCreate",
                icon: "iconsminds-add",
                label: "menu.farmer.create",
                to: "/admin/farmer/create"
            }
        ],
    }
];
export default data;
