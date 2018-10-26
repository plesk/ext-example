module.exports = {
    routes: [
        {
            path: 'overview',
            component: 'Overview',
            routes: [
                {
                    path: 'list',
                    component: 'ListExample',
                    title: 'List Example',
                },
                {
                    path: 'form',
                    component: 'forms/FormExample',
                },
            ],
        },
    ],
};
