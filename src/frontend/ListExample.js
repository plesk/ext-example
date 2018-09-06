import { createElement, ServerList } from '@plesk/plesk-ext-sdk';

export default function ListExample() {
    return (
        <ServerList
            action="/api/list"
            columns={[{
                key: 'column1',
                title: 'Link',
                sortable: true,
                // eslint-disable-next-line
                render: ({ column1 }) => (
                    <a href="#">{`link #${column1}`}</a>
                ),
            }, {
                key: 'column2',
                title: 'Description',
                // eslint-disable-next-line
                render: ({ column1, column2 }) => (
                    <span>
                        <img src={column2} />
                        {` image #${column1}`}
                    </span>
                ),
            }]}
        />
    );
}
