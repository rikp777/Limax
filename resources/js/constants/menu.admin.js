const data = [
    {
        id: "user",
        icon: "simple-icon-user-follow",
        label: "menu.user.main",
        to: "/admin/user",
        subs: [
            {
                id: "userCreate",
                icon: "iconsminds-add",
                label: "menu.user.create",
                to: "/admin/user/create"
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
    },
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
    }
];
export default data;
