const data = [
    // {
    //     id: "palletlabel",
    //     icon: "simple-icon-tag",
    //     label: "menu.palletlabel.main",
    //     to: "/admin/palletlabel",
    //     subs: [
    //         {
    //             id: "palletlabelCreate",
    //             icon: "iconsminds-add",
    //             label: "menu.palletlabel.create",
    //             to: "/admin/palletlabel/create"
    //         }
    //     ],
    // },
    // {
    //     id: "shippinglabel",
    //     icon: "simple-icon-tag",
    //     label: "menu.shippinglabel.main",
    //     to: "/admin/shippinglabel",
    //     subs: [
    //         {
    //             id: "shippinglabelCreate",
    //             icon: "iconsminds-add",
    //             label: "menu.shippinglabel.create",
    //             to: "/admin/shippinglabel/create"
    //         }
    //     ],
    // },
    {
        id: "settings",
        icon: "simple-icon-settings",
        label: "menu.settings.main",
        to: "/admin/settings"
    },
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
        id: "report",
        icon: "simple-icon-chart",
        label: "menu.report.main",
        to: "/admin/report/overview"
    },
    {
        id: "planningOverview",
        icon: "simple-icon-organization",
        label: "menu.planning.main",
        to: "/admin/planning/overview"
    }
    // {
    //     id: "farmer",
    //     icon: "iconsminds-tractor",
    //     label: "menu.farmer.main",
    //     to: "/admin/farmer",
    //     subs: [
    //         {
    //             id: "farmerCreate",
    //             icon: "iconsminds-add",
    //             label: "menu.farmer.create",
    //             to: "/admin/farmer/create"
    //         }
    //     ],
    // },
    // {
    //     id: "article",
    //     icon: "simple-icon-tag",
    //     label: "menu.article.main",
    //     to: "/admin/article",
    //     subs: [
    //         {
    //             id: "articleCreate",
    //             icon: "iconsminds-add",
    //             label: "menu.article.create",
    //             to: "/admin/article/create"
    //         }
    //     ],
    // }
];
export default data;
